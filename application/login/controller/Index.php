<?php

namespace  app\login\controller;

use app\common\controller\Mysql as my;
use think\Db;
use \think\Request;

class Index
{
    public function login()
    {
        return view("login");
    }

    public function register($warrning)
    {
        return view("register",$warrning);
    }

    public function logincheck()
    {

    }
    //对注册用户进行检测
    public function registercheck(Request $request)
    {
        $data=$request->param();
        $warrning=[];
        $sign=true;
        if($data["anumber"]==""){
            $warrning["anb_war"]="账号不能为空";
            echo "hello";
        }
        else{
            $sign=false;
        }
        if($sign==true){
            $this->register($warrning);
        }
        else{
            $this->login();
        }
    }
}