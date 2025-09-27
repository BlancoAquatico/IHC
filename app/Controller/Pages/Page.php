<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{    
    
    /**
     * Método responsavel por renderizar o Header da página
     *
     * @return string
     */
    private static function getHeader()
    {
        return View::render('Pages/Header');
    }

    /**
     * Método responsavel por renderizar o Footer da página
     *
     * @return string
     */
    private static function getFooter()
    {
        return View::render('Pages/Footer');
    }

    /**
     * Método responsavel por retornar o conteúdo (view) da Pagina Genérica.
     *
     * @param  string $title
     * @param  string $content
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render('Pages/Page',[
            'title'   => $title,
            'header'  => self::getHeader(),
            'content' => $content,
            'footer'  => self::getFooter()
        ]);
    }
}