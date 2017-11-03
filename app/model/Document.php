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
namespace app\model;

use Front\Mvc\Model;

class Document extends Model
{
    public function savedoc(array $data,&$err = null)
    {
        if(!$data['container'] || !$data['title'])
        {
            $err = '文档内容或文档标题不能为空。';
            return false;
        }
        $_data['content'] = $data['container'];
        $_data['title'] = $data['title'];
        $_data['savetime'] = $_data['updatetime'] = time();
        $_data['start_status'] = 'N';
        return $this->db->table($this->table_name)->insert($_data,true);
    }
}