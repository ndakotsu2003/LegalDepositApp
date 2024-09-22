<?php
    session_start();
    include("php/config.php");
    include("php/functions.php");
    
    
    
    $user_data = check_login($config);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Report</title>
</head>
<body>
    <header>
        <?php include("topbarr.php"); ?>
        </header>

    <div id="display">
        <?php
    if ($_SESSION['sType'] == 'admin'){
    include("sidebar.php");   
                          }
                       else {
                        include("sidebar1.php");
                       } ?>

             <div id="switch">
                <a class="swi_btn" href="report1.php"><button class = "s_btn">Report Generation</button></a>
                <a class="swi_btn" href="checker.php"><button class = "s_btn" id="checkrz">Outstanding Checker</button></a>

             </div>          

    </div>
    

    <script src="jquery/jquery3.7.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>
</html>