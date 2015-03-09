<?php

class Database {

    	public $hostname, $dbname, $username, $password, $conn;

	    function __construct() {
	        $this->host_name ="localhost";
	        $this->dbname = "ipbind";
	        $this->username ="root";
	        $this->password = "";
	        $mem = false;
	        //$this->memcache = $mem->connectMem();
	        try {

	            $this->conn = new PDO("mysql:host=$this->host_name;dbname=$this->dbname", $this->username, $this->password);
	            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	        } catch (PDOException $e) {
	            echo 'Error: ' . $e->getMessage();
	    	}

	    }
                
                
            function select($query) {
                
                if($query == ''){
                    
                    exit();
                }
                else{
                    
                    try{
                       
                        $sql=$this->conn->query($query);
                        
                        
	   		if($sql->rowCount() == 0){
            	
                                return 0;
        	
	        	}else{
	            	
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                            //print_r($row);
                            return $row;
                        }
                    } catch (Exception $e) {
                        
                        die($e->getMessage());
                    }      
                }
                       
            }// funtion select
            
            function insert($query) {
                
                if($query == ''){
                    
                    exit();
                }
                else{
                    
                    try{
                       
                        $sql=$this->conn->query($query);
                                            
                    }catch (Exception $e) {
                        
                        die($e->getMessage());
                    }
                }
        
            }// function insert
            
            
}// end of class defination


?>