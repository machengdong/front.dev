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

namespace Front\Swoole\Http;

use Front\Request;
use Front\App;
use Front\Routes;

class Work
{
    /** @var array */
    private static $extension = ['html','htm','php','/',''];
    /** @var array */
    private static $base_name = ['404.html','502.html'];

    public function boot($response)
    {
        $path_info = Request::getPathInfo();
        !empty($path_info) && $path_info = self::preHandle($path_info);
        if($this->is_sendfile($path_info,$ext))
        {
            return $this->sendFile($response,$path_info,$ext);
        }
        App::setResponseInstance($response);
        \Front\Kernel::boot($path_info);
    }

    /**
     * @desc 预处理PATH_INFO
     *
     * @param $path_info
     * @return string
     */
    static public function preHandle($path_info)
    {
        return '/'.trim($path_info,'/');
    }

    /**
     * @desc 发送文件到浏览器
     *
     * @param $response
     * @param $path_info
     * @param $ext
     * @return bool
     */
    public function sendFile($response,$path_info,$ext){
        /** 首先获取mime-type */
        $response->header('Content-Type',\Front\Misc\Mime::get($ext));
        $response->sendfile(ROOT_PATH.$path_info);
        return true;
    }

    /**
     * @desc 判断当前请求是否发送文件到浏览器
     *
     * @param $path_info
     * @param null $extension
     * @return bool
     */
    public function is_sendfile($path_info,&$extension=null)
    {
        $pathInfo = pathinfo($path_info);
        $extension = @$pathInfo['extension'];
        $base_name = @$pathInfo['basename'];

        if(defined('ENABLE_STATIC_HANDLER') && ENABLE_STATIC_HANDLER)
            return false;
        elseif (in_array($base_name,self::$base_name))
            return true;
        elseif (in_array($extension,self::$extension))
            return false;
        else
            return true;
    }
}