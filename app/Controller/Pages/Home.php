<?php

namespace App\Controller\Pages;
use \App\Utils\View;
use \App\Model\Entity\Organization;




class Home extends Page{


    public static function getHome(){
        $organ = new Organization();
        $content=  View::render('pages/Home',[
            "name"=>$organ->name,

        ]);
        return Page::getPage("DANIEL SOLUÇOES", $content);
    }

}