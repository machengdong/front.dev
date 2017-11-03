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

class Loader
{
    static public function autoload()
    {
        spl_autoload_register(
            function($class_name) {
                try {
                    if(strpos($class_name,'Front\\') === 0)
                    {
                        $class_name = str_replace('Front\\','src/',$class_name);
                        $file_path =  FRAME_PATH.'/'.str_replace('\\','/',$class_name).'.php';
                    }
                    else
                        $file_path = ROOT_PATH.'/../'.str_replace('\\','/',$class_name).'.php';

                    if(file_exists($file_path))
                    {
                        include $file_path;
                        return true;
                    }

                    throw new \Exception("Class {$class_name} does not exist");
                }
                catch (\Exception $e)
                {
                    Kernel::exceptionHandle($e);
                }
            }
        );
    }
}