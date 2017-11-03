<?php
/**
 * FrontPHP  [文件描述]
 *
 * @category PHP
 *
 * @version  Release: 1.0.0
 *
 * @author   lru <lru@ximahe.cn>
 *
 */
namespace Front\Driver\cache;

define('SECACHE_FILE_PATH',ROOT_PATH.'/../data/secache');

class File
{
    private static $secache;

    private static function init()
    {
        self::$secache = new \Front\Driver\cache\realize\Secache();
        self::$secache->workat(SECACHE_FILE_PATH);
    }


    public static function set($key,$value = null)
    {
        !empty($secache) or self::init();

        return self::$secache->store(self::getKey($key),$value);
    }

    public static function get($key)
    {
        !empty($secache) or self::init();

        if(self::$secache->fetch(self::getKey($key),$value))
        {
            return $value;
        }
        return null;
    }

    public static function delete($key)
    {
        !empty($secache) or self::init();

        self::$secache->delete(self::getKey($key));
    }

    public static function clear()
    {
        !empty($secache) or self::init();

        self::$secache->clear();
    }

    private static function getKey($key)
    {
        return md5((string)$key);
    }
}