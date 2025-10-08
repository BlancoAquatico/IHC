<?php

require __DIR__ . '/vendor/autoload.php';

use App\Http\Router;
use App\Utils\View;



define('URL', 'http://localhost/inter');


/* Define o valor padrão das variáveis */
View::init([
    'URL' => URL
]);

/* Inicia o ROUTER */
$obRouter = new Router(URL);

/* Inclui as rotas de páginas */
include __DIR__ . '/Routes/pages.php';

/* Imprime o Response da Rota */
$obRouter->run()->sendResponse();
