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

class Kernel
{

    public static function boot($path_info = null)
    {
        try{
            set_error_handler([\Front\kernel::class, 'applyError']);

            self::setOption();

            !empty($path_info) or $path_info = Request::getPathInfo();

            App::only(\Front\Routes::class)->dispatch($path_info);

        } catch (\Exception $e) {

            self::exceptionHandle($e);
        }
    }


    public static function applyError($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno))
        {
            $err = "Message: {$errstr} Code: {$errno} File: {$errfile} Line: {$errline}";
            Log::error($err);
        }
        else
            throw new \Exception($errstr,$errno);

    }

    public static function exceptionHandle($e)
    {

        $message = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        $html  = "<html><head></head><body style='margin:0px;background-color: #c1f5d6;'>";
        $html .= "<p style='background-color: #ef3f3f; height: 60px; width: 100%; font-size: 20px; line-height: 60px;'>&nbsp; <span style='font-weight: 900;'>{$message}</span>&nbsp;&nbsp;{$file}&nbsp;&nbsp;{$line}</p>";
        foreach (debug_backtrace() as $k=>$item)
        {
            $html .= "<div style='height: 26px;line-height: 26px;'>&nbsp;&nbsp;<b>{$k}:</b> {$item['file']} &nbsp;&nbsp;<span style='color: #3c43d0;'><b>{$item['function']}</b></span> &nbsp;&nbsp; {$item['line']}</div>";
        }
        $html .= "</body></html>";
        \Front\Response::end($html);

    }

    public static function setOption()
    {
        if(defined('DEBUG_OPEN') && DEBUG_OPEN)
            error_reporting(E_ALL);
        else
            error_reporting(0);
    }
}