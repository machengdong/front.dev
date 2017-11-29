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
namespace app\command;

use Front\Interfaces\Command;
class Dbman implements Command
{

    public function exec($param = [])
    {
        //echo "等待功能完善。\n";
        $db_object = new \Front\Dbman();
        $db_object->update();
    }
}