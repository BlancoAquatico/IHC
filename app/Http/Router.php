<?php

namespace App\Http;
use Closure;
use Exception;
class Router
{    
    /**
     * URL completa do projeto (RAIZ)
     *
     * @var string
     */
    private $url = '';
    
    /**
     * Prefixo de todas as rotas
     *
     * @var string
     */
    private $prefix = '';
    
    /**
     * Índice de rotas
     *
     * @var array
     */
    private $routes = [];
    
    /**
     * Instancia de Resquest
     *
     * @var Request
     */
    private $request;
    
    /**
     * Método responsável por iniciar a classe
     *
     * @param  string $url
     */
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url     = $url;
        $this->setPrefix();
    }
    
    /**
     * Método responsável por definir o prefixo das rotas
     *
     * @return void
     */
    private function setPrefix()
    {
        /* Informações da URL atual */
        $parseUrl = parse_url($this->url);

        /* Define o prefixo */
        $this->prefix = $parseUrl['path'] ?? '';
    }
    
    /**
     * Método responsável por adicionar um rota á classe
     *
     * @param  string $method
     * @param  string $route
     * @param  array  $params
     * 
     * @return void
     */
    private function addRoute($method, $route, $params = [])
    {

        /* Validação dos parâmetros */
        foreach($params as $key => $value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        /* Padrão de validação da URL */
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        
        /* Adiciona a rota dentro da classe */
        $this->routes[$patternRoute][$method] = $params;

        //echo "<pre>"; print_r(value: $this); echo "</pre>"; 

    }
    
    /**
     * Método responsável por definir uma rota de GET
     *
     * @param  string $route
     * @param  array  $params
     * 
     * @return void
     */
    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }
    
    /**
     * Método responsável a URI desconsiderando o prefixo
     *
     * @return string
     */
    private function getUri()
    {
        /* Uri da request */ 
        $uri = $this->request->getUri();

        /* Fatia a URI com préfixo */
        $xUri = strlen($this->prefix) ? explode(strtolower($this->prefix), $uri) : [$uri];

        /* Retorna a URI sem o préfixo */
        return end($xUri);
    }
    
    /**
     * Método responsável por retornar os dados da Rota atual
     *
     * @return array
     */
    private function getRoute()
    {
        /* URI */
        $uri = $this->getUri();

        /* Method */
        $httpMethod = $this->request->getHttpMethod();

        /* Valida as Rotas */
        foreach($this->routes as $patternRoute => $methods){

            /* Verifica se a URI bate o padrão */
            if(preg_match($patternRoute, $uri)){
                
                /* Verifica o método */
                if($methods[$httpMethod]){

                    /* Retorno dos parâmetros da Rota */
                    return $methods[$httpMethod];
                }

                /* Método não permitido */
                throw new Exception("Método não permitido", 405);
            }

            /* URL não encontrada */
            throw new Exception("URL não encontrada", 404);
            
        }
    }
    
    /**
     * Método responsável por executar a rota atual
     *
     * @return Response
     */
    public function run()
    {
        try{
            $route = $this->getRoute();
            echo "<pre>"; print_r(value: $route); echo "</pre>"; 
        }catch(Exception $e){
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}