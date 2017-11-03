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
    //'driver' => \Front\Driver\cache\File::class,

    'storage' => [
        'session' => [
            'name' => '会话控制',
            'driver' => 'file',
        ],
        'common' => [
            'name' => '一般缓存',
            'driver' => 'file',
        ],
        'menus' => [
            'name' => '菜单',
            'driver' => 'file',
        ],
        'default' => [
            'name' => '默认缓存场景',
            'driver' => 'file',
        ],
    ],

    'driver' =>[
        'file'=>\Front\Driver\cache\File::class,
        'apc'=>\Front\Driver\cache\Apc::class,
        'memcached'=>\Front\Driver\cache\Memcached::class,
        'redis'=>\Front\Driver\cache\Redis::class,
    ]
];