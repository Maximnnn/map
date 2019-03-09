<?php

namespace App\Services;

use App\Core\Exceptions\BaseException;
use App\Core\SimpleValidator;

class MapOnDataGetter implements MapGetterInterface
{
    private $token;
    private $url   = 'https://mapon.com/api/v1/';

    private $routesPath = 'route/list';
    private $unitsPath = 'unit/list';

    private $filter;

    public function __construct(MapOnCredentials $credentials)
    {
        $this->token = $credentials->getToken();
    }

    public function getRoutes(array $filter): array
    {
        $this->validateFilter($filter, [
            'from' => ['required', 'string', 'notempty'],
            'till' => ['required', 'string', 'notempty']
        ]);

        foreach ($filter as $key => $value) {
            $this->addFilter($key, $value, in_array($key, ['till', 'from']) ? 'date' : 'string');
        }

        return $this->get($this->routesPath);
    }

    public function getUnits(array $filter): array
    {
        foreach ($filter as $key => $value) {
            $this->addFilter($key, $value);
        }
        return $this->get($this->unitsPath);
    }

    public function addFilter($key, $value, $type = 'string')
    {
        if ($type === 'date') {
            $value = (new \DateTime($value))->format(\DateTime::ATOM);
        }

        $this->filter[$key] = (string)$value;
        return $this;
    }

    private function validateFilter(array $filter, array $rules)
    {
        /**@var $validator SimpleValidator*/
        $validator = app()->make(SimpleValidator::class);

        $validator->check($filter, $rules)->validate();
    }

    private function get(string $path, array $filter = [])
    {
        $url = $this->url  . $path . '.json?' . http_build_query(array_merge(['key' => $this->token], $filter));

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = json_decode(curl_exec($ch), true);

        $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($info !== 200 || isset($result['error'])) {
            throw new BaseException('some api error: ' . $result['error']['msg'] ?? '');
        }

        return $result;
    }

}