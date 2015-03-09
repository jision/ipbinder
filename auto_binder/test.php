<?php

	require_once 'log.php';
    require_once 'db.php';
    
   // extract($_POST);
    $model= new Database();

    $query="delete * from iplist";
    $result=$model->select($query);
?>