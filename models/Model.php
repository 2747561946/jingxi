<?php
namespace models;

class model
{
    protected $_db;

    // 操作的表名 由子类设置
    protected $table;
    // 表单中的数据 值由控制器设置
    protected $data;

    public function __construct()
    {
        $this->_db = \libs\Db::make();
    }

    public function insert()
    {
        $keys = [];
        $values = [];
        $token = [];

        foreach($this->data as $k => $v)
        {
            $keys[] = $k;
            $values[] = $v;
            $token[] = '?';
        }

        $keys = implode(',',$keys);
        $token = implode(',',$token); //?,?,?..

        $sql = "INSERT INTO {$this->table}($keys) VALUES($token)";
        $stmt = $this->_db->prepare($sql);
 
        return $stmt->execute($values);
    }

    // 接收表单数据
    public function fill($data)
    {
        // var_dump($data);die;
        // 判断是否在白名单
        foreach($data as $k => $v)
        {
            if(!in_array($k,$this->fillable))
            {
                unset($data[$k]);
            }
        }
        $this->data = $data;
    }

}