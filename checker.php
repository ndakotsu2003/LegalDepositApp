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
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/dtcss/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./fontawesome-free-6.5.1-web/css/all.min.css">
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
     

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--<script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>-->
    <script defer src="js.js"></script>
    <title>Home</title>
</head>
<body>
        <header>
        <?php include("topbarr.php"); ?>
        </header>
    
        
<div id="displaytable">
    <?php
if ($_SESSION['sType'] == 'admin'){
    include("sidebar.php");   
                          }
                       else {
                        include("sidebar1.php");
                       } ?>
        <!--<?php include("sidebar.php"); ?>-->
    <div id="tabdiv">
              <table class="table table-bordered " id="tab">
        
            <thead>
            <tr>
            <th class="tab_head" scope="col">#</th>
            <th class="tab_head" scope="col">Title</th>
            <th class="tab_head" scope="col">Author</th>
            <th class="tab_head" scope="col">Publishers Name</th>
            <th class="tab_head" scope="col">Type</th>
            <th class="tab_head" scope="col">Copies Deposited</th>
            <th class="tab_head" scope="col">Remaining Deposit</th>
            <th class="tab_head" scope="col">Action</th>
</tr>
          </thead>
            <tbody>
               
            <?php
                $query = "select books.book_id, books.title, books.author, books.p_name,books.p_of_pub,books.y_of_pub,books.isbn_ssn,books.access_no,legald.l_dep_no,legald.copies_deposit,legald.deposited,legald.dep_type,legald.contact_address,legald.remark from books inner join legald on books.book_id = legald.book_id ORDER by legald.d_o_dep DESC";
                $result = mysqli_query($config, $query);
                
                        
                    $i =1;
                while($row = mysqli_fetch_assoc($result)){
                    if($row['copies_deposit'] - $row['deposited'] != 0){
                    
            ?>
        
            <tr scope="row" class="tab-row">
             <td class="tab_data"><?php echo $i?></td>
             <td class="tab_data"><?php echo trim($row['title'])?></td>
             <td class="tab_data"><?php echo trim($row['author'])?></td>
             <td class="tab_data"><?php echo trim($row['p_name'])?></td>
             <td class="tab_data"><?php echo trim($row['dep_type'])?></td>
             <td class="tab_data"><?php echo trim($row['deposited'])?></td>
             <td class="tab_data"><?php echo trim($row['copies_deposit'] - $row['deposited'])?></td>
            <?php if($_SESSION['sType'] == 'admin'){ ?>
             <td class="tab_data action_butt">
                <a class="btt"><button id="del" onclick = "deleted(<?php echo $row['book_id']?>)" value = "<?php echo $row['book_id']?>">Delete</button></a>
             <a class="btt" href= "edit.php?id=<?php echo $row['book_id']?> & crazy"  ><button id="edit">Edit</button></a>
             <a class="btt" href= "view.php?id=<?php echo $row['book_id']?> & crazy"  ><button id="view">View</button></a>
            </td> 
            <?php }
             else {?>
             <td class="tab_data action_butt">
             <a class="btt" href= "edit.php?id=<?php echo $row['book_id']?> & crazy"  ><button id="edit">Edit</button></a>
             <a class="btt" href= "view.php?id=<?php echo $row['book_id']?> & crazy"  ><button id="edit">View</button></a>

             <?php }?>
             
            </tr>
            <?php 
            $i++;
            } }?>
            </tbody>
            </table>
        </div>


    </div>
   

    <script src="jquery/jquery3.7.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.bootstrap5.js"></script>
    
    
</body>
</html>