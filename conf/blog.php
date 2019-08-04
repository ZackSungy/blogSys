<?php
/**
 * Created by PhpStorm.
 * User: ZackSunGY
 * Date: 2019/4/18 0018
 * Time: 17:13.
 */

return [
    'blog_database' => [
        // 数据库类型
        'type' => 'mysql',
        // 服务器地址
        'hostname' => '127.0.0.1',
        // 数据库名
        'database' => '',
        // 数据库用户名
        'username' => '',
        // 数据库密码
        'password' => '',
        // 数据库连接端口
        'hostport' => '3306',
        // 数据库编码默认采用utf8
        'charset' => 'utf8',
        // 数据库表前缀
        'prefix' => '',
    ],

    'view_replace_str' => [
        '__CSS__' => '/static/layui-v2.5.4/layui/css/',
        '__JS__' => '/static/layui-v2.5.4/layui/',
        '__IMG__' => '/static/layui-v2.5.4/layui/images/face/',
    ],

    'name' => [
    'username' => '用户名',
    'password' => '密码',
    'passwordcopy' => '重复密码',
    'phonenumber' => '手机号',
    'email' => '邮箱',
    'captcha' => '验证码',
    ],

    'APP_URL' => 'http://localhost:8098/',

    'url_name' => [
        'home',
        'signin',
        'signinCheck',
        'register',
        'registerCheck',
        'information',
        'captcha',
        'articleEdit',
        'articleEditCheck',
     ],

    // 'cookie' => [
    // // cookie 名称前缀
    // 'prefix' => 'SkyFire',
    // // cookie 保存时间
    // 'expire' => 3600,
    // // cookie 保存路径
    // 'path' => '/',
    // // cookie 有效域名
    // 'domain' => 'localhost:8098//',
    // //  cookie 启用安全传输
    // 'secure' => false,
    // // httponly设置
    // 'httponly' => '',
    // // 是否使用 setcookie
    // 'setcookie' => true,
    // ],
];
