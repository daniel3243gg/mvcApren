<?php

namespace App\Controller\Pages;
use \App\Utils\View;





class Page{
    private static function getFooter(){
        return View::render('pages/footer');


    }
    private static function getHeader(){
        return View::render('pages/header');

    }

    public static function getPage($title,$content){
        return View::render('pages/page',[
            "title"=>$title,
            "content"=>$content,
            'header'=>self::getHeader(),
            'footer'=>self::getFooter()
        ]);

    }

}