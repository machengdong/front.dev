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
     * @param $control
     */
    public function dispatch_default($control)
    {
        try
        {
            $controller = App::control($control);

            $method = strtolower(Request::getMethod());

            if(!method_exists($controller,$method)) {
                throw new \Exception("There is no {$control} method in {$method} class");
            }

            Log::info('Start the request .');

            $output = call_user_func_array([$controller , $method ], []);

            self::__handle_result($output);

            Response::write($output);
            Response::end('');

        } catch (\Exception $e) {
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

    public function dispatch_apis($routes)
    {
        Response::redirect(302,'/404.html');
    }

    /**
     * 执行
     *
     * @param string $path_info
     */
    public function dispatch($path_info = '/')
    {
        if(strpos($path_info,'/api') === 0)
        {
            $this->dispatch_apis($path_info);

        } else {
            $control = $this->preParse($path_info);
            $this->dispatch_default($control);
        }
    }

    /**
     * 预解析PATH_INFO
     *
     * @param $path_info
     * @return $control
     */
    public function preParse($path_info)
    {
        try {
            if (!defined('DEFAULT_MODULE') || !defined('DEFAULT_CONTROL')) {
                throw new \Exception("The default module does not exist .");
            }
            if ($path_info == '/') {//默认模块//默认控制器
                $control = '\app\control\\' . DEFAULT_MODULE . '\\' . ucfirst(DEFAULT_CONTROL);
            } elseif (dirname($path_info) == '/') {//默认模块
                $control = '\app\control\\' . DEFAULT_MODULE . '\\' . ucfirst(basename($path_info, '.html'));
            } else {
                $control = '\app\control' . str_replace('/', '\\', dirname($path_info)) . '\\' . ucfirst(basename($path_info, '.html'));
            }
        } catch (\Exception $e) {
            Kernel::exceptionHandle($e);
        }

        return $control;
    }
}