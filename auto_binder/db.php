<?php

class Database {

    	public $hostname, $dbname, $username, $password, $conn;

	    function __construct() {
	        $this->host_name ="localhost";
	        $this->dbname = "ipbind_server";
	        $this->username ="user";
	        $this->password = "password";
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
                        
                        return $e->getMessage();
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
                        
                        return $e->getMessage();
                    }
                }
        
            }// function insert
            
            function update($query) {


                if($query != ''){

                    $sql=$this->conn->query($query);
                    return $sql;

                }
                else{

                     return "blank query";
                }


            }// function update
            
            function getcompanylist(){
                
                $query="select companies.id as name,company_settings.property_value as size from companies join company_settings on companies.id=company_settings.company_id where company_settings.key='max_drive_size'";
                $res = $this->select($query);
                return $res;
                
            }
            
            function update_archive($key_list,$archiveId){
                
                $keylist =  implode(',',$key_list);
                $query   =  "update sounds set archive_id='$archiveId' where filename in ($key_list)";
                $this->update($query);
                
                
            }


            
}// end of class defination


?>
