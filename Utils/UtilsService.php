<?php

use Slim\Middleware\Flash;

class UtilsService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UtilsImp.php';
        require_once dirname(__FILE__) . '/UtilsController.php';
    }
    public function lowerCase($text)
    {
        $UtilsImp = new UtilsImp();
        return $UtilsImp->lowerCase($text);
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
        $response=$utilscontroller->noSpecialChar($text);
        if($response['error']==true){
            $newresponse["error"]=true;
            $newresponse['message']='invalid username';
        }else{
            $newresponse['error']=false;
            $newresponse['messgae']="string has no special character";
            $response=$utilscontroller->lowerCase;
            $newresponse['username']=$response['new_username'];
        }
        return $newresponse;
    }
    public function passwordLenght($text)
    {
        $UtilsImp = new UtilsImp();
        return $UtilsImp->passwordLenght($text);
    }
    public function passwordEncrypt($text)
    {
        $UtilsImp = new UtilsImp();
        return $UtilsImp->passwordEncrypt($text);
    }
    public function passwordDecrypt($text)
    {
        $UtilsImp = new UtilsImp();
        return $UtilsImp->passwordDecrypt($text);
    }
}

