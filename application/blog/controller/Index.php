<?php

namespace  app\blog\controller;

use app\common\controller\BlogPage as Page;
use app\common\controller\Mysql as Sql;
use app\common\controller\Safe;
use think\Request;
use think\Controller;
use think\Cookie;
use think\Session;

class Index extends Controller
{
    //username:账号    password:密码     phonenumber:手机号码    email:邮箱    captcha:验证码
    //设置基本配置
    public function __construct()
    {
        parent::__construct();
        $page = new Page();
        $address = [];
        //页脚设置
        config('foot', $page->displayFooter());
        // 网站的地址名称设置
        foreach (config('url_name') as $key => $value) {
            $address[$value] = config('app_url').$value;
        }
        config('address', $address);
    }

    //主页面
    public function home()
    {
        $mysql = new Sql();
        $this->assign('signin', 'no');
        if (Session::has('username')) {
            $this->assign('signin', 'yes');
            $this->assign('username', Session::get('username'));
        }
        $this->show('home');
        $this->assign('question', $mysql->checkData('question_list'));

        return view('home');
    }

    //登陆页面
    public function signIn()
    {
        $js = ['signin'];
        $this->show('signin', [], $js);

        return view('signin');
    }

    //注册页面
    public function register($id = '')
    {
        $js = ['signin'];
        $this->show('register', [], $js);

        return view('register');
    }

    //编写文章页面
    public function articleEdit()
    {
        $mysql = new Sql();
        $this->show('articleEdit');
        $this->assign('type', $mysql->checkData('question_type'));

        return view('articleEdit');
    }

    //用户页面
    public function user()
    {
        $this->show('user');

        return view('user');
    }

    //设置页面
    public function set()
    {
        $this->show('set');

        return view('set');
    }

    //登出
    public function logout()
    {
        Session::delete('username');
        Session::destroy();
        $this->success('登出成功!!!', config('address')['home']);
    }

    //输出页面上方
    public function show($name, $css = [], $js = [])
    {
        $page = new Page();
        if (Session::has('username')) {
            $page->buttons = array(
            '首页' => '/home',
            Session::get('username') => '/user',
            '设置' => '/set',
            '登出' => '/logout',
         );
        }

        $page->title = $name;

        $page->displayTop($css, $js);
    }

    //对登陆页面进行检测
    public function signInCheck(Request $request)
    {
        $data = $request->param();
        $mysql = new Sql();
        $safe = new Safe();
        $salt = $mysql->checkData('userinfo', ['username' => $data['username']])[0]['salt'];
        $where = [
            'username' => $data['username'],
            'password' => $safe->encrypt($data['password'], $salt),
        ];
        if (!captcha_check($data['captcha'], 1)) {
            $this->error('验证码不正确');
        } elseif (!$mysql->checkData('userinfo', $where)) {
            $this->error('用户名或账号不存在或密码不匹配!!!');
        } else {
            Session::set('username', $data['username']);
            Cookie::set('username', $data['username'], 10);
            Cookie::set('token', $data['token'], 10);
            $this->success('登陆成功!!!', config('address')['home']);
        }
    }

    //对注册用户进行检测
    public function registerCheck(Request $request)
    {
        $mysql = new Sql();
        $safe = new Safe();
        $ifnull = true;
        $data = $request->param(); //username:用户名    password:密码     passwordcopy:重复密码     phonenumber:手机号码    email:邮箱    code:验证码
        //循环查找是否为空
        foreach ($data as $key => $value) {
            if ($value == '') {
                $ifnull = false;
            }
        }
        //对注册用户的输入判断
        if (!$ifnull) {
            $this->error('必填项不能为空！');
        } elseif (!captcha_check($data['captcha'], 1)) {
            $this->error('验证码不正确');
        } elseif ($data['password'] != $data['passwordcopy']) {
            $this->error('两次填写密码不相同！');
        } elseif ($mysql->checkData('userinfo', ['username' => $data['username']])) {
            $this->error('该用户已经存在！');
        } else {
            $password = $data['password'];
            $salt = $safe->salt();
            $data['password'] = $safe->encrypt($password, $salt);
            $data['salt'] = $salt;
            $data['rtime'] = time();
            unset($data['passwordcopy']);
            unset($data['captcha']);
            dump($data);
            dump($mysql->addData('userinfo', $data));
            $this->success('注册成功！', config('address')['signin']);
        }
    }

    //发布主题
    public function articleEditCheck(Request $request)
    {
        $mysql = new Sql();
        $data = $request->param();

        $data['fromuser'] = 'ZackSunGY';
        $data['date'] = date('Y-m-d H:i:s');
        dump($data);

        $this->success($mysql->addData('question_list', $data), config('address')['home']);
    }

    //测试页面信息
    public function information($id = '')
    {
        $mysql = new Sql();
        $safe = new Safe();

        echo Session::has('username');
        echo Session::get('username');
        // Session::delete('username');
        Session::destroy();
        echo session_id();
    }

    //输出验证码
    public function captcha($id = 1)
    {
        return captcha($id);
    }
}
