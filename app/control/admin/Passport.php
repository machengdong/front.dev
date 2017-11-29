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
namespace app\control\admin;

use Front\Mvc\Control;
use Front\App;

class Passport extends Control
{

    public function get()
    {
        return $this->display('admin/login.php');
    }

    public function post()
    {
        $userMdl = new \app\model\User();
        $result = $userMdl->login(App::input(),$msg);
        return ['code'=>$result ? 'succ' : 'fail','msg'=>$msg];
    }
}