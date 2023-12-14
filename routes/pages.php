<?php
use \App\Controller\Pages\Home;
use \App\Controller\Pages\About;
use \App\Controller\Pages\Testimony;
use \App\Http\Router;
use \App\Http\Response;
$obRouter->get('/',[
    function ($idpagina){
        return new Response(200,Home::getHome());
    }

]);
$obRouter->get('/sobre',[
    function (){
        return new Response(200,About::getHome());
 }]);


 $obRouter->get('/depoimentos',[
    function (){
        return new Response(200,Testimony::getTestimonies());
 }]);

 $obRouter->post('/depoimentos',[
    function ($request){
        return new Response(200,Testimony::getTestimonies());
 }]);