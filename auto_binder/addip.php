<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ALL);
ini_set('display_errors', 1);
    #!/usr/bin/php

    
    require_once 'log.php';
    require_once 'db.php';
    
    extract($_POST);
    $model= new Database();
    
    /*********************************************************************************************/
    //$id unique userid for input
    //$usertype user type no idea why am i using it
    //$username username for identification
    //$ip ip to be added    
    /********************************************************************************************/
    
    wlog($_POST['ip']."\n".$_POST['id']."\n".$_POST['username']."\n".$_POST['usertype']."\n");
    
    if($ip == '' || $id == '' || $username == '' || $usertype == '' ){
        
        //print_r($_POST);
        echo 'variable missing';
        wlog('variable missing \n');
        exit();
    }
    
    if(!filter_var($ip, FILTER_VALIDATE_IP)) {
        
        echo 'not a vlaid ip';
        wlog('not a valid ip \n');
        exit();
        //not a vlaid ip
        
    }
    
    echo '   ip :'.$ip;
    //$res = shell_exec("iptables -L -n --line | grep -E 'REJECT' | grep -E '$ip'");
    $startTime=date("Y-m-d H:i:s");
    $expiryTime=date('Y-m-d H:i:s', strtotime($startTime . ' + 3 hours'));
    $query="insert into iplist values('','$ip','$id','$username','$startTime','$expiryTime','0')";
    wlog($query.'\n');
    $result=$model->insert($query);
    
    /*if($res == ''){
        
        $startTime=date("Y-m-d H:i:s");
        $expiryTime=date('Y-m-d H:i:s', strtotime($startTime . ' + 3 hours'));
        $query="insert into iplist values('','$ip','$id','$username','$startTime','$expiryTime')";
        $result=$model->insert($query);
        $res = shell_exec("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'");
        echo $res;
        if($res == ''){
            
        $res = shell_exec ("./script.sh 122.161.161.113");
        echo $res;
        echo 'added ip to chain';
        }
        
        
    }
    else{
        
        exit();
    }
    
    //print_r($_POST);*/

?>
