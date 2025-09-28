<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controller\Pages\Home;
use App\Http\Response;
use App\Http\Router;

define('URL', 'http://localhost/IHC');

$obRouter = new Router(URL);

/* Rota Home */
$obRouter->get('/', [
    function(){
        return new Response(200, Home::getHome());
    }
]);

