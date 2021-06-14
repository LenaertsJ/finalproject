<?php


namespace App\services;


class StringFunctions
{

    public function removeTags($str){
        return strip_tags(htmlspecialchars_decode($str), '<b><i>');
    }

}