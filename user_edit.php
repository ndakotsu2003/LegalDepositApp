<?php
 session_start();
 include("php/config.php");
 include("php/functions.php");
 $user_data = check_login($config);



?>
 <?php
        if (isset($_POST['popT']))
        {
            
            $user_id = $_POST['user_id'];
            $new_type = $_POST['new_type'];
           
            $query = "update users set type = '$new_type' where user_id = '$user_id'";
    
            mysqli_query($config,$query) or die("Error connecting to server"); 

                        

                         echo 1 ;
                        
                         
        }
        else{
            echo 2 ;
      }
       
?>