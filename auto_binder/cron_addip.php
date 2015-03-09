#!/usr/bin/php
<?php

date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ALL);
ini_set('display_errors', 1);
	
/* 
 * To remove ip from the iptable 
 * cron every 1 mins
 * author:jision
 * .
 */

    require_once 'log.php';
    require_once 'db.php';
    
   // extract($_POST);
    $model= new Database();

    $datetime=date("Y-m-d H:i:s");
    $bindtime=date('Y-m-d H:i:s', strtotime($datetime . ' - 5 minutes'));
	
	wlog("$datetime : addition started \n");
    //$query="select ip,id from iplist where binded='0' and date_time_start <= '$datetime' and date_time_start >='$bindtime' order by date_time_start desc";
    $query="select ip,id from iplist where binded='0'";
    //$query="select * from iplist";
    echo wlog($query."\n");
    $result=$model->select($query);
    wlog($result."\n");
    print_r($result);
    if($result != 0){

    	foreach ($result as $res) {

    		$ip=$res['ip'];
    		$id=$res['id'];
    		$grep = shell_exec("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'");

    		if($grep == ''){
            
        		$grep = shell_exec ("./script.sh $ip");
        		wlog($grep."$datetime added ip to chain\n");
        		$update="update iplist SET binded='1' WHERE id='$id'";
        	}
            else{

                wlog("$datetime : $ip not added already added to chain list \n");
                $update="update iplist SET binded='1' WHERE id='$id'";
            }
        		
        		$say=$model->update($update);
        	


    	}
    }
    else{

        $query="select ip,id,date_time_start from iplist where binded='0' order by date_time_start desc limit 5";
        $res=$model->select($query);
        wlog(print_r($res));

    }

    sleep(5);
    
?>
