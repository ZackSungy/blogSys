<?php


namespace  app\login\controller;

use app\common\controller\BlogPage as Page;
use app\common\controller\Mysql as Sql;
use think\Db;
use \think\Request;
use think\Controller;


import("Vendor.Classes.topthink.think-captcha");

class Index extends Controller
{//anumber:账号    password:密码     pnumber:手机号码    email:邮箱    vcode:验证码
    
    // private $truecode = "";



    public function __construct(){
        parent::__construct();
        $page = new Page();
        $address=[];
        //页脚设置
        config("foot",$page->displayFooter());
        //网站的地址名称设置
        foreach(config('url_name') as $key => $value)
        {
                $address[$value]=config("app_url").$value;
        }
        config("address",$address);
    }

    public function show($name,$css=[],$js=[]){
        $page = new Page();
        $page->buttons = array(
            "首页" => "http://localhost:8098/home",
            "登陆" => "http://localhost:8098/signin",
            "注册" => "http://localhost:8098/register",
        );
        $page->title = $name;

        $page->displayTop($css,$js);
    }

    public function getRandomStr($len){
        $lowercase=range('a','z');
        $capitalized=range('A','Z');
        $number=range('0','9');
        $chars=array_merge($lowercase,$capitalized,$number);
        shuffle($chars);
        $charslen=count($chars)-1;
        $output='';
        for($i=0;$i<$len;$i++){
            $output.=$chars[mt_rand(0,$charslen)];
        }   
        return $output;
    }

    public function login()
    {
        $this->show("login");
        return view("login");
    }

    public function register($id='')
    {
        $js=["login"];
        $this->show("register",[],$js);
        
        return view("register");
    }

    public function logincheck()
    {

    }
    //对注册用户进行检测
    public function registercheck(Request $request)
    {
        $ifnull=true;
//        $i=0;
//        $war=["anb_war","ps_war","psc_war","pn_war","em_war","vc_war"];
        $data=$request->param();//username:用户名    password:密码     passwordcopy:重复密码     phonenumber:手机号码    email:邮箱    code:验证码
//        $warning=["anb_war"=>"","ps_war"=>"","psc_war"=>"","pn_war"=>"","em_war"=>"","vc_war"=>""];//anb_war:账号提示错误      ps_war:密码提示错误      pn_war:手机号码提示错误      em_war:邮箱提示错误

        //循环查找是否为空
        foreach ($data as $key=>$value){
            if($value=="") {
                $ifnull=false;
//                $warning[$war[$i]] = config($key)."不能为空！";
//                $sign=false;
            }
//            $i++;
        }

        dump($data);

        if(!$ifnull){
            $this->error('必填项不能为空！');
        }
        else if($data["password"]!=$data["passwordcopy"]){
            $this->error('两次填写密码不相同！');
        }
        else if(!captcha_check($data["captcha"])){
            $this->error('验证码不正确');
        }
        else {
            $this->success('注册成功！',config("address")["signin"]);
        }
    }

    public function information1($id = ' '){
        // return captcha($id);
        // $this->show('login');
        // return view("login");
        dump(config());
        dump(config('url_name'));
    }

    public function captcha($id=""){
            return captcha($id);
    }
}