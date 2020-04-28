<?php

class UtilsImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UtilsQuery.php';
    }


    public function lowercase($text)
    {
        $UtilsQuery = new UtilsQuery();
        return $UtilsQuery->lowercase($text);
    }
    public function noSpecialChar($text)
    {
        $UtilsQuery = new UtilsQuery();
        return $UtilsQuery->noSpecialChar($text);
    }
}
