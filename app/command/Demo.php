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

class Demo implements Command
{

    public function exec($param = [])
    {
        echo "this is demo\n";
        for ($i=100;$i<110;$i++)
        {
            echo "this is {$i}\n";
        }
    }
}