<?php

namespace linkphp\cache\storage;

use linkphp\cache\Storage;

class File extends Storage
{

    public function put($key, $data , $expire)
    {
        if (is_null($expire)) {
            $expire = $this->config['expire'];
        }
        $value   = "<?php\n//" . sprintf('%012d', $expire) . "\n exit();?>\n" . $data;
        $filename = $this->filename($key);
        $dir = dirname($filename);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $file = fopen($filename,'w');
        if($file){
            fwrite($file,$value);
            fclose($file);
        } else return false;
        return true;
    }

    public function get($key)
    {
        $filename = $this->filename($key);
        if(!file_exists($filename) || !is_readable($filename)){
            return false;
        }
        $content = file_get_contents($filename);
        if (false !== $content) {
            $expire = (int) substr($content, 8, 12);
            if (0 != $expire && $_SERVER['REQUEST_TIME'] > filemtime($filename) + $expire) {
                return false;
            }
            $content = substr($content, 32);
            $content = unserialize($content);
            return $content;
        } else {
            return false;
        }
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

    public function delete($key)
    {
        $this->unlink($this->filename($key));
    }

    /**
     * 判断文件是否存在后，删除
     * @param $path
     * @return bool
     * @author byron sampson <xiaobo.sun@qq.com>
     * @return boolean
     */
    private function unlink($path)
    {
        return is_file($path) && unlink($path);
    }

}