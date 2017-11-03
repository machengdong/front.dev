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
namespace app\control\wap;

use Front\Mvc\Control;
use Front\App;


class Home extends Control
{
    public function root()
    {
        echo "<pre>";
        dump('this wap Control.root',false);
    }

    public function getInfo()
    {

    }
}