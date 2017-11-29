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
namespace app\control\admin\desktop;

use Front\Config;
use app\control\admin\Base;


class Top extends Base
{
    public function get()
    {
        $pagedata = [];
        $pagedata['username'] = $this->userInfo['admin_user_username'];
        $pagedata['logouturl'] = "/admin/logout.html";
        return $this->display('admin/base/_top.php',$pagedata);
    }
}