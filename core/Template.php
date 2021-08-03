<?php namespace Core;

class Template{

    /**
     * @var array $messages
     */
    public static $messages = [];

    /**
     * render("./template/base.php",["active_page"=>"patient"]);
     * @param string $path
     * @param array $context
     */
    public static function render($path,$context=[]){
        extract($context);
        require_once($path);
    }

    /**
     * redirect("./medecins/list");
     * 
     */
    public static function redirect($url){
        header("Location:{$url}");
    }

    /**
     * load_message("message to load");
     *@param $message message
     *@param $level
     */
    public static function load_message($message,$level){
        self::$messages[]= [
            "message"=>$message,
            "level"=>$level
        ];
    }
}
?>