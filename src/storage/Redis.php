<?php

namespace linkphp\cache\storage;

use linkphp\cache\Storage;

class Redis extends Storage
{

    public function put($key, $value, $expire)
    {
        // TODO: Implement put() method.
    }

    public function get($key)
    {
        // TODO: Implement get() method.
    }

    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    /**
     * 判断缓存是否存在
     * @access public
     * @param string $name 缓存变量名
     * @return bool
     */
    public function has($name)
    {
        return $this->get($name) ? true : false;
    }

}