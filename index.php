<?php

require __DIR__. '/vendor/autoload.php';
use \App\Http\Router;
use \App\Http\Response;
use \App\Utils\View;
use \WilliamCosta\DotEnv;
use WilliamCosta\DotEnv\Environment;


define("URL",'http://localhost/danAp/mvcApren');

View::init([
    'URL'=> URL
]);

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();
