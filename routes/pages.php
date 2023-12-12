<?php
use \App\Controller\Pages\Home;
use \App\Controller\Pages\About;

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


$obRouter->get('/pagina/{idPagina}/{acao}',[
    function ($idPagina,$acao){
        return new Response(200,'pagina' . $idPagina.' - '.$acao);
     }

]);