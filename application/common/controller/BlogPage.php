<?php

namespace  app\common\controller;

class BlogPage
{
    //页面的基本属性
    public $title = 'SkyFire';
    public $keywords = 'SkyFire';
    public $buttons = array(
        '首页' => 'home',
        '登陆' => 'sigin',
        '注册' => 'register',
    );

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    //页面设计
    public function displayTitle()
    {
        echo '<title>'.$this->title."</title>\n";
    }

    public function displaykeywords()
    {
        echo "<meta name = 'keywords' content = '".$this->keywords."'/ >\n";
    }

    public function displayTop($css = [], $js = [])
    {
        echo "<head>\n";
        $this->displayTitle();
        $this->displayKeywords();
        $this->displayStyles();
        echo $this->useCSS($css);
        echo $this->useJS($js);
        $this->displayMenu();
    }

    public function displayBottom()
    {
        echo $this->displayFooter();
    }

    public function displayStyles()
    {
        ?>
            <link href = 'style.css' type = 'text/css' rel = 'styleheet'>
            <style>
                body{
                    background-color:#c2c2c2;
                }
            </style>
        <?php
    }

    public function isURLCurrentPage($url)
    {
        if (strpos($url, $_SERVER['REQUEST_URI']) === false) {
            return false;
        } else {
            return true;
        }
    }

    public function displayButton($name, $url, $active = true)
    {
        if ($active) {
            ?>
                    <li class="layui-nav-item"><a href=<?=$url; ?>><?=$name; ?></a></li>
                    <?php
        } else {
            ?>
                    <li class="layui-nav-item layui-this"><a><?=$name; ?></a></li>
                    <?php
        }
    }

    public function displayMenu()
    {
        ?>
        <div class="layui-header header header-doc layui-bg-black">
        <div class="layui-main">
        <img class ="layui-col-md2" src=<?=config('view_replace_str')['__IMG__'].'logo.gif'; ?> style="height:60px">
        <div class="layui-col-md4" style="height:60px;">
        <label class="layui-form-label layui-icon-search layui-icon" style="line-height:40px;"></label>
        <div class="layui-input-block" style="margin-top:10px;">
        <input type="text" name="title" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" >
        </div>
        </div>
        <div class="layui-col-md2"><a>$nbsp</a></div>
        <ul class="layui-nav layui-col-md4" lay-filter="">        
        <?php
        while (list($name, $url) = each($this->buttons)) {
            $this->displayButton($name, $url, !$this->isURLCurrentPage($url));
        } ?>
        
        </ul>
        </div>
        </div>
        <?php
    }

    public function displayFooter()
    {
        return "<div class='layui-footer footer footer-doc'>
        <div class='layui-main'>
            <p>CopyRight:ZackSunGY@2019</p>
        </div>
        </div>\n";
    }

    public function useCSS($css)
    {
        array_push($css, 'layui');
        $list = '';
        while (list($key, $value) = each($css)) {
            $list = $list.'<link rel="stylesheet" href="'.config('view_replace_str')['__CSS__'].$value.'.css">';
        }

        return $list;
    }

    public function useJS($js)
    {
        array_push($js, 'layui');
        $list = '';
        while (list($key, $value) = each($js)) {
            $list = $list.'<script type="text/javascript" src='.config('view_replace_str')['__JS__'].$value.'.js></script>';
        }

        return $list;
    }
}
?>