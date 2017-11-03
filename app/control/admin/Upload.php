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

class Upload extends Base
{

    public function save()
    {
        $upObject = new \app\library\Upload();
        if($upObject->upload('member_img'))
        {
            return $upObject->getFileName();
        }
        return $upObject->getErrorMsg();
    }
}