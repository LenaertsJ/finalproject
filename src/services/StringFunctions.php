<?php


namespace App\services;


class StringFunctions
{

    public function slugify($str){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $str), '-'));
    }

    public function removeTags($str){
        return strip_tags($str, "<b><i>");
    }

}