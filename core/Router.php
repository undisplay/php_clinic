<?php namespace Core;

class Router{

    /**
     * @var array $routes
     */
    private $routes = [];

    /**
     * connect("POST","client/",function(){});
     * @param string $method  POST | GET | PUT | PATH | OPTION | HEAD
     * @param string $url
     * @param function $callback
     * 
     * @return null
     */
    public function connect($method, $url, $callback){
        $this->routes[] = ['method' => $method, 'url' => $url, 'callback' => $callback];
    }

    /**
     * execute();
     * 
     * @return null
     */
    public function execute(){
        $reqUrl = explode("?",$_SERVER['REQUEST_URI'],2)[0];
        $reqMet = $_SERVER['REQUEST_METHOD'];

        foreach($this->routes as  $route) {
            // convert urls like '/patient/:id' to reg
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $matches = Array();
            // check if the current request matches the expression
            if($reqMet == $route['method'] && preg_match($pattern, $reqUrl, $matches)) {
                // remove the first match
                array_shift($matches);
                // call the callback with the matched positions as params
                return call_user_func_array($route['callback'],$matches);
            }
        }
    }
}
?>