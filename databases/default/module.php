<?php
return array(
    'fields' =>
        array(
            'module_id' =>
                array(
                    'name' => 'module_id',
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
            'name' =>
                array(
                    'name' => 'name',
                    'type' => 'string',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'mlv' =>
                array(
                    'name' => 'mlv',
                    'type' => 'number',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'pid' =>
                array(
                    'name' => 'pid',
                    'type' => 'number',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'doc_id' =>
                array(
                    'name' => 'doc_id',
                    'type' => 'number',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
        ),
    'index' =>
        array(

        ),
    'version' => '1.0',
    'engine' => 'innodb',
    'comment' => '模块表',
);