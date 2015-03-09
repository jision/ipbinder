<?php
    
    require_once 'db.php';
    
    class Model extends Database{
            
        function get_authorize($uname,$psswd){
            
            $query="select userid,username,usertype from user where username='$uname' and password=sha1('$psswd')";
            $res=  $this->select($query);
            
            return $res;
            
        }
            
        function get_serverlist($id){
            
            $query="select server from access where userid='$id'";
            $res=$this->select($query);
            
            return $res;
            
        }
            
        
            
    }
    
    
?>

 