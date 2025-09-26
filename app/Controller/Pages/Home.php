<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home
{    
    /**
     * Método responsavel por retornar o conteúdo (view) da Home.
     *
     * @return string
     */
    public static function getHome()
    {
        return View::render('Pages/Home',[
            'name' => 'IHC - Trabalho',
            'description' => 'Trabalho de IHC BETA'
        ]);
    }
}