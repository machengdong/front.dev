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

//----------- 引导文件 -----------\\

/** 引入框架配置 */
include_once ROOT_PATH.'/../config/config.php';
/** 引入自动加载类 */
include_once FRAME_PATH."/src/Loader.php";
/** 引入函数助手 */
include_once FRAME_PATH."/helper.php";

Front\Loader::autoload();

Front\Kernel::boot();


