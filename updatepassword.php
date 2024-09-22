<?php
 session_start();
 include("php/config.php");
 include("php/functions.php");
 $user_data = check_login($config);



?>
 <?php
        if (isset($_POST['update_password']))
        {
            
            $user_id = $_POST['data'];
            $new_password = $_POST['n_p'];
           
            $query = "update users set p_word = '$new_password' where user_id = '$user_id'";
    
            mysqli_query($config,$query) or die("Error connecting to server"); 

                        

                         echo 1 ;
                        
                         
        }
        else{
            echo 2 ;
      }
       
?>