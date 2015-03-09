<?php

/* 
 * log the data
 */
function wlog($text){
        
        $date=date("Y-m-d h:i:s");
        $f=fopen('logs.text','a+');
        fwrite($f, $text);
        
    }
    
?>
