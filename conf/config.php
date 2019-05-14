<?php

return [
    'app_status' => 'blog',
    'url_route_on' => true,
    'url_route_must' => false,
    'app_debug' => true,
    'view_replace_str' => [
        '__CSS__' =>'/static/login/css',
        '__JS__'  =>'/static/login/js',
        '__IMG__' =>'/static/login/img',
    ],

    'name'=>
        ["anumber"=>"账号","password"=>"密码","pnumber"=>"手机号","email"=>"邮箱","vcode"=>"验证码"],
];