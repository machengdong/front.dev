<?php
return array(
    'fields' =>
        array(
            'doc_id' =>
                array(
                    'name' => 'doc_id',
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
            'content' =>
                array(
                    'name' => 'content',
                    'type' => 'html',
                    'notnull' => false,
                    'default' => NULL,
                    'primary' => false,
                    'autoinc' => false,
                    'comment' => '',
                ),
            'title' =>
                array(
                    'name' => 'title',
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
            'idx_doc_start_status' =>
                array(
                    'name' => 'idx_doc_start_status',
                    'type' => 'normal',
                    'method' => '',
                    'fields' => 'start_status',
                ),
        ),
    'version' => '1.0',
    'engine' => 'innodb',
    'comment' => '文档表',
);