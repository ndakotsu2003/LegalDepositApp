<?php
 session_start();
 include("php/config.php");
 include("php/functions.php");
 
 
 
 $user_data = check_login($config);
 
?>
<?php
        




    if (isset($_POST['pop_out']))
    {
        
        $ld_no = $_POST['check'];
        $query = "select depo_history.l_dep_no, legald.copies_deposit, SUM(depo_history.deposited) AS TOTS from legald join depo_history 
on legald.l_dep_no = depo_history.l_dep_no where depo_history.l_dep_no = '$ld_no';";

        $result = mysqli_query($config,$query) or die("Error connecting to server");
            if(mysqli_num_rows($result)> 0){
               
                while($row = mysqli_fetch_array($result)){
                    echo $row['copies_deposit'] - $row['TOTS'];
                }
               
            }
            else{
                echo '<h4>Not Found</h4>';
            }

    }

    else{
        echo '<h4>Not Found</h4>';
        die();
    }




    



?>
