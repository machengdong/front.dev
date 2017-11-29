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

//--------------- 函数助手 ----------------\\
//
//----------------------------------------\\

if(!function_exists('getIp')) {
    /**
     * 获取客户端IP
     *
     * @return bool
     */
    function getIp()
    {
        return \Front\Request::getIp();
    }
}

if(!function_exists('mkdir_p')) {
    /**
     * 递归创建文件夹
     *
     * @param $dir
     * @param int $dirmode
     * @return bool
     */
    function mkdir_p($dir,$dirmode = 0777){
        //var_dump($dir);
        if(!is_dir($dir)) mkdir($dir,$dirmode,true);
        return is_dir($dir);
    }
}

if(!function_exists('readline')) {
    function readline($prompt){
        echo $prompt;
        $input = '';
        while(1){
            $key = fgetc(STDIN);
            switch($key){
                case "\n":
                    return $input;
                default:
                    $input .= $key;
            }
        }
    }
}

if(!function_exists('readline_add_history')) {
    function readline_add_history($line){
        !empty($line) && \Front\Log::history($line);
    }
}

if(!function_exists('readline_write_history')) {
    function readline_write_history($file){}
}

if(!function_exists('readline_completion_function')) {
    function readline_completion_function($callback){}
}

if(!function_exists('readline_list_history')) {
    function readline_list_history()
    {
        $logfile = DATA_PATH . '/logs/history.php';
        if (file_exists($logfile)) print_r(file_get_contents($logfile));
    }
}

if(!function_exists('dump')) {
    /**
     * @param array $data
     * @param bool $exit
     */
    function dump($data = [],$exit = false)
    {
        ob_start();
        var_dump($data);
        $output = ob_get_clean();

        $html  = '<div id="_var_dump_" style="z-index:9999999;height:300px;overflow:auto;font-size:14px;width:100%;background-color:#3c3839;color:#5cff00;">';
        $html .= '<pre>'.$output.'</pre></div><br>';
        $html .= "<script>if(getComputedStyle(document.body).margin != '0px'){document.body.style.margin=0;}</script>";
        //echo $html;
        \Front\Response::write($html);
    }
}


