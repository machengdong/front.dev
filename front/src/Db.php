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
namespace Front;

final class Db
{
    /**
     * @var 当前类实例
     */
    private static $__instance;

    /**
     * @var 数据驱动类
     */
    private static $__database;

    /**
     * @var 存储场景
     */
    public $storage;

    /**
     * Db constructor.
     *
     * @param null $table_name 设置表名
     */
    public function __construct()
    {

    }

    /**
     * 获取当前类实例
     *
     * @return Db|当前类实例
     */
    public static function instance()
    {
        if(!isset(self::$__instance))
        {
            self::$__instance = new self();
        }
        return self::$__instance;
    }

    /**
     * 指定存储场景并获取驱动实例
     *
     * @param string $storage
     * @param bool $name
     * @return $this
     */
    public function load($storage = 'default',$name = false)
    {
        if(!isset(self::$__database[$storage]))
        {
            $config = Config::get("database.connection");
            if(!array_key_exists($storage,$config))
            {
                trigger_error("The scene is not configured",E_USER_ERROR);
            }
            $conn_config = $config[$storage];
            $driver_class = \Front\Driver\db\Mysqli::class;
            self::$__database[$storage] = new $driver_class($conn_config);
        }
        $this->storage = $storage;
        return $this;
    }

    /**
     * 重载驱动类方法实例
     *
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->db(), $method], $params);
    }

    /**
     * 获取驱动实例
     *
     * @return mixed
     */
    private function db()
    {
        if(!isset($this->storage) && !self::$__database['default']) $this->load();
        return self::$__database[$this->storage];
    }

    /**
     * 实现COUNT方法
     *
     * @return mixed
     */
    public function count()
    {
        /** @var $sql */
        $sql = $this->preHandleCount();
        //echo $sql."<br/>";die;
        $result = $this->db()->count($sql);

        return $result;
    }

    /**
     * 预处理COUNT语句
     *
     * @return string
     */
    public function preHandleCount()
    {
        /** @var $filter 过滤条件 */
        $filter = isset($this->where) ? $this->where : [];
        /** @var $sql  COUNT语句 */
        $sql = "select count(*) as c from {$this->table_name} where ".$this->__filter($filter);

        return $sql;
    }

    /**
     * 数据插入方法
     *
     * @param $data
     * @param bool $replace
     * @return mixed
     */
    public function insert(&$data,$replace = false)
    {
        /** @var $sql  */
        $sql = $this->preHandleInsert($data,$replace);

        $result = $this->db()->execute($sql);

        return $result;
    }

    /**
     * 预处理Insert语句
     *
     * @param array $data
     * @param $replace
     * @return string
     */
    public function preHandleInsert(array $data,$replace)
    {
        $cols = $value = null;
        /** 处理value和cols */
        foreach ((array)array_keys($data) as $v)
        {   /** 加上`符号，避免关键字 */
            $cols   .= (strpos($v,'`') === false ? "`{$v}`" : $v) .',';
            $value  .=  "'".$data[$v]."',";
        }
        $cols  = substr($cols,0,-1);
        $value = substr($value,0,-1);
        /** 生成Insert语句 */
        $sql = ($replace ? 'REPLACE' : 'INSERT') ." INTO {$this->table_name}({$cols}) VALUES ($value);";

        return $sql;
    }

    /**
     * 数据更新方法
     *
     * @param $data
     * @param $filter
     * @return mixed
     */
    public function update(&$data,$filter)
    {
        $sql = $this->preHandleUpdate($data,$filter);

        $result = $this->db()->execute($sql);
        return $result;
    }

    /**
     * 预处理Update语句
     *
     * @param array $data
     * @param $filter
     * @return string
     */
    public function preHandleUpdate(array $data,$filter)
    {
        /** 处理需要更新的字段 */
        $object = $where = null;
        foreach ((array)$data as $k=>$v)
        {
            $object .= " {$k} = '{$v}' " . ',';
        }
        $object = substr($object,0,-1);
        /** 生成Update语句 */
        $sql = " UPDATE {$this->table_name} SET $object WHERE ".$this->__filter($filter);

        return $sql;
    }

    /**
     * 数据删除方法
     *
     * @param array $filter
     * @return mixed
     */
    public function delete(array $filter = [])
    {
        $sql = $this->preHandleDelete($filter);
        $result = $this->db()->execute($sql);
        return $result;
    }

    /**
     * 预处理Delete语句
     *
     * @param array $filter
     * @return string
     */
    public function preHandleDelete(array $filter)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE ".$this->__filter($filter);
        return $sql;
    }

    /**
     * 指定表
     *
     * @param null $table_name
     * @return $this
     */
    public function table($table_name = null)
    {
        $this->table_name = '`'.$table_name.'`';

        return $this;
    }

    /**
     * 设置条件
     *
     * @param array $data
     * @return $this
     */
    public function where(array $data)
    {
        $this->where = $data;
        return $this;
    }

    /**
     * 设置数据长度
     *
     * @param int $limit
     * @param int $offset
     * @return $this
     */
    public function limit($limit = PHP_INT_MAX,$offset = 0)
    {
        $this->offset = $offset;
        $this->limit  = $limit;
        return $this;
    }

    /**
     * 设置排序
     *
     * @param $orderby
     * @return $this
     */
    public function order($orderby)
    {
        $this->orderby = $orderby;
        return $this;
    }

    /**
     * 获取数据
     *
     * @param string $cols
     * @return mixed
     */
    public function get($cols = '*')
    {
        $sql = $this->preHandleSelect($cols);

        $result = $this->db()->select($sql);

        $this->seeSql($sql);

        return $result;
    }

    /**
     * 预处理查询语句
     *
     * @param $cols
     * @return string
     */
    public function preHandleSelect($cols)
    {

        $filter = isset($this->where) ? $this->where : [];
        $sql  = "SELECT {$cols} FROM {$this->table_name} WHERE ".$this->__filter($filter);

        if(isset($this->orderby)) $sql .= " ORDER BY " .$this->orderby;

        if(isset($this->offset) && isset($this->limit))
            $sql .= " LIMIT {$this->offset},{$this->limit} ";
        else
            $sql .= " LIMIT 0,".PHP_INT_MAX;

        return $sql;
    }

    /**
     * 条件过滤器
     *
     * @param $filter
     * @return string
     */
    private function __filter($filter)
    {
        $where = [1];
        foreach ((array)$filter as $k=>$v)
        {
            if(!empty($v) && is_array($v))
            {
                $where[] = $k . ' IN (' . implode(',',$v).')';
            }
            elseif ($k === '__sql__' && !empty($v))
            {
                $where[] = $v;
            }
            elseif (strpos($k,'|') === false && !empty($v))
            {
                $where[] = $k . " = '{$v}'";
            } else //todo
            { }
        }
        return implode(' AND ',$where);
    }

    public function __destruct()
    {

    }

    public function seeSql($sql)
    {
        return $sql;
    }
}


