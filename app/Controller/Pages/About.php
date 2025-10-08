<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class About extends Page
{    
    /**
     * Método responsavel por retornar o conteúdo (view) do SOBRE.
     *
     * @return string
     */
    public static function getAbout()
    {
        /* Organização */
        $obOrganization = new Organization();
        $content = View::render('Pages/About',[
            'name'        => $obOrganization->name,
            'description' => $obOrganization->description,
            'site'        => $obOrganization->site
        ]);

        return parent::getPage('SOBRE < INTER', $content);
    }
}