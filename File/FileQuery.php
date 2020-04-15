<?php

class FileQuery
{

    private $conn;

    function __construct()
    {
        require_once  './../Config/Connect.php';
        require_once  './../Config/Constants.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }

    function uploafFile($product, $application, $from, $to, $message, $file)
    {
        $response = array();
        $file_id = md5(uniqid($from));
        $target_path = $_SERVER["DOCUMENT_ROOT"];
        $link_path = "http://appnivi.com";
        if($product == "appnivi"){
            if($application == "appnivi"){
                if (!file_exists($target_path.'/uploads')) {
                    mkdir($target_path.'/uploads', 0777, true);
                }
                $target_path .= '/uploads/'.$file_id."_".basename($file["name"]);
                $link_path .= '/uploads/'.$file_id."_".basename($file["name"]);
            }else{
                if (!file_exists($target_path.'/'.$application.'/uploads/')) {
                    mkdir($target_path.'/'.$application.'/uploads/', 0777, true);
                }
                $target_path .= '/'.$application.'/uploads/'.$file_id."_".basename($file["name"]);
                $link_path .= '/'.$application.'/uploads/'.$file_id."_".basename($file["name"]);
            }
        }else{
            if($product == $application){
                if (!file_exists($target_path.'/'.$application.'/uploads/')) {
                    mkdir($target_path.'/'.$application.'/uploads/', 0777, true);
                }
                $target_path .= '/'.$application.'/uploads/'.$file_id."_".basename($file["name"]);
                $link_path .= '/'.$application.'/uploads/'.$file_id."_".basename($file["name"]);
            }else{
                if (!file_exists($target_path.'/'.$product.'/'.$application.'/uploads/')) {
                    mkdir($target_path.'/'.$product.'/'.$application.'/uploads/', 0777, true);
                }
                $target_path .= '/'.$product.'/'.$application.'/uploads/'.$file_id."_".basename($file["name"]);
                $link_path .= '/'.$product.'/'.$application.'/uploads/'.$file_id."_".basename($file["name"]);
            }
        }
 
        // $target_path .= "/".$product.'/uploads/'.$application."/".$file_id."_".basename($file["name"]);
        $target_path = trim(preg_replace('/\s+/', '', $target_path));
        try {
            if (!move_uploaded_file($file['tmp_name'], $target_path)) {
                $response["error"] = true;
                $response["message"] = "File Could Not Be Uploaded \n Error : ".$_FILES["file"]["error"];;
                $response["name"] = $file["name"];
                return $response;
            }
            //Fill the database

            $stmt = mysqli_query($this->conn,"insert into file_upload(file_id,product_id,application_id,sender_id,receiver_id,timestamp)
             values('".$file_id."','".$product."','".$application."','".$from."','".$to."',NOW())");
            if($stmt){
                // $link_path = "http://appnivi.com/".$product."/uploads/".$application."/".$file_id."_".basename($file["name"]);
                $link_path = trim(preg_replace('/\s+/', '', $link_path));
                $stmt = mysqli_query($this->conn,"insert into file_description(file_id, file_path, file_description) 
                values('".$file_id."','".$link_path."','')");

                if($stmt){
                    $response["error"] = false;
                    $response["message"]  = "File Uploaded Successfully";
                    $response["link"] = $link_path;
                    return $response;
                }
            }

            $response["error"] = true;
            $response["message"] = "File could not be updated";
            $response["info"] = mysqli_error($this->conn);
            return $response;

        } catch (Exception $e) {
            $response["error"] = true;
            $response["message"] = $e->getMessage();
            return $response;
        }
        return $response;
    }
    function clearFiles(){
        //get file id which are 7 days older 
        $response = array();
        $stmt = mysqli_query($this->conn,"select  * from file_upload where DATEDIFF(NOW(),timestamp) > 7");
        if(mysqli_num_rows($stmt)>0){
            $response["file_entries"] = array();
            while($row = mysqli_fetch_assoc($stmt)){
                array_push($response["file_entries"],$row);
            }
            $response["error"] = false;
            $response["message"] = "Cleared";
        }else{
            $response["error"] = false;
            $response["message"] = "Already Cleared";
        }
        
        return $response;

    }
}
