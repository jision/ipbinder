<?php
    
    require_once 'db.php';
    
    extract($_POST);
    $model= new Database();
    
    /*********************************************************************************************/
    //$id unique userid for input
    //$usertype user type no idea why am i using it
    //$username username for identification
    //$ip ip to be added    
    /********************************************************************************************/
    
    if($ip == '' || $id == '' || $username == '' || $usertype == '' )
        exit();
    
    if(!filter_var($ip, FILTER_VALIDATE_IP)) {
        
        exit();
        //not a vlaid ip
        
    }
    
    //$res_command="iptables -L -n --line | grep -E 'REJECT' | grep -E '$ip'";
    $res = shell_exec("iptables -L -n --line | grep -E 'REJECT' | grep -E '$ip'");
    if($res == ''){
        
        $startTime=date("Y-m-d H:i:s");
        $expiryTime=date('Y-m-d H:i:s', strtotime($startTime . ' + 3 hours'));
        $query="insert into iplist values('','$ip','$id','$username','$expiryTime')";
        $result=$model->insert($query);
        $res = shell_exec("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'");
        
        if($res == '')
            
            $res = shell_exec ("./script.sh $ip");
        
        echo 'added ip to chain';
        
        
    }
    else{
        
        exit();
    }