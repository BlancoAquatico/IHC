<?php

namespace App\Http;
use Closure;
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

        
        
        echo "<pre>"; print_r(value: $params); echo "</pre>"; 

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
}