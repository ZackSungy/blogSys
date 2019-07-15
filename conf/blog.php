<?php
/**
 * Created by PhpStorm.
 * User: ZackSunGY
 * Date: 2019/4/18 0018
 * Time: 17:13
 */

return [
    'blog_database'               => [
        // 数据库类型
        'type'            => 'mysql',
        // 服务器地址
        'hostname'        => '127.0.0.1',
        // 数据库名
        'database'        => 'blogSys',
        // 数据库用户名
        'username'        => 'blogSys',
        // 数据库密码
        'password'        => 'blogSys123456',
        // 数据库连接端口
        'hostport'        => '3306',
        // 数据库编码默认采用utf8
        'charset'         => 'utf8',
        // 数据库表前缀
        'prefix'          => '',
    ],

    'view_replace_str' => [
        '__CSS__' =>'/static/blog/css/',
        '__JS__'  =>'/static/blog/js/',
        '__IMG__' =>'/static/blog/img/',
    ],
    
    'name'=>[
    "username"=>"用户名",
    "password"=>"密码",
    "passwordcopy"=>"重复密码",
    "pnumber"=>"手机号",
    "email"=>"邮箱",
    "vcode"=>"验证码",
    ],

    'APP_URL' => 'http://localhost:8098/',

    'url_name' =>[
        "signin",
        "signincheck",
        "register",
        "registercheck",
        "information",
        "captcha",
    ],
    'captcha' => [
    //验证成功是否重置
    'reset'  => true,
    ],
];