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

$dir = realpath(dirname(__FILE__));
define('ROOT_PATH',$dir.'/../public');

include ROOT_PATH.'/../front/src/Loader.php';
include ROOT_PATH.'/../front/helper.php';
include ROOT_PATH.'/../config/config.php';

Front\Loader::autoload();

$config = [];
$config['enable_static_handler'] = ENABLE_STATIC_HANDLER;
$config['document_root'] = ROOT_PATH;
$config['daemonize'] = false;
$config['worker_num'] = 2;
$config['log_file'] = './swoole.log';

$server = new Front\Swoole\Http\Server();
$server->init($config)->run();


