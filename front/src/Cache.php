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

/**
 * Class Cache 缓存管理类
 *
 * @package Front
 */
class Cache
{
    /**
     * @var $__instance
     *
     */
    private static $__instance;

    /**
     * @desc 设置使用缓存场景
     *
     * @param string $name
     * @return mixed
     */
    public static function instance($name = 'default')
    {
        if(!isset(self::$__instance[$name]))
        {
            try {
                /** 获取缓存配置 */
                $config = Config::get('cache');

                if (@array_key_exists($name, $config['storage']))
                {
                    $class = $config['driver'][$config['storage'][$name]['driver']];
                }
                else
                    throw new \Exception('The cache scenario is not configured');

                self::$__instance[$name] = new $class();
            }
            catch (\Exception $e)
            {
                Kernel::exceptionHandle($e);
            }
        }
        return self::$__instance[$name];
    }

    /**
     * @desc 使用默认缓存场景
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([self::instance(),$name],$arguments);
    }

    /**
     * @desc 使用默认缓存场景
     *
     * @usage \Front\Cache::get('86f70e098e31bafe67af415da5d704fc')
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = self::instance();

        switch (count($args))
        {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }

}
