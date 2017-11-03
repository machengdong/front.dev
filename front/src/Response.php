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
 * Class Response 响应类
 *
 * @source https://wiki.swoole.com/wiki/page/329.html
 *
 * @package Front
 *
 * @method  header
 * @method  cookie
 * @method  status
 * @method  end
 * @method  write
 * @method  sendfile
 * @method  gzip
 */
class Response
{
    /**
     * @desc 重定向方法
     * -----------------------------------------------------
     * |header('Location: http://www.xxx.com/');
     * |和setcookie一样，header在swoole里面也是不能用的
     * ------------------------------------------------------
     * @param int $status
     * @param string $url
     * @return mixed
     */
    public static function redirect($status = 302, $url = '/')
    {
        /** @var  $responseInstance */
        $responseInstance = \Front\App::getResponseInstance();
        /** 发送http状态码 */
        $responseInstance->status($status);
        /** 设置http响应的Header信息 */
        $responseInstance->header("Location", $url);
        /** 发送http响应体，并结束请求处理 */
        return $responseInstance->end('');
    }

    public static function __callStatic($method, $args)
    {
        $instance = \Front\App::getResponseInstance();

        switch (count($args)) {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }
}