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

class Dlist extends Base
{

    public function get()
    {
        $docMdl = App::model(\app\model\Document::class);
        $result = $docMdl->get('*');
        return $this->display('admin/doc/list.php',['result'=>$result]);
    }
}