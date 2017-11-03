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
namespace Front\Mvc;

use Front\Config;
use Front\Db;

class Model
{
    public $db;

    public $table_name;


    public function __construct()
    {
        !empty($this->table_name) or $this->table_name = $this->setTable();

        !empty($this->db) or $this->db = Db::instance();
    }

    public function setTable()
    {
        $name = get_class($this);
        return strtolower(substr($name,strrpos($name,'\\')+1));
    }

    public function __call($method, $params)
    {
        switch ($method)
        {
            case 'update':
            case 'delete':
            case 'insert':
            case 'count':
            case 'get':
                !isset($this->db->table_name) && $this->db->table($this->table_name);
                break;
        }
        return call_user_func_array([$this->db, $method], $params);
    }

}