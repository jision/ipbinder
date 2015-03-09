<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
@session_start();
if (isset($_SESSION['userid'])) {

    require '../model/model.php';
    require '../model/functions.php';
    //require '../control/curl_it.php';
    $id = $_SESSION['userid'];


    $model = new Model();
    $serverlist = $model->get_serverlist($id);

    if ($serverlist != 0) {
        ?>
        <html>
            <head>
                <!-- CSS
            ================================================== -->
                <link href='http://fonts.googleapis.com/css?family=Dancing+Script:700' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
                <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
                <link href="assets/css/supersized.css" rel="stylesheet" type="text/css"/>
                <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>

                <!-- created by 
                prasenjit Chowdhury
                     ================================================== -->

            </head>
            <body>
                <div class="container top">
                    <div class="row">
                        <h1>Ip Binder</h1>    
                    </div>
                    <div class="row">
                        <div class="icon_separator"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="row">
                        <h2 id="ip">
                            <?php
                                echo "Ip detected : " . get_client_ip();
                                
                            ?>
                        </h2>
                    </div>
                    <div class="row">
                        <h3>Access Server List</h3>  
                    </div>
                    <div class="row holder">
                        
                        
                                    <?php
                                        
                                        
                                        foreach ($serverlist as $server) {

                                            echo "<div class='col-lg-3'>";
                                            echo "<h1>" . $server['server'] ."</h1>";
                                            echo "</div>";
                                            
                                            echo "<div class='col-lg-3'>";
                                            echo "<h1>" . $server['server'] . "</h1>";
                                            echo "</div>";
                                            
                                            echo "<div class='col-lg-3'>";
                                            echo "<h1>" . $server['server'] . "</h1>";
                                            echo "</div>";
                                            
                                            echo "<div class='col-lg-3'>";
                                            echo "<h1>" . $server['server'] . "</h1>";
                                            echo "</div>";
                                            
                                            
                                        }
                                        
                                    ?>
                                   

                    </div>
                    <div class="center-block">
                        
                        <p> ****** incase the ip is not binded or if you face any problems please log out and log in again ****** </p>
                        <a href="https://twitter.com/Dave_Conner" class="btn btn-1">
      <svg>
        <rect x="0" y="0" fill="none" width="100%" height="100%"/>
      </svg>
     Hover
    </a>
                    </div>

                </div>
            <!-- Javascript
        ================================================== -->

            <script src="assets/js/jquery-1.8.2.min.js"></script>
            <script src="assets/js/supersized.3.2.7.min.js"></script>
            <script src="assets/js/supersized-init-feildview.js"></script>
            <script>
                $(document).ready(function(){
                    
                    function get_ip(){
                    $.ajax({
                        type: "POST",
                        url: "../model/getip.php",
                        async: true,
                        sucess: function () {

                            
//                            
                        },
                    });
                }
                  setInterval(get_ip, 5000);  
                });
                
            </script>



        </body>
        </html>

        <?php
    }// for server count
    else {
        header("location:../");
    }
} else {

    echo 'no';
    //header("location:../");
}
?>