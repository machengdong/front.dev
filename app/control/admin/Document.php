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
use Front\App;

class Document extends Base
{
    public function publish()
    {
        return $this->display('admin/doc/add.php');
    }

    public function docList()
    {
        $docMdl = App::model(\app\model\Document::class);
        $result = $docMdl->get('*');
        return $this->display('admin/doc/list.php',['result'=>$result]);
    }

    public function doPublish()
    {
        $docMdl = App::model(\app\model\Document::class);
        //var_dump(App::input());
        if($docMdl->savedoc(App::input(),$err))
        {
            return ['code'=>'succ','msg'=>'发布成功，继续发布！'];
        }

        return ['code'=>'fail','msg'=>'发布失败！'.$err];

    }

    public function update()
    {
        $docMdl = App::model(\app\model\Document::class);
        $data = ['start_status' => (App::input('u') == 'N' ? 'Y' : 'N')];
        $docMdl->databases->table($docMdl->table_name)->update($data,['doc_id'=>App::input('id')]);
        \Front\Response::redirect(302,'/admin/doc/list.html');
    }
}