<?php

namespace  app\login\controller;

use app\common\controller\Mysql as my;
use think\Db;

class Index
{
    public function index()
    {
        return view("index");

    }
}