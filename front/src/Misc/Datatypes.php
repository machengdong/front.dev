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

namespace Front\Misc;

class Datatypes
{

    private static $table  = [
        'money'=>array(
            'sql'=>'decimal(20,3)',
        ),
        'phone '=>array(
            'sql'=>'integer(11) unsigned',
        ),
        'username'=>array(
            'sql'=>'varchar(50)',
        ),
        'string'=>array(
            'sql'=>'varchar(255)',
        ),
        'text'=>array(
            'sql'=>'text',
        ),
        'bool'=>array(
            'sql'=>'enum(\'true\',\'false\')',
        ),
        'time'=>array(
            'sql'=>'integer(10) unsigned',
        ),
        'intbool'=>array(
            'sql'=>'enum(\'0\',\'1\')',
        ),
        'password'=>array(
            'sql'=>'char(32)',
        ),
        'tinybool'=>array(
            'sql'=>'enum(\'Y\',\'N\')',
        ),
        'number'=>array(
            'sql'=>'mediumint unsigned',
        ),
        'float'=>array(
            'sql'=>'float',
        ),
        'ip'=>array(
            'sql'=>'varchar(20)',
        ),
        'html'=>array(
            'sql'=>'longtext',
        ),
    ];


    public static function get($key = null)
    {
        if($key == '')return self::$table;
        if(array_key_exists($key,self::$table)) return self::$table[$key];
        return null;
    }
}