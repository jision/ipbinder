<?php

//
//creator:prasenjit
//description:hits the server parts and adds ip


@session_start();



require '../model/model.php';
require '../model/functions.php';


if (isset($_SESSION['userid'])) {
    
    
    
    $id = $_SESSION['userid'];// unique userid for input
    $usertype = $_SESSION['usertype']; // user type no idea why am i using it
    $username = $_SESSION['username']; // username for identification
    $ip=get_client_ip();
    $_SESSION['ip']=$ip;
    
    
    $model = new Model();
    $serverlist = $model->get_serverlist($id);
    
    if($serverlist != 0){
        foreach($serverlist as $server){
            
            if($server['server'] == 'c1'){
                
                $url='http://apis.voicetree.info/auto_binder/addip.php';
                                
            }
            else{
                        $url='http://'.$server['server'].'.voicetree.info/auto_binder/addip.php';
            }
            $fields = array(
                                'ip' => urlencode($ip),
                                'id' => urlencode($id),
                                'username' => urlencode($username),
                                'usertype' => urlencode($usertype)                               
                        );
            $fields_string='';
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');
            
            $ch = curl_init();
            
        //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //execute post
            $result = curl_exec($ch);
            echo $result;
        //close connection
            curl_close($ch);
            
        }
    }
    
    
} else {

    die();
}
//
////set POST variables
//$url = 'http://domain.com/get-post.php';
//$fields = array(
//                      'lname' => urlencode($last_name),
//                      'fname' => urlencode($first_name),
//                      'title' => urlencode($title),
//                      'company' => urlencode($institution),
//                      'age' => urlencode($age),
//                      'email' => urlencode($email),
//                      'phone' => urlencode($phone)
//              );
//
////url-ify the data for the POST
//foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
//rtrim($fields_string, '&');
//
////open connection
//$ch = curl_init();
//
////set the url, number of POST vars, POST data
//curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch,CURLOPT_POST, count($fields));
//curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
//
////execute post
//$result = curl_exec($ch);
//
////close connection
//curl_close($ch);
?>
