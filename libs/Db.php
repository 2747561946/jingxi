<?php
namespace libs;
use PDO;

class Db
{
    private static $_obj = null;
    private function __clone(){}
    private $_pdo;
    private function __construct()
    {
        // 连接数据库
        $this->_pdo = new PDO('mysql:host=127.0.0.1;dbname=jingxishop','root','123');
        // 设置编码
        $this->_pdo->exec('SET NAMES utf8');
    }

    // 返回唯一对象
    public static function make()
    {
        if(self::$_obj == null)
            {
            self::$_obj = new self;
        }
        return self::$_obj;
    }

    // 预处理
    public function prepare($sql)
    {
        return $this->_pdo->prepare($sql);
    }

    // 未预处理
    public function exec($sql)
    {
        return $this->_pdo->exec($sql);
    }
}