<?php
 session_start();
 include("php/config.php");
 include("php/functions.php");
 
 
 
 $user_data = check_login($config);
 
?>
<?php
if(isset($_POST['update_dep']))
    {
      
        $legD = $_POST['legD'];
        $bookId = $_POST['bookId'];
        $add = $_POST['add'];
        $u_date = date('Y-m-d');
        $query2 = "insert into depo_history (deposited, l_dep_no, book_id,u_date) values ($add,'$legD',$bookId,'$u_date');";
        mysqli_query($config,$query2) or die("Error connecting to server");
        echo 'Success!';

        }
    else{
          echo 'fail';
    }
?>