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


class Base extends Control
{
    public function __construct()
    {
        /** 后台基础控制器 */
        $userMdl = App::model(\app\model\User::class);
        if(!$userMdl->isLogin($userInfo))
        {
            \Front\Response::redirect(302,'/admin/login.html');
        }
        $this->userInfo = $userInfo;
    }
}