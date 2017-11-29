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


class Home extends Control
{
    public function get()
    {
        return $this->display('site/home.php');
    }

    public function getInfo()
    {
        return $this->display('site/info.php');
    }
    public function getDesc()
    {
        return $this->display('site/desc.php');
    }

    public function getMdebug()
    {

        $d =['uname'=>'zaq'.rand(100,999)];
        //$result = App::model(\app\model\Document::class)->load('goods')->table('demo')->insert($d);
        //$result = App::model(\app\model\Document::class)->load()->table('demo')->insert($d);
        $result = App::model(\app\model\Document::class)->load('goods')->table('demo')->insert($d);
        $result = App::model(\app\model\Home::class)->get();
        dump($result);
    }


}