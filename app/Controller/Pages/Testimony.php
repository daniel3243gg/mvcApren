<?php

namespace App\Controller\Pages;
use \App\Utils\View;
use \App\Model\Entity\Organization;




class Testimony extends Page{


    public static function getTestimonies(){
        $organ = new Organization();
        $content=  View::render('pages/Testimonies',[
            

        ]);
        return Page::getPage("DANIEL SOLUÇOES", $content);
    }

}