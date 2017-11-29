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

class Start extends Base
{
    public function get()
    {
        $docMdl = App::model(\app\model\Document::class);
        $data = ['start_status' => (App::input('u') == 'N' ? 'Y' : 'N')];
        $docMdl->db->table($docMdl->table_name)->update($data,['doc_id'=>App::input('id')]);
        \Front\Response::redirect(302,'/admin/document/dlist.html');
    }

}