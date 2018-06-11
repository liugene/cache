<?php

namespace linkphp\cache;

use linkphp\cache\storage\File;

class Cache
{

    private $storage;

    public function storage()
    {
        if(is_null($this->storage)) $this->storage = new File();
        return $this->storage;
    }

    public function setCacheTime($time)
    {
        $this->storage()->setCacheTime($time);
        return $this;
    }

    public function setCachePath($path)
    {
        $this->storage()->setCachePath($path);
        return $this;
    }

    public function setExt($ext)
    {
        $this->storage()->setExt($ext);
        return $this;
    }

    public function get($key)
    {
        return $this->storage()->get($key);
    }

    public function put($key,$data)
    {
        return $this->storage()->put($key,$data);
    }

    public function delete(){}

}