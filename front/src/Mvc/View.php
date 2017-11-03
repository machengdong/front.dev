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
namespace Front\Mvc;

final class View
{

    private static $end_mark = '?>';

    private static $disable_functions = [];

    private static $__instance;

    public static function instance()
    {
        if(!isset(self::$__instance))
        {
            self::$__instance = new self();
        }
        return self::$__instance;
    }

    public function display($file,$data=[])
    {
        try {
            !empty($data) && extract($data);
            if(file_exists(VIEW_PATH.$file))
            {
                $file_content = file_get_contents(VIEW_PATH.$file);
                if($this->__checkFile($file_content))
                {
                    ob_start();
                    eval(self::$end_mark.$file_content);
                    $result = ob_get_clean();
                    return $result;
                }
            }
            throw new \Exception("{$file} Template file does not exist");
        }
        catch (\Exception $e)
        {
            \Front\Kernel::exceptionHandle($e);
        }
    }

    private function __checkFile($file_content)
    {
        return true;
    }
}