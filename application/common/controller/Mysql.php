<?php

namespace app\common\controller;
use think\Db;

class Mysql
{
    //查看数据库
    public function checkDataBase($name,$where=[])
    {
        return Db::table($name)->where($where)->find();
    }

    //添加数据
    public function addDataBase($name,$data=[])
    {

    }

    //删除数据
    public function delDataBase($name,$where=[])
    {

    }

    //修改数据库
    public function updataDataBase($name,$where=[],$data=[])
    {

    }
}