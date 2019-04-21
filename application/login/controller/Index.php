<?php

namespace  app\login\controller;

use app\common\controller\Mysql as my;
use think\Db;

class Index
{
    public function index()
    {
        $M = new my();
//        dump($M->connect('blog_database'));

        dump($M->checkDataBase('itembank_question',['id' => 2]));
//        $M->query("show databases");
    }
}