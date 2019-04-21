<?php

namespace app\index\controller;


use think\Request;

class Index
{
    public  function __construct()
    {
        config('before','IndexAction');
    }

    public function index(Request $request)
    {
        dump($request->domain());
        dump($request->pathinfo());
        dump($request->path());


    }

    //测试路由route
    public function info($id)
    {
        return $id;
    }
}