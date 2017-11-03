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
namespace Front\Driver\Response;


use Front\Kernel;

class Response
{

    public function header($meta,$value)
    {
        header("{$meta}:{$value}");
    }

    public function cookie($name=null,$value=null,$expire=0,$path='/',$domain=null,$secure=false)
    {
        setcookie($name,$value,$expire,$path,$domain,$secure);
    }

    public function status($code = 200)
    {
        header(\Front\Misc\Http::get($code),true,$code);
    }

    public function end($data = '')
    {
        echo $data;exit();
    }

    public function write($data = '')
    {
        echo $data;
    }

    public function sendfile($file = '')
    {
        try{
            if(file_exists($file))
            {
                if(!readfile($file))
                {
                    throw new \Exception("{$file} read the failure");
                }
            }
            else
                throw new \Exception("{$file} can't find");

        }catch (\Exception $e)
        {
            Kernel::exceptionHandle($e);
        }
    }

    public function gzip($level = 1)
    {
        return true;
    }

}