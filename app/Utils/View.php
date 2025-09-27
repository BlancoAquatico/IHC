<?php

namespace App\Utils;

class View
{    
    
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