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
return [
   'site'=> [
           '/'         => '\app\control\site\Home@root',
           '/get.html' => '\app\control\site\Home@getInfo',
           '/v.html' => '\app\control\site\Home@getDesc',
           '/m.html' => '\app\control\site\Home@getMdebug',
           '/swoole.jsp' => '\app\control\site\Swoole@index',
       ],
   'admin'=> [
            '/login.html' => '\app\control\admin\Passport@index',
            '/logout.html' => '\app\control\admin\Passport@logout',
            '/dologin.html' => '\app\control\admin\Passport@login',
            '/desktop.html'=>'\app\control\admin\Desktop@index',
            '/get/top.html'=>'\app\control\admin\Desktop@getTop',
            '/get/left.html'=>'\app\control\admin\Desktop@getLeft',
            /** 文档管理 */
            '/doc/publish.html'=>'\app\control\admin\Document@publish',
            '/doc/dopublish.html'=>'\app\control\admin\Document@doPublish',
            '/doc/list.html'=>'\app\control\admin\Document@docList',
            '/doc/update/status.html'=>'\app\control\admin\Document@update',

            '/file/upload.html'=>'\app\control\admin\Upload@save',
            '/member/index.html'=>'\app\control\admin\Member@index',
       ],
];