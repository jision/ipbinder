<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

function get_client_ip1() {
    $ipaddress = '';
    if (@$_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = @$_SERVER['HTTP_CLIENT_IP'];
    else if (@$_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (@$_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = @$_SERVER['HTTP_X_FORWARDED'];
    else if (@$_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = @$_SERVER['HTTP_FORWARDED_FOR'];
    else if (@$_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (@$_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

  

    if(isset($_SESSION['ip'])){
        
        $ip= get_client_ip1();
        /*
        if($ip != $_SESSION['ip']){
            
            echo 'ip change';
            require_once '../control/curl_it.php';
        }
        else{
            
            echo 'same ip';
            exit();
            
        }*/
        
     print_r($_SESSION);
        require_once '../control/curl_it.php';
        echo $ip;
    }
    else{
        
        echo 'ip not set';
        include_once '../control/curl_it.php';
    }

    echo $ip;
?>