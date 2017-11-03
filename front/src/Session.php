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
 * Class Session
 *
 * @package Front
 */
class Session
{
    /** @var session_id */
    private $sessionId;

    /** @var session有效期 */
    private $expire = 604800;//60*60*24*7

    /** @var session_name */
    private $sess_key = 'FPSID';

    /** @var session启动状态 */
    private $sess_start = false;

    /**
     * 启动SESSUON
     *
     * 一定在要操作$_SESSION全局变量前调用
     *
     */
    public function start()
    {
        if($this->sess_start == false)
        {
            if (isset($_GET[$this->sess_key]) && $_GET[$this->sess_key]) {
                $this->__checkSessId();
                $_SESSION = $this->__getSession();
                $this->sessionId = $_GET[$this->sess_key];
            } elseif (isset($_COOKIE[$this->sess_key]) && $_COOKIE[$this->sess_key]) {
                $this->__checkSessId();
                $_SESSION = $this->__getSession();
                $this->sessionId = $_COOKIE[$this->sess_key];
            } elseif (isset($_POST[$this->sess_key]) && $_POST[$this->sess_key]) {
                $this->__checkSessId();
                $_SESSION = $this->__getSession();
                $this->sessionId = $_POST[$this->sess_key];
            } else {
                $this->sessionId = $this->genSessionId();
                Cookie::set($this->sess_key, $this->sessionId, time() + $this->expire);
            }

            //Log::debug(var_export($_SESSION,1));
            $this->sess_start = true;
            //注册close方法
            register_shutdown_function([$this, 'close']);
        }
    }

    /**
     * @desc 检查SESSIONID
     *
     * SESSIONID不可为空并且长度一定32位
     */
    public function __checkSessId()
    {
        if(!empty($this->sessionId) || strlen($this->sessionId) !== 32)
        {
            trigger_error('Session_id is illegal',E_USER_ERROR);
        }
    }

    /**
     * @desc 生成SESSIONID
     *
     * @return string
     */
    private function genSessionId()
    {
        return md5(microtime(true).uniqid('',true).getIp().mt_rand(0,99999));
    }

    /**
     * @desc 获取SESSION
     *
     * @return mixed
     */
    public function __getSession()
    {
        return Cache::instance('session')->get($this->sessionId);
    }

    /**
     * @desc 保存SESSION
     *
     * @return mixed
     */
    public function __setSession()
    {
        return Cache::instance('session')->set($this->sessionId,$_SESSION);
    }

    /**
     * @desc 程序执行完后保存SESSION
     *
     * 在register_shutdown_function注册
     */
    public function close()
    {
        if($this->sess_start === true)
        {
            try {
                $this->sess_start = false;
                $this->__setSession();
            }
            catch (\Exception $e)
            {

            }
        }
        else
            Log::error('The program ended unexpectedly and the SESSION was not saved');
    }

}
