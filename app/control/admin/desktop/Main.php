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

use app\control\admin\Base;

class Main extends Base
{
    public function get()
    {
        return $this->display('admin/base/desktop.php');
    }
}