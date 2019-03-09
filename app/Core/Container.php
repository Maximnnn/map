<?php

namespace App\Core;


use DI\Definition\Source\MutableDefinitionSource;
use DI\Proxy\ProxyFactory;
use Psr\Container\ContainerInterface;

class Container extends \DI\Container
{
    protected static $instance;

    public static function instance() {
        return self::$instance ?: new self;
    }

    public function __construct(MutableDefinitionSource $definitionSource = null, ProxyFactory $proxyFactory = null, ContainerInterface $wrapperContainer = null)
    {
        if (self::$instance)
            throw new \RuntimeException('container is singleton, use ::instance()');
        parent::__construct($definitionSource, $proxyFactory, $wrapperContainer);
        static::$instance = $this;
    }

}