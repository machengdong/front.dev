<?php
return array(
    'fields' =>
        array(
            'member_id' =>
                array(
                    'name' => 'member_id',
                    'type' => 'number',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => true,
                    'autoinc' => true,
                    'comment' => '',
                ),
            'start_status' =>
                array(
                    'name' => 'start_status',
                    'type' => 'tinybool',
                    'notnull' => true,
                    'default' => 'Y',
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '启用状态',
                ),
            'login_status' =>
                array(
                    'name' => 'login_status',
                    'type' => 'tinybool',
                    'notnull' => true,
                    'default' => 'N',
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '登陆状态',
                ),
            'password' =>
                array(
                    'name' => 'password',
                    'type' => 'password',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '密码',
                ),
            'member_name' =>
                array(
                    'name' => 'member_name',
                    'type' => 'username',
                    'notnull' => true,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'savetime' =>
                array(
                    'name' => 'savetime',
                    'type' => 'time',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'updatetime' =>
                array(
                    'name' => 'updatetime',
                    'type' => 'time',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'head_img' =>
                array(
                    'name' => 'head_img',
                    'type' => 'string',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'qq' =>
                array(
                    'name' => 'qq',
                    'type' => 'string',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'email' =>
                array(
                    'name' => 'email',
                    'type' => 'string',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
        ),
    'index' =>
        array(
            'idx_front_user' =>
                array(
                    'name' => 'idx_front_user',
                    'type' => 'normal',
                    'method' => '',
                    'fields' =>
                        array(
                            0 => 'member_name',
                            1 => 'password',
                        ),
                ),
        ),
    'version' => '1.0',
    'engine' => 'innodb',
    'comment' => '用户表',
);