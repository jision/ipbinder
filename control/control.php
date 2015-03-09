<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
@session_start();



require_once('../model/model.php');

$model= new Model();
echo $_SERVER["REQUEST_METHOD"];

if($_SERVER["REQUEST_METHOD"]=='POST'){
    
    extract($_REQUEST);
    
    
    if($veiw_feild == 'login'){
        
        //databasecheck to the main page
        $password = strip_tags($password);
        $username = strip_tags($username);
        
        $result=$model->get_authorize($username, $password);
        
        print_r($result);
        if($result != 0){
           
            $_SESSION['userid']=$result[0]['userid'];
            $_SESSION['usertype']=$result[0]['usertype'];
            $_SESSION['username']=$result[0]['username'];
            //echo $_SESSION['id'];
            if($_SESSION['usertype'] == 1)
                header("location:../view/workfeild.php");
            
            if($_SESSION['usertype'] == 0)
                header("location:../view/workfeild.php");
            
        }else{
            
            header("location:../");
        }
        
        
    }
    else{
        
        //redirect to login
        //header("location:../");
    }
    //header("location:../view/workfeild.php");
    
    
}
?>