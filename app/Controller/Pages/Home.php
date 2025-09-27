<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page
{    
    /**
     * Método responsavel por retornar o conteúdo (view) da Home.
     *
     * @return string
     */
    public static function getHome()
    {
        /* Organização */
        $obOrganization = new Organization();
        $content = View::render('Pages/Home',[
            'name'        => $obOrganization->name,
            'description' => $obOrganization->description,
            'site'        => $obOrganization->site
        ]);

        return parent::getPage('Projeto IHC', $content);
    }
}