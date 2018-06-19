<?php

namespace linkphp\cache;

use Config;

class Cache
{

    private $storage;

    private $config;

    public function __construct()
    {
        if(empty($this->config)){
            $this->config = Config::get('cache.');
        }
    }

    /**
     * @var Storage
     */
    public function storage()
    {
        if(!$this->storage){
            $type = !empty($options['type']) ? $options['type'] : 'File';

            $class = false === strpos($type, '\\') ?
                '\\linkphp\\cache\\storage\\' . ucwords($type) :
                $type;
            $this->storage = new $class($this->config);
            return $this->storage;
        }
        return $this->storage;
    }

    public function get($key)
    {
        return $this->storage()->get($key);
    }

    public function put($key,$data, $expire = '')
    {
        return $this->storage()->put($key,$data , $expire);
    }

    public function delete($key)
    {
        return $this->storage()->delete($key);
    }

}