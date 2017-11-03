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
    'default' => [
        'db_host'=>'127.0.0.1',
        'db_name'=>'demo',
        'db_user'=>'root',
        'db_pass'=>'root',
    ],
    'master' => [
        'db_host'=>'127.0.0.2',
        'db_name'=>'demo',
        'db_user'=>'root',
        'db_pass'=>'root',
    ],
    'standby' => [
        'db_host'=>'127.0.0.3',
        'db_name'=>'demo',
        'db_user'=>'root',
        'db_pass'=>'root',
    ],
];