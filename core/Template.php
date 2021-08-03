<?php namespace Core;

class Template{

    /**
     * render("./template/base.php",["active_page"=>"patient"]);
     * @param string $path
     * @param array $context
     * @return null
     */
    public static function render($path,$context=[]){
        extract($context);
        require_once($path);
    }

    /**
     * redirect("./medecins/list");
     * 
     * @return null
     */
    public static function redirect($url){
        header("Location:{$url}");
    }
}
?>