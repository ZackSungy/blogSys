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

    public function register()
    {
        return view("register",[

        ]);
    }

    public function logincheck()
    {

    }

    public function registercheck(Request $request)
    {
        dump($request->param());
    }
}