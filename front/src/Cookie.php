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
namespace Front;

/**
 * Class Cookie
 *
 * desc 因为swoole不能使用setcookie函数
 *
 * @package Front
 */
class Cookie
{
    /**
     * @desc 设置COOKIE
     *
     * @param null $name
     * @param null $value
     * @param int $expire
     * @param string $path
     * @param null $domain
     * @param bool $secure
     */
    public static function set($name=null,$value=null,$expire=0,$path='/',$domain=null,$secure=false)
    {
        /** @var  $responseInstance swoole 不能使用setcookie函数 */
        $responseInstance = \Front\App::getResponseInstance();
        $responseInstance->cookie($name,$value,$expire,$path,$domain,$secure);
    }

    /**
     * @desc 获取COOKIE
     *
     * @param $name
     * @return null
     */
    public static function get($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    /**
     * @desc 删除COOKIE
     *
     * @param $name
     * @return bool
     */
    public static function delete($name)
    {
        if(self::get($name))
        {
            unset($_COOKIE[$name]);
            self::set($name,'',(time() - 1));
        }
        return true;
    }

    /**
     * @desc 清空当前域下的所有COOKIE
     *
     * @return true
     */
    public static function clear()
    {
        foreach ((array)$_COOKIE as $v)
        {
            self::delete($v);
        }
        return true;
    }

}