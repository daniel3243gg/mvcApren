<?php
use \App\Controller\Pages\Home;
use \App\Controller\Pages\About;

use \App\Http\Router;
use \App\Http\Response;
$obRouter->get('/',[
    function (){
        return new Response(200,Home::getHome());
    }

]);
$obRouter->get('/sobre',[
    function (){
        return new Response(200,About::getHome());
    }

]);