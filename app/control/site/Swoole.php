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
namespace app\control\site;

use Front\Mvc\Control;
use Front\App;


class Swoole extends Control
{
    public function index()
    {
        $this->display('swoole.php');
    }
}