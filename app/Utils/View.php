<?php

namespace App\Utils;

class View
{    
    /**
     * Variáveis padrões da View
     * @var array
     */
    public static $vars = [];
    
    /**
     * Método responsável por definir os dados padrões
     *
     * @param array $vars
     */
    public static function init($vars = [])
    {
        self::$vars = $vars;
    }
    
    /**
     * Método resposável por retornar o conteúdo de uma view
     *
     * @param  string $view
     * @return string
     */
    private static function getContentView($view)
    {
        $file = __DIR__ . "/../../Resources/View/" . $view . ".html";

        return file_exists($file) ? file_get_contents($file) : 'penso';
    }

    /**
     * Método responsável por retornar o conteúdo renderizado de uma view
     *
     * @param  string $view
     * @param  array  $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        /* Conteído da view */
        $contentView = self::getContentView($view);

        /* Merge de variáveis da View */
        $vars = array_merge(self::$vars, $vars);

        /* Chaves do array de Variaveis */
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{' . $item . '}}';
        }, $keys);
        //echo "<pre>"; print_r($keys); echo "</pre>"; exit;

        /* Retorna o conteúdo renderizado */
        return str_replace($keys, array_values($vars), $contentView);
    }
}