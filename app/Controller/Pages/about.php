<?php
namespace App\Controller\Pages;
use \App\Utils\View;
use \App\Model\Entity\Organization;




class About extends Page{


    public static function getHome(){
        $organ = new Organization();
        $content=  View::render('pages/about',[
            "name"=>$organ->name,
            "algo"=>$organ->desc,
            'nasc'=>$organ->idade
        ]);
        return Page::getPage("CHAME O DANDAN, SOBRE", $content);
    }

}