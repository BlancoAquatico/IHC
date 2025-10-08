<?php

require __DIR__ . '/vendor/autoload.php';

use App\Http\Router;



define('URL', 'http://localhost/IHC');

$obRouter = new Router(URL);

/* Inclui as rotas de páginas */
include __DIR__ . '/Routes/pages.php';

/* Imprime o Response da Rota */
$obRouter->run()->sendResponse();
