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

namespace Front\Mvc;

use Front\App;

class Control
{
    /** @var SESSION实例 */
    public $session;

    /** @var VIEW实例 */
    public $view;

    public function __construct()
    {
        $this->session = App::only(\Front\Session::class);

        $this->view = View::instance();
    }

    /**
     * 模板输出方法
     *
     * @param $file
     * @param array $data
     * @return string
     */
    public function display($file,$data=[])
    {
        return $this->view->display($file,$data);
    }
}