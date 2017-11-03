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
namespace Front\Driver\db;

use Front\Interfaces\Dbdriver;

class Mysqli implements Dbdriver
{

    public  $config;

    public static $resource;

    public function __construct($conf = [])
    {
        $this->config = $conf;
    }

    public function connect($conf = [])
    {
        $iden = $this->getIdent($conf);

        if(!isset(self::$resource[$iden]))
        {
            self::$resource[$iden] = @mysqli_connect($conf['db_host'],$conf['db_user'],$conf['db_pass'],$conf['db_name']);
        }

        if(!self::$resource[$iden] || !is_object(self::$resource[$iden]))
        {
            trigger_error('Database connection error: '.mysqli_connect_error(),E_USER_ERROR);
        }

        return self::$resource[$iden];
    }

    public function select($sql)
    {
        if($result = $this->execute($sql))
        {
            $data = [];
            while ($row = mysqli_fetch_assoc($result))
            {
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        return false;
    }

    public function execute($sql,$conn = null)
    {
        !empty($conn) or $conn = $this->connect($this->config);

        $this->conn = $conn;

        if($result = mysqli_query($conn,$sql))
        {
            if(defined(DEBUG_OPEN)&&DEBUG_OPEN)\Front\Log::debug("_sql: ".$sql);

            return $result;
        }
        else goto execute_error;

        execute_error:
        {
            $error = "sql statement error : ".$sql;
            \Front\Log::error($error);
            trigger_error("sql statement error ",E_USER_ERROR);
            return false;
        }
    }
    public function count($sql)
    {
        $sql = preg_replace(array(
            '/(.*\s)LIMIT .*/i',
            '/^select\s+(.+?)\bfrom\b/is'
        ),array(
            '\\1',
            'select count(*) as c from'
        ),trim($sql));

        $row = $this->select($sql);
         //echo $sql;die;
        if($row)return intval($row[0]['c']);

        return false;
    }

    public function errorinfo()
    {
        return true;
    }

    public function beginTransaction()
    {
        $this->execute('start transaction');
        return true;
    }

    public function commit()
    {
        $this->execute('commit');
        return true;
    }

    public function rollBack()
    {
        $this->execute('rollback');
        return true;
    }

    private function getIdent($conf = [])
    {
        $k  = $conf ? : $this->config;
        $ident = md5(serialize($k));
        return $ident;
    }

    public function close()
    {
        mysqli_close($this->conn);
    }

    public function __destruct()
    {
        $this->close();
    }
}