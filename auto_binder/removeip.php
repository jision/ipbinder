#!/usr/bin/php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* 
 * To remove ip from the iptable 
 * cron every 1 mins
 * author:jision
 * .
 */

require_once 'db.php';
require_once 'log.php';

$model=new Database();

$datetime=date('Y-m-d H:i:s');
$query="select ip,id from iplist where date_time_expiry <= '$datetime' and binded='1' group by ip order by date_time_expiry desc";
echo $query;
$res=$model->select($query);

if($res != 0){
    
    foreach ($res as $iplist){
        
        $ip=$iplist['ip'];
        $id=$iplist['id'];
        $query="select ip,id from iplist where ip='$ip' and date_time_expiry >= '$datetime' and binded='1' order by date_time_expiry desc limit 1";
        $result=$model->select($query);
        
        if($result == 0){
            
            echo "iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'";
            $grep=shell_exec("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'");
            echo $grep;
            if($grep != ''){
                
                $res_ex = explode(' ', $grep);
                //print_r($res_ex);
                $add = shell_exec("./remove.sh $res_ex[0]");
                wlog("ip: $ip removed \n");
                $model->update("update iplist SET binded='2' WHERE id='$id'");
            }// grep result
        }// if ip exist
        
    }
    
    
}
else{
    
    wlog("$datetime: no ip removed \n");
    
}

sleep(5);

?>
