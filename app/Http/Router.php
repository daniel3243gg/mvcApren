<?php
namespace App\Http;
use App\Http\Response;
use ReflectionFunction;
class Router extends Response{
    private $url = '';

    private $prefix = '';

    private $routers = [];

    private $request;

    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    private function setPrefix(){

        $parseUrl = parse_url($this->url);

        $this->prefix = $parseUrl['path'] ?? '';
    }
    
    private function addRoute($method,$route,$params = []){
        foreach($params as $key=>$value){
            
            if($value instanceof \Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }

        }


        $params['variables'] = [];
        $patternVariable= '/{(.*?)}/';
    

        if(preg_match_all($patternVariable,$route,$matches)){

            $route = preg_replace($patternVariable,'(.*?)',$route);
            $params['variables'] = $matches[1];
        }
        
        $patternRoute = '/^'.str_replace('/','\/',$route) . "$/";
        $this->routers[$patternRoute][$method] = $params;
        
    }

    public function get($route, $params = []){
        return $this->addRoute("GET",$route,$params);
    
    }
    public function delete($route, $params = []){
        return $this->addRoute("DELETE",$route,$params);

    }
    public function post($route, $params = []){
        return $this->addRoute("POST",$route,$params);

    }
    public function put($route, $params = []){
        return $this->addRoute("PUT",$route,$params);

    }
    private function getUri(){
        $uri = $this->request->getUri();
    
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($xUri);
    }
    

    private function getRoute(){
        $uri = $this->getUri();  // Adicione os parênteses aqui
        $httpMethod = $this->request->getHttpMethod();
        foreach($this->routers as $patternRoute => $methods){
            
            

            if(preg_match($patternRoute, $uri,$matches)){
               
                
                if($methods[$httpMethod]){
                    unset($matches[0]);
                    

                    //chaves

                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys,$matches);
                    $methods[$httpMethod]['variables']['request']= $this->request;
                    
                    
                    
                    
                    return $methods [$httpMethod];
    
                }
                throw new \Exception("Método não permitido", 405);
            }
    
        }
        throw new \Exception("URL NÃO ENCONTRADA", 404);
    }

    public function run(){
        try{
            $route = $this->getRoute();
            if(!isset($route['controller'])){
              throw new \Exception("A URL nao pode ser processada", 500);

            }
            $args = [];
            $reflection = new ReflectionFunction($route['controller']);
            foreach($reflection ->getParameters() as $parameter){
                $name = $parameter->getName();
                $args[$name]=$route['variables'][$name] ?? '';
            }



            return call_user_func_array($route['controller'],$args);
        }catch(Exception $e){
            return new Response($e->getCode(),$e->getMessage());
        }

    }
}