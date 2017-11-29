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

class Save extends Base
{
    public function get()
    {
        return $this->display('admin/doc/add.php');
    }

    public function post()
    {
        $docMdl = App::model(\app\model\Document::class);
        //var_dump(App::input());
        if($docMdl->savedoc(App::input(),$err))
        {
            return ['code'=>'succ','msg'=>'发布成功，继续发布！'];
        }

        return ['code'=>'fail','msg'=>'发布失败！'.$err];

    }

}