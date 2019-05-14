<?php


namespace  app\login\controller;

use app\common\controller\Mysql as my;
use think\Db;
use \think\Request;
use think\Controller;

class Index extends Controller
{//anumber:账号    password:密码     pnumber:手机号码    email:邮箱    vcode:验证码

    public function login()
    {
        return view("login");
    }

    public function register($data=["anumber"=>"","password"=>"","passwordcopy"=>""," pnumber"=>"","email"=>"","vcode"=>""],$waring=["anb_war"=>"*必填","ps_war"=>"*必填","psc_war"=>"*必填","pn_war"=>"*必填","em_war"=>"*必填","vc_war"=>"*必填"])
    {
        $this->assign($data);
        $this->assign($waring);
        return view("register");
    }

    public function logincheck()
    {

    }
    //对注册用户进行检测
    public function registercheck(Request $request)
    {
        $i=0;
        $war=["anb_war","ps_war","psc_war","pn_war","em_war","vc_war"];
        $data=$request->param();//anumber:账号    password:密码     passwordcopy:重复密码     pnumber:手机号码    email:邮箱    vcode:验证码
        $warning=["anb_war"=>"","ps_war"=>"","psc_war"=>"","pn_war"=>"","em_war"=>"","vc_war"=>""];//anb_war:账号提示错误      ps_war:密码提示错误      pn_war:手机号码提示错误      em_war:邮箱提示错误
        $sign=true;

        //循环查找是否为空
        foreach ($data as $key=>$value){
            if($value=="") {
                $warning[$war[$i]] = config($key)."不能为空！";
                $sign=false;
            }
            $i++;
        }

        if(!$sign){
            return $this->register($data,$warning);
        }
        else{
            return $this->login();       }
    }
}