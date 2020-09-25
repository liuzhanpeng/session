<?php

namespace Lzpeng\EasySwoole\Session;

use EasySwoole\RedisPool\Redis;

class SessionRedisHandler implements \SessionHandlerInterface
{
    private $redisPool;
    private $lifeTime;
    private $prefix = 'zsnewshuodong_session_';

    public function __construct(Redis $pool, int $lifeTime = 3600)
    {
        $this->redisPool = $pool;
        $this->lifeTime = $lifeTime;
    }

    public function close()
    {
        return true;
    }

    public function destroy($session_id)
    {
        return $this->redisPool::defer('redis')->del($this->prefix . $session_id);
    }

    public function gc($maxlifetime)
    {
        //空实现
    }

    public function open($save_path, $name)
    {
        return true;
    }

    public function read($session_id)
    {
        return $this->redisPool::defer('redis')->get($this->prefix . $session_id);
    }

    public function write($session_id, $session_data)
    {
        return $this->redisPool::defer('redis')->set($this->prefix . $session_id, $session_data, $this->lifeTime);
    }
}
