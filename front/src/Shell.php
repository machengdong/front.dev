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


class Shell
{
    private static $apply_command;

    public function __construct($apply_command)
    {
        self::$apply_command = $apply_command;
    }

    public static function init(array $apply_command)
    {
       return new self($apply_command);
    }

    public function run()
    {
        ignore_user_abort(false);
        ob_implicit_flush(1);
        ini_set('implicit_flush',true);
        $this->prePrint();
        $i = 1;
        while (true)
        {
            $line = readline($i++." #> ");
            readline_add_history($line);
            $this->perHandle($line);
        }
    }

    public function prePrint()
    {
        echo " \e[35mBase".' Shell '.'V 1'.'.0'." You can use system commands: {help|history|exit}\n\e[0m";
    }

    private function perHandle($param)
    {
        if(empty($param))
            echo "\e[31mCommand is empty!\e[0m\n";
        else
        {
            $argv = preg_split ("/[\s]+/", $param);
            $cmd  = array_shift($argv);
            switch ($cmd)
            {
                case 'help':
                    $this->getCmdList();
                    break;
                case 'history':
                    readline_list_history();
                    break;
                case 'exit':
                case 'EXIT':
                    exit("\e[35mGoodbye...\e[0m\n");
                    break;
                default:
                    $this->exec($cmd,$argv);
            }

        }
    }

    private function exec($cmd,$argv)
    {
        if(array_key_exists($cmd,self::$apply_command))
        {
            if(array_key_exists('cmd',self::$apply_command[$cmd]))
            {
                $target_class = self::$apply_command[$cmd]['cmd'];
                $object = new $target_class;
                if(isset($target_class) && ($object instanceof \Front\Interfaces\Command))
                {
                    call_user_func_array([$object,'exec'],$argv);
                }else
                    echo "\e[31mCommand not registered\n\e[0m";
            }else
                echo "\e[31mCommand not registered\n\e[0m";
        }else
            echo "\e[31mCommand not registered\n\e[0m";

    }

    private function getCmdList()
    {
        foreach (self::system_command() as $cmd=>$v)
        {
            echo "\033[35m{$cmd}"."\t\t\t"."\033[34m{$v['desc']}"."\n";
        }
        foreach (self::$apply_command as $cmd=>$v)
        {
            echo "\033[32m{$cmd}"."\t\t\t"."\033[33m{$v['desc']}"."\n";
        }
        echo "\033[0m";
    }


    private static function system_command()
    {
        return [
            'help'=>['cmd'=>'','desc'=>'Help users get a list of commands'],
            'history'=>['cmd'=>'','desc'=>'Gets a list of historical commands'],
            'exit'=>['cmd'=>'','desc'=>'Exit the current interaction mode'],
        ];
    }
}
