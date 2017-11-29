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
namespace app\control\admin\document;
use Front\App;
use app\control\admin\Base;

class Module extends Base
{
    public function get()
    {
        $cat_list = \Front\Db::instance()->table('module')->get('*',['mlv'=>1]);
        $doc_list = \Front\Db::instance()->table('document')->get('*');
        return $this->display('admin/doc/module.php',['doc_list'=>$doc_list,'cat_list'=>$cat_list]);
    }

}