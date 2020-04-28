<?php

class UtilsImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UtilsQuery.php';
    }


    public function lowerCase($text)
    {
        $UtilsQuery = new UtilsQuery();
        return $UtilsQuery->lowerCase($text);
    }
    public function noSpecialChar($text)
    {
        $UtilsQuery = new UtilsQuery();
        return $UtilsQuery->noSpecialChar($text);
    }
    public function passwordLenght($text)
    {
        $UtilsQuery = new UtilsQuery();
        return $UtilsQuery->passwordLenght($text);
    }
    public function passwordDecrypt($text)
    {
        $UtilsQuery = new UtilsQuery();
        return $UtilsQuery->passwordDecrypt($text);
    }
    public function passwordEncrypt($text)
    {
        $UtilsQuery = new UtilsQuery();
        return $UtilsQuery->passwordEncrypt($text);
    }
}