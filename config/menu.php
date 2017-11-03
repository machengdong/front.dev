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
    'admin' =>
    [
        [
            'name'=>'系统管理',
            'display'=>true,
            'sublevel'=>[
                    ['href'=>'/admin/zaq.html','name'=>'登陆日志','display'=>true],
                    ['href'=>'./zzht.html','name'=>'用户管理','display'=>true],
                ]

        ],
        [
            'name'=>'文章管理',
            'display'=>true,
            'sublevel'=>[
                ['href'=>'/admin/doc/publish.html','name'=>'发布文章','display'=>true],
                ['href'=>'/admin/doc/list.html','name'=>'文章列表','display'=>true],
            ]

        ],
        [
            'name'=>'会员管理',
            'display'=>true,
            'sublevel'=>[
                ['href'=>'/admin/member/index.html','name'=>'会员列表','display'=>true],
                ['href'=>'./zzht.html','name'=>'用户管理','display'=>true],
            ]

        ]

    ],
    'site' =>
    [

    ]
];