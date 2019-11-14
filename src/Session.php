<?php


namespace EasySwoole\Session;


use Swoole\Coroutine;

class Session
{
    private static $contextInstance = [];

    private $handler;

    function setStorageHandler(StorageInterface $storage)
    {

    }


    public static function getInstance():Session
    {
        $cid = Coroutine::getCid();
        if(!isset(self::$contextInstance[$cid])){
            self::$contextInstance[$cid] = new static();
        }
        return self::$contextInstance[$cid];
    }

    function token()
    {

    }

}