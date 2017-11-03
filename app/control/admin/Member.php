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

class Member extends Base
{

    public function index()
    {
        return $this->display('admin/member/list.php');
    }
}