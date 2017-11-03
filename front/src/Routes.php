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
 * Class Routes
 *
 * @package Front
 */
class Routes
{
    /**
     * 执行请求
     *
     * @param $object
     */
    public static function dispatch_default($object)
    {
        try
        {
            if(!$object) Response::redirect(302,'/404.html');

            self::__check_cache();

            list($control,$method) = explode('@',$object);
            //$output = App::control($control)->$method();
            if(method_exists(App::control($control),$method))
            {
                $output = call_user_func_array([ App::control($control) , $method ], []);
            }
            else
            {
                throw new \Exception("There is no {$control} method in {$method} class");
            }

            self::__handle_result($output);

            Response::end($output);
        }
        catch (\Exception $e)
        {
           \Front\Kernel::exceptionHandle($e);
        }

    }

    /**
     * 处理结果
     *
     * @param $output
     */
    private static function __handle_result(&$output)
    {
        $is_ajax = \Front\Request::isAjax();

        (!empty($output) && is_array($output)) && $output = json_encode($output,JSON_UNESCAPED_UNICODE);

    }

    /**
     * 检查缓存
     *
     */
    private static function __check_cache()
    {

    }


    public static function dispatch_apis($routes)
    {
        Response::redirect(302,'/404.html');
    }

    /**
     * 执行
     *
     * @param string $path_info
     */
    public static function dispatch($path_info = '')
    {
        /** 预解析PATH_INFO */
        $routes = Routes::preParse($path_info,$module);
        /** 将api和其他模块分开处理 */
        switch ($module)
        {
            case 'api':
                self::dispatch_apis($routes);
                break;
            default:
                self::dispatch_default($routes);
                break;
        }
    }

    /**
     * 预解析PATH_INFO
     *
     * @param $path_info
     * @param string $module
     * @return null
     */
    public static function preParse($path_info,&$module='site')
    {

        $depth = @strpos($path_info,'/',1);
        if($depth === false)
        {
            $module = 'site';
            $target = $path_info;
        }
        else
        {
            $module = substr($path_info,1,$depth-1);
            $target = substr($path_info,$depth);
        }

        $routes   = self::load($module);

        if(@array_key_exists($target,$routes))
        {
            return $routes[$target];
        }

        return null;

    }

    /**
     * 加载路由表
     *
     * @param $scene
     * @return mixed|null
     */
    private static function load($scene)
    {
        return Config::get("route.{$scene}");
    }

}