<?php

namespace  app\common\controller;

class BlogPage{
    //页面的基本属性
    public $title="SkyFire";
    public $keywords="SkyFire";
    public $buttons = array(
        "首页" => "home",
        "登陆" => "sigin",
        "注册" => "register",
    );

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    //页面设计
    public function displayTitle(){
        return "<title>".$this->title."</title>\n";
    }

    public function displaykeywords(){
        return "<meta name = 'keywords' content = '".$this->keywords."'/ >\n";
    }

    public function displayTop($css=[],$js=[]){
        echo "<head>\n";
        echo $this -> displayTitle();
        echo $this -> displayKeywords();
        echo $this -> displayStyles();
        echo $this->useCSS($css);
        echo $this->useJS($js);
        echo "</head>\n";
        echo $this->displayMenu();
        // $this -> displayFooter();
        // echo "</body>\n</html>\n";
    }

   public function displayBottom(){
       echo $this -> displayFooter();
   }

    public function displayStyles(){
            return "<link href = 'style.css' type = 'text/css' rel = 'styleheet'>\n";
    }

    public function displayHead(){
            echo "<header><h1>SkyFire</h1></header>\n";
    }

    public function isURLCurrentPage($url){
        if(strpos($_SERVER['PHP_SELF'],$url)===false){
            return false;
        }
        else{
            return true;
        }
    }

    public function displayButton($name,$url,$active=true){
        if($active){
                    return '<div class="menuitem">
                    <a href="'.$url.'">
                    <!-- <img src="s-logo.gif" alt="" height="20" width="20" /> -->
                    <span class="menutext">'.$name.'</span>
                    </a>
                    </div>';
                }
                else{
                    return '<div class="menuitem">
                    <!-- <img src="side-logo.gif"> -->
                    <span class="menutext">'.$name.'</span>
                    </div>';
                }
    }

    public function displayMenu(){
        $menu = "<nav>";
        while(list($name,$url)=each($this->buttons)){
            $menu = $menu.$this->displayButton($name,$url,!$this->isURLCurrentPage($url));
        }
        $menu = $menu."</nav>\n";

        return $menu;
    }

    public function displayFooter(){
        return "<footer>
            <p>CopyRight:ZackSunGY@2019</p>
        </footer>\n";
    }

    public function useCSS($css){
        $list ="";
        while(list($key,$value) = each($css)){
            $list = $list.'<link rel="stylesheet" href="'.config('view_replace_str')['__CSS__'].$value.'.css">\n';
        }
        return $list;
    }

    public function useJS($js){
        $list ="";
        while(list($key,$value) = each($js)){
            $list = $list.'<script type="text/javascript" src='.config('view_replace_str')['__JS__'].$value.'.js></script>
            ';
        }
        return $list;
    }
}
?>