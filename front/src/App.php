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
 * Class App 应用服务类
 *
 * @package Front
 */
class App
{
    /**
     * @var $__instance
     */
    private static $__instance;

    /**
     * @var $__responseInstance
     */
    private static $__responseInstance;

    /**
     *
     * @param $control
     * @return mixed
     */
    public static function control($control)
    {
        $object = App::only($control);
        if($object instanceof \Front\Mvc\Control)
        {
            return $object;
        }
        trigger_error("{$control} The Controller is not legitimate ",E_USER_ERROR);
    }

    /**
     *
     * @param $model
     * @return mixed
     */
    public static function model($model)
    {
        $object = App::only($model);
        if($object instanceof \Front\Mvc\Model)
        {
            return $object;
        }
        trigger_error("{$model} The Model is not legitimate ",E_USER_ERROR);
    }

    /**
     * 设置响应类的实例，Swoole\Http\Response
     *
     * @param $responseInstance
     */
    public static function setResponseInstance($responseInstance)
    {
        self::$__responseInstance = $responseInstance;
    }

    /**
     * 获取响应类的实例，没有设置的时候就使用\Front\Driver\Response\Response::class
     *
     * @return mixed
     */
    public static function getResponseInstance()
    {
        if(!isset(self::$__responseInstance))
        {
            return self::only(\Front\Driver\Response\Response::class);
        }else{
            return self::$__responseInstance;
        }
    }

    /**
     * @desc 接受请求参数
     *
     * @param null $name
     * @param bool $original
     * @return array|bool|string
     */
    public static function input($name = null,$original = false)
    {
        if($original)
        {
            $data = file_get_contents("php://input");
        }else{
            //$_GET['PATH_INFO'] = $_SERVER['PATH_INFO'];/** swoole 拿不到get时，最好用这个 */
            $data = array_merge($_GET,$_POST);
        }

        if($name)
        {
            $data = $data[$name];
        }
        return $data;
    }

    /**
     * @desc 保存类实例
     *
     * @param $class_name
     * @return mixed
     */
    public static function only($class_name)
    {
        if(!isset(self::$__instance[$class_name]))
        {
            self::$__instance[$class_name] = new $class_name();
        }
        return self::$__instance[$class_name];
    }
}