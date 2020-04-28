<?php

use Slim\Middleware\Flash;

class UtilsService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UtilsImp.php';
        require_once dirname(__FILE__) . '/UtilsController.php';
    }
    public function lowercase($text)
    {
        $UtilsImp = new UtilsImp();
        return $UtilsImp->lowercase($text);
    }
    public function noSpecialChar($text)
    {
        $UtilsImp = new UtilsImp();
        return $UtilsImp->noSpecialChar($text);
    }
    public function parseUsernmae($text)
    {
        $utilscontroller=new UtilsController();
        $newresponse=array();
        
        return $newresponse;
    }
    
}