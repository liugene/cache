<?php

namespace linkphp\cache;

abstract class Storage
{

    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    abstract public function put($key, $data, $expire);

    abstract public function get($key);

    abstract public function delete($key);

    abstract public function has($key);

    public function filename($key)
    {
        return $this->config['path'] . md5($key) . $this->config['ext'];
    }

}