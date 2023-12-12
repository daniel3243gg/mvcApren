<?php

require __DIR__. '/vendor/autoload.php';
use \App\Http\Router;
use \App\Http\Response;
use \App\Utils\View;


define("URL", 'http://localhost/progamndoEMphp/mvc');

View::init([
    'URL'=> URL
]);

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();
