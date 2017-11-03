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
namespace Front\Driver\session;


class File extends \SessionHandler
{

    public function open($save_path, $sess_name)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($sess_id)
    {
        $fruit =  \Front\Driver\cache\File::get($sess_id);
        return $fruit;
    }

    public function write($sess_id, $data)
    {
        return \Front\Driver\cache\File::set($sess_id,$data);
    }

    public function destroy($sess_id)
    {
        return true;
    }

    public function gc($sess_life_time)
    {
        return true;
    }
}
