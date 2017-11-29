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


class Left extends Base
{
    public function get()
    {
        $menus = Config::get('menu.admin');
        $data = [
            'menu' => $menus,
        ];
        return $this->display('admin/base/_left.php',$data);
    }
}