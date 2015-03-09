<?php

/* 
 * To remove ip from the iptable 
 * cron every 5 mins
 * author:jision
 * .
 */

require_once 'db.php';
require_once 'log.php';

$model=new Database();

$datetime=date('Y-m-d H:i:s');
$query="select DISTINCT(ip) from iplist where date_time_expiry <= $datetime group by ip order by date_time_expiry desc";

$res=$model->select($query);

if($res != 0){
    
    foreach ($res as $iplist){
        
        $ip=$iplist['ip'];
        $query="select distinct(ip) from iplist where ip=$ip and date_time_expiry <= $datetime order by date_time_expiry desc limit 1";
        $result=$model->select($query);
        
        if($result != 0){
            
            $grep=shell_exec("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'");
            
            if($grep != ''){
                
                $res_ex = explode(' ', $res);
                $add = shell_exec("./remove.sh $res_ex[0]");
                wlog("ip: $ip removed");
            }// grep result
        }// if ip exist
        
    }
    
    
}
else{
    
    wlog('no ip removed');
    die();
}


?>
