<?php

namespace App\Core;

use App\Controllers\Pages\Home;
use App\Controllers\Pages\Login;
use App\Controllers\Pages\Logout;
use App\Controllers\Pages\Map;
use App\Controllers\Pages\Register;
use App\Core\Exceptions\BaseException;
use App\Core\Pipeline\Pipeline;
use App\Middleware\Auth;
use App\Middleware\ControllerRunner;
use App\Middleware\Session;
use App\Middleware\User;
use App\Services\MapGetterInterface;
use App\Services\MapOnCredentials;
use App\Services\TestGetter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Core implements HttpKernelInterface
{
    protected $routeCollection;

    protected function getMiddleware()
    {
        return [
            'session',
            'user'
        ];
    }

    protected function getProviders(): array
    {
        return [
            'auth'      => Auth::class,
            'session'   => Session::class,
            'user'      => User::class,
            'db'        => DB::class,
            'validator' => SimpleValidator::class,
            'smarty'    => Smarty::class,
            MapOnCredentials::class => function(\App\Core\Request $request) {
                if ($user = $request->user()) {
                    return new MapOnCredentials($user);
                }
                throw new BaseException('not logged in');
            },
            MapGetterInterface::class => TestGetter::class
        ];
    }

    protected function getRoutes(): array
    {
        return [
            //pages
            ['name' => '/',         'options' => ['controller' => Home::class]],
            ['name' => '/login',    'options' => ['controller' => Login::class]],
            ['name' => '/register', 'options' => ['controller' => Register::class]],
            ['name' => '/map',      'options' => ['controller' => Map::class, 'middleware' => ['auth']]],
            ['name' => '/logout',   'options' => ['controller' => Logout::class, 'middleware' => ['auth']]],

            //api
            ['name' => '/api/routes', 'options' => ['controller' => \App\Controllers\Api\Routes::class, 'middleware' => ['auth']]],
            ['name' => '/api/units', 'options' => ['controller' => \App\Controllers\Api\Units::class, 'middleware' => ['auth']]],
            ['name' => '/api/login', 'options' => ['controller' => \App\Controllers\Api\Login::class]],
            ['name' => '/api/register', 'options' => ['controller' => \App\Controllers\Api\Register::class]]
        ];
    }

    public function __construct()
    {
        $this->registerEnv();
        $this->registerProviders();
        $this->startDb();
        $this->routeCollection = $this->registerRoutes(app()->make(RouteCollection::class));
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        app()->set(\App\Core\Request::class, $request);

        $matcher = new UrlMatcher($this->routeCollection, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());

            $middleware = array_merge($this->getMiddleware(), $attributes['middleware'] ?? []);
            $controller = $attributes['controller'];

            $next = $pipeline = new Pipeline();
            foreach ($middleware as $class) {
                $obj = app()->make($class);
                $next = $next->next($obj);
            }
            $next->next(app()->make(ControllerRunner::class, compact('controller')));

            $response = $pipeline->run($request);

        } catch (BaseException $e) {
            $response = $e->resolve();
        } catch (\Exception $e) {
            $response = new Response($e->getMessage());
        }

        return $response;
    }

    protected function registerEnv()
    {
        $env = explode(PHP_EOL, file_get_contents('./.env'));
        foreach ($env as $string) {
            putenv($string);
        }
    }

    protected function registerProviders()
    {
        foreach ($this->getProviders() as $key => $provider) {
            if (is_string($provider))
                $provider = function() use ($provider) {
                    return app()->make($provider);
                };
            app()->set($key, $provider);
        }
    }

    protected function registerRoutes(RouteCollection $routeCollection)
    {
        foreach ($this->getRoutes() as $route) {
            $routeCollection->add($route['name'], app()->make(Route::class, ['path' => $route['name'], 'defaults' => $route['options']]));
        }
        return $routeCollection;
    }

    protected function startDb()
    {
        $db = app()->call('db');
    }
}
