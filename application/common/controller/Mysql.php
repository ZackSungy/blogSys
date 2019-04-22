<?php

namespace app\common\controller;
use think\Db;

class Mysql
{
    //查看数据库
    public function checkData($name,$where=[])
    {
        return Db::table($name)->where($where)->find();
    }

    //添加单条数据
    public function addData($name,$data=[],$where=[])
    {
        if($this->checkData($name,$where))
            return false;
        Db::table($name)->insert($data);
        return true;
    }

    //添加多条数据
    public function addAllData($name,$data=[[]])
    {
        $count=0;
        for($i=0;$i<count($data);$i++){
            $where=$data[$i];
            if($this->addData($name,$data,$where)){
                $count++;
            }
        }
        return "成功添加"+$count+" 条数据";
    }

    //删除数据
    public function delData($name,$where=[])
    {
        if(Db::table($name)->where($where)->delete() === 0)
            return false;
        return true;
    }

    //修改数据
    public function updataData($name,$where=[],$data=[])
    {
        if(Db::table($name)->where($where)->update($data) === 0)
            return false;
        return true;
    }
}