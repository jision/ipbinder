<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once '../lib/SSH.php';
//require_once '../lib/Iptables.php';

function get_client_ip() {
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

function bind_ip($servername) {

    $ip = get_client_ip();
    //echo "given ip is $ip";
    $ssh = new SSH($servername['servername']);
    $ssh->setUsername($servername['username']);
    $ssh->setPassword($servername['password']);


    $res = $ssh->execute("iptables -L -n --line | grep -E 'REJECT' | grep -E '$ip'");

    if ($res == '') {

        //$iptables = new Iptables($ssh);
        //$iptables->setOnFly(FALSE);

        $ip_blast = explode('.', $ip);
        //echo '<pre>';
        //echo "first search"."iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'";
        $res = $ssh->execute("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'");
        $res_ex = explode(' ', $res);
        //print_r($res_ex);
        if ($res == '') {

            //echo "second search"."iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip_blast[0].$ip_blast[1].$ip_blast[2]' | grep -E 'tcp dpt:3306'";
            $res = $ssh->execute("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip_blast[0].$ip_blast[1].$ip_blast[2]' | grep -E 'tcp dpt:3306'");

            if ($res == '') {

                //echo "third search"."iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip_blast[0].$ip_blast[1]' | grep -E 'tcp dpt:3306'";
                $res = $ssh->execute("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip_blast[0].$ip_blast[1]' | grep -E 'tcp dpt:3306'");

                if ($res == '') {

                    #add
                    $res_ex = explode(' ', $res);
                    //echo "$ip_blast[0].$ip_blast[1]"."<br>";
                    $add = $ssh->execute("iptables -I INPUT -p tcp -s $ip --dport 3306 -j ACCEPT"); // change rule number 1 replace
                } else {

                    #add
                    $res_ex = explode(' ', $res);
                    $add = $ssh->execute("iptables -I INPUT -p tcp -s $ip --dport 3306 -j ACCEPT"); // change rule number 1 replace
                }# frst cahin
            } else {

                //echo "replace"."<br>";
                $res_ex = explode(' ', $res);
                $add = $ssh->execute("iptables -R INPUT $res_ex[0] -p tcp -s  --dport 3306 -j ACCEPT"); // change rule number 1 replace 
            }
        } else {

            echo 'ip present dont do any thing';
        }
    } else {

        return 0;
    }
}

/*
 * $res=$ssh->execute("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip' | grep -E 'tcp dpt:3306'");

  if($res == ''){

  $res=$ssh->execute("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip_blast[0].$ip_blast[1].$ip_blast[2]' | grep -E 'tcp dpt:3306'");

  if($res == ''){

  $res=$ssh->execute("iptables -L -n --line | grep -E 'ACCEPT' | grep -E '$ip_blast[0].$ip_blast[1]' | grep -E 'tcp dpt:3306'");

  if($res == ''){

  #replace and return
  echo "$ip_blast[0].$ip_blast[1]";
  $row=  explode(' ', $res);
  echo "replace";
  }
  else{
  echo $res;
  $row=  explode(' ', $res);
  #remove #row[1];
  #add row
  echo "$ip_blast[0].$ip_blast[1]";
  echo "remove";
  }

  }// 3 points
  else{

  #replace #row[1];
  #add row
  echo "$ip_blast[0].$ip_blast[1].$ip_blast[2]";
  echo "replace";
  }

  }
  else{

  # return do nothing
  echo('do nothing');
  }
 */
?>
