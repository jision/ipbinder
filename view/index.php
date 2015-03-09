
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Ipbind</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="view/assets/css/reset.css">
        <link rel="stylesheet" href="view/assets/css/supersized.css">
        <link rel="stylesheet" href="view/assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="page-container">
            <img src="view/assets/img/stuff/voicetree_logo.png" width="250" height="100" style="opacity: 0.7" alt=""/>
            <div class="translucent">
            
                <h1>LOGIN</h1>
            
            <form action="control/control.php" method="post">
                <input type="text" name="username" class="username" placeholder="Username">
                <input type="password" name="password" class="password" placeholder="Password">
                <input type="hidden" name="veiw_feild" value="login">
                <button type="submit">AUTHENTICATE</button>
                <div class="error"><span>+</span></div>
            </form>
            </div>
        </div>

        <!-- Javascript -->
        <script src="view/assets/js/jquery-1.8.2.min.js"></script>
        <script src="view/assets/js/supersized.3.2.7.min.js"></script>
        <script src="view/assets/js/supersized-init.js"></script>
        <script src="view/assets/js/scripts.js"></script>

    </body>

</html>

