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
    /** 后台登陆入口 */
    public function index()
    {
        return $this->display('admin/login.php');
    }

    /** 后台登陆地址 */
    public function login()
    {
        $userMdl = new \app\model\User();
        $result = $userMdl->login(App::input(),$msg);

        return ['code'=>$result ? 'succ' : 'fail','msg'=>$msg];
    }

    /** 退出登陆 */
    public function logout()
    {
        $userMdl = new \app\model\User();
        $userMdl->logout();
        \Front\Response::redirect(302,'/admin/login.html');
    }
}