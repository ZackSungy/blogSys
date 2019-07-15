<?php


namespace  app\login\controller;

use app\common\controller\BlogPage as Page;
use app\common\controller\Mysql as Sql;
use think\Db;
use \think\Request;
use think\Controller;

class Index extends Controller
{//username:账号    password:密码     phonenumber:手机号码    email:邮箱    captcha:验证码


    //设置基本配置
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

    //输出页面上方
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

    //登陆页面
    public function login()
    {
        $js=["login"];
        $this->show("login",[],$js);
        return view("login");
    }

    //注册页面
    public function register($id='')
    {
        $js=["login"];
        $this->show("register",[],$js);
        return view("register");
    }

    //对登陆页面进行检测
    public function logincheck(Request $request)
    {
        $data=$request->param();
        $mysql = new Sql();
        $where=[
            "username" => $data["username"],
            "password" => $data["password"],
        ];
        if(!captcha_check($data["captcha"],1)){
            $this->error('验证码不正确');
        }
        else if(!$mysql->checkData("userinfo",$where)){
            $this->error("用户名或账号不存在或密码不匹配!!!");
        }
        else{
            $this->success("登陆成功!!!");
        }
    }

    //对注册用户进行检测
    public function registercheck(Request $request)
    {
        $mysql = new Sql();


        $ifnull=true;
        $data=$request->param();//username:用户名    password:密码     passwordcopy:重复密码     phonenumber:手机号码    email:邮箱    code:验证码

        //循环查找是否为空
        foreach ($data as $key=>$value){
            if($value=="") {
                $ifnull=false;
            }
        }

        

        if(!$ifnull){
            $this->error('必填项不能为空！');
        }
        else if(!captcha_check($data["captcha"],1)){
            $this->error('验证码不正确');
        }
        else if($data["password"]!=$data["passwordcopy"]){
            $this->error('两次填写密码不相同！');
        }
        else {
            $data["rtime"]=time();
            unset($data["passwordcopy"]);
            unset($data["captcha"]);
            $mysql->addData("userinfo",$data);
            $this->success('注册成功！',config("address")["signin"]);
        }
    }

    //测试页面信息
    public function information($id = ' '){
        $mysql = new Sql();
        // phpinfo();
        dump($mysql->checkData("userinfo"));
        // dump(config());
        // dump(config('url_name'));
    }

    //输出验证码
    public function captcha($id=1){
            return captcha($id);
    }
}