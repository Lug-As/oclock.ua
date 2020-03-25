<?php


namespace oclock;


class Cache
{
    public static function set($key, $data, $seconds = 3600)
    {
        if ($seconds > 0) {
            $file = self::filename($key);
            $content['data'] = $data;
            $content['time'] = time() + $seconds;
            if ( file_put_contents($file, serialize($content)) !== false ){
                return true;
            }
        }
        return false;
    }

    public static function get($key)
    {
        $file = self::filename($key);
        if ( file_exists($file) ){
            $content = unserialize( file_get_contents($file) );
            if ($content['time'] > time()){
                return $content;
            }
            self::delete($key);
        }
        return false;
    }

    public static function delete($key)
    {
        $file = self::filename($key);
        if ( file_exists($file) ){
            unlink($file);
            return true;
        }
        return false;
    }

    protected static function filename($key)
    {
        $file = CACHE . "/". md5($key) . ".txt";
        return $file;
    }
}