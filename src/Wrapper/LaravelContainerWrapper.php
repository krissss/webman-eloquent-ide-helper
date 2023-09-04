<?php

namespace Kriss\WebmanEloquentIdeHelper\Wrapper;

use Closure;
use Illuminate\Container\Container;

final class LaravelContainerWrapper implements \Illuminate\Contracts\Container\Container
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __call($name, $arguments)
    {
        if ($name === 'runningUnitTests') {
            return false;
        }

        return $this->container->{$name}(...$arguments);
    }

    /**
     * @inheritDoc
     */
    public function bound($abstract)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function alias($abstract, $alias)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function tag($abstracts, $tags)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function tagged($tag)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function bind($abstract, $concrete = null, $shared = false)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function bindMethod($method, $callback)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function bindIf($abstract, $concrete = null, $shared = false)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function singleton($abstract, $concrete = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function singletonIf($abstract, $concrete = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function scoped($abstract, $concrete = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function scopedIf($abstract, $concrete = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function extend($abstract, Closure $closure)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function instance($abstract, $instance)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function addContextualBinding($concrete, $abstract, $implementation)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function when($concrete)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function factory($abstract)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function flush()
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function make($abstract, array $parameters = [])
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function call($callback, array $parameters = [], $defaultMethod = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function resolved($abstract)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function beforeResolving($abstract, Closure $callback = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function resolving($abstract, Closure $callback = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function afterResolving($abstract, Closure $callback = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function get(string $id)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }
}