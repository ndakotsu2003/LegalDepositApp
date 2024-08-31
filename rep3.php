<?php
    session_start();
    include("php/config.php");
    include("php/functions.php");
    
    
    
    $user_data = check_login($config);
    $d_from = $_POST['d_from'];
    $d_to = $_POST['d_to'];

?>

<?php
   
        $date1= $d_from;
        $date2= $d_to;
        $titlesum=0;
        $volumesum=0;
        $query1 = "Select DISTINCT legald.dep_type ,COUNT(legald.dep_type)AS titles,SUM(legald.deposited)AS total_copies from books
         inner join legald on books.book_id = legald.book_id WHERE legald.d_o_dep
          >= '$date1' AND legald.d_o_dep<='$date2' GROUP BY legald.dep_type";

       
        $result = mysqli_query($config,$query1) or die("Error connecting to server");
       
        while($row1=$result->fetch_assoc()){
            $titlesum1 = $row1['titles'];
            $volumesum1 = $row1['total_copies'];
            $titlesum+= $titlesum1;
            $volumesum+=$volumesum1;

?>
        <tr>
     
        <td style= 'text-align: center'><?php echo $row1['dep_type']?></td>
        <td style= 'text-align: center'><?php echo $row1['titles'] ?></td>
        <td style= 'text-align: center'><?php echo $row1['total_copies'] ?></td>
        </tr>

        
        
        <?php
           
        }
?>
   <tr>
   <td style= 'text-align: center'><?php echo "Total"?></td>
   <td style= 'text-align: center' id="fillt"><?php echo $titlesum?></td>
   <td style= 'text-align: center' id="fill_up"><?php echo $volumesum?></td>
   </tr>
<?php
?>

    ?>


