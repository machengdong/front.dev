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
namespace app\model;

use Front\Mvc\Model;
use Front\App;

class User extends Model
{
    private $userLoginInfoItem = ['user_id'=>'admin_user_id','username'=>'admin_user_username'];

    public function login(array $input,&$msg=null)
    {
        $username = $input['username'];
        $password = $input['password'];
        if(!$username || !$password)
        {
            $msg = '帐户名或密码为空。';
            return false;
        }
        $userInfo = $this->get('*',['account'=>$username]);
        $userInfo = $userInfo[0];
        if(!$userInfo || !$userInfo['password'])
        {
            $msg = '帐户不存在。';
            return false;
        }
        if(md5($username.$password.$userInfo['savetime']) !== $userInfo['password'])
        {
            $msg = '密码不正确。';
            return false;
        }
        if($userInfo['start_status'] == 'N')
        {
            $msg = '帐户没启用。';
            return false;
        }
        $this->setLoginInfo($userInfo);
        return true;
    }

    public function logout()
    {
        App::only(\Front\Session::class)->start();
        foreach ($this->userLoginInfoItem as $k=>$v)
        {
            $_SESSION[$v] = '';
        }
        unset($_COOKIE[SESSION_NAME]);
        \Front\Cookie::set(SESSION_NAME,'',time()-1);
        return true;
    }

    public function setLoginInfo(array $userInfo)
    {
        App::only(\Front\Session::class)->start();
        foreach ($this->userLoginInfoItem as $k=>$v)
        {
            $_SESSION[$v] = $userInfo[$k];
        }
        //var_dump($_SESSION);
        return true;
    }

    public function getLoginInfo(&$userInfo = [])
    {
        App::only(\Front\Session::class)->start();
        foreach ($this->userLoginInfoItem as $k=>$v)
        {
            $userInfo[$v] = $_SESSION[$v];
        }
        return true;
    }

    public function isLogin(&$userInfo = [])
    {
        $this->getLoginInfo($userInfo);

        //var_dump($userInfo);die;
        foreach ($this->userLoginInfoItem as $k=>$v)
        {
            if(!$userInfo[$v])
            {
                return false;
            }
        }
        return true;
    }
}