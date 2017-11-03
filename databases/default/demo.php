<?php
return array(
    'fields' =>
        array(
            'id' =>
                array(
                    'name' => 'id',
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
            'age' =>
                array(
                    'name' => 'age',
                    'type' => 'number',
                    'notnull' => true,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'sex' =>
                array(
                    'name' => 'sex',
                    'type' => 'intbool',
                    'notnull' => true,
                    'default' => '1',
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'info' =>
                array(
                    'name' => 'info',
                    'type' => 'html',
                    'notnull' => false,
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
            'uname' =>
                array(
                    'name' => 'uname',
                    'type' => 'username',
                    'notnull' => true,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
        ),
    'index' =>
        array(
            'idx_demo_uname' =>
                array(
                    'name' => 'idx_demo_uname',
                    'type' => 'unique',
                    'method' => '',
                    'fields' => 'uname',
                ),
            'idx_demo_savetime' =>
                array(
                    'name' => 'idx_demo_savetime',
                    'type' => 'normal',
                    'method' => '',
                    'fields' => 'savetime',
                ),
            'idx_demo_status' =>
                array(
                    'name' => 'idx_demo_status',
                    'type' => 'normal',
                    'method' => '',
                    'fields' =>
                        array(
                            0 => 'start_status',
                            1 => 'login_status',
                        ),
                ),
        ),
    'version' => '1.0',
    'engine' => 'innodb',
    'comment' => 'demo',
);