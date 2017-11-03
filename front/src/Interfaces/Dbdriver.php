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
namespace Front\Interfaces;

interface Dbdriver
{
    public function connect($config = []);
    public function select($sql);
    public function execute($sql,$conn = '');
    public function count($sql);
    public function errorinfo();
    public function beginTransaction();
    public function commit();
    public function rollBack();
}