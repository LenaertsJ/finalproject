<?php


namespace App\services;


class StringFunctions
{

    //methode om <div> tags te verwijderen uit de input van een textarea in easyAdmin.
    public function removeTags($str){
        return strip_tags($str, '<strong><em><br><blockquote><em><del><ol><ul><li><a>');
    }

}