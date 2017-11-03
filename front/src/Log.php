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
 * Class Log 日志管理类
 *
 * @package Front
 */
final class Log
{
    /** @var array 日志等级 */
    private $logLvs = ['emergency','alert','critical','error','warning','notice','info','debug'];

    static public function emergency($message)
    {
        self::log($message,'emergency');
    }
    static public function alert($message)
    {
        self::log($message,'alert');
    }
    static public function critical($message)
    {
        self::log($message,'critical');
    }
    static public function notice($message)
    {
        self::log($message,'notice');
    }
    static public function warning($message)
    {
        self::log($message,'warning');
    }
    static public function info($message)
    {
        self::log($message,'info');
    }
    static public function debug($message)
    {
        self::log($message,'debug');
    }
    static public function error($message)
    {
        self::log($message,'error');
    }

    static public function log($message, $log_level = 'info')
    {
        $_message = date("Y-m-d H:i:s")."\t{$log_level}\t".$message."\n";
        switch ($log_level)
        {
            case 'notice':
            case 'warning':
            case 'debug':
            case 'alert':
                $logfile = DATA_PATH . '/logs/'. date('Ymd').'/debug.php';
                break;
            case 'error':
                $logfile = DATA_PATH . '/logs/'. date('Ymd').'/error.php';
                break;
            case 'emergency':
            case 'critical':
                $logfile = DATA_PATH . '/logs/'. date('Ymd').'/critical.php';
                break;
            case 'info':
            default:
                $logfile = DATA_PATH . '/logs/'. date('Ymd').'/info.php';
                break;
        }

        if(!file_exists($logfile))
        {
            if(!is_dir(dirname($logfile))) mkdir_p(dirname($logfile));
            file_put_contents($logfile,'<'.'?php exit()?'.">\n");
        }

        @error_log($_message, 3, $logfile);
    }

    /**
     * desc 为Shell的history功能定制开发
     *
     * @param $message
     */
    static public function history($message)
    {
        $history = date("Y-m-d H:i:s")."\t{$message}\n";
        $logfile = DATA_PATH . '/logs/history.php';
        !file_exists($logfile) or (!is_dir(dirname($logfile)) or mkdir_p(dirname($logfile)));
        @error_log($history, 3, $logfile);
    }
}