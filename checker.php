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
                $query = "select books.book_id, books.title, books.author, books.email, books.p_number, books.p_name,books.p_of_pub,books.y_of_pub,books.isbn_ssn,books.access_no,legald.l_dep_no,legald.copies_deposit,legald.deposited,legald.dep_type,legald.contact_address,legald.remark from books inner join legald on books.book_id = legald.book_id ORDER by legald.d_o_dep DESC";
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
            
                <td class="tab_data action_butt">
                    
                    <button type ="button"onclick = "mail('<?php echo $row['email']?>')" id="reminder"> <i class="fa-regular fa-envelope"></i></button>
                    <a class="btt" href= "edit.php?id=<?php echo $row['book_id']?> & crazy"  ><button id="edit">Edit</button></a>
                    <button type="button" value="" class=" " data-bs-toggle="modal" data-bs-target="#exampleModal" id="view_btn" onclick= "view_details(<?php echo $row['book_id']?>)">View</button>
                </td> 
            </tr>
            <?php 
            $i++;
            } }?>
            </tbody>
            </table>

            
            <div id= "ttx"></div>
            <p id ="tty">BOZO</p>
            </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">View Record</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id = "display_message"></p>
                                    <div id= "Records">
                                        <p id="dep_details">Legal Deposit Details</p>
                                    <div id= "view_records"> 

                                        </div>

                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        
                                    </div>
                            </div>
                        </div>
            </div>
          

    </div>

    <script>
        function mail(email){
            console.log(email);
            $.ajax({

            url: "mail.php",
			method: "POST",
            data: {mail: true,
                email: email
                    
              }
            ,
			success: function(reply){
                           
                $("#tty").text(reply);
             
            }
            });
        }

        function view_details(see){

       
                $.ajax({
                    url: "view.php",
                    method: "POST",
                    data: {
                        pop_out3: true,
                        see: see
                            
                        }
                    ,
                    success: function(reply){
                                    
                    $('#view_records').html(reply);
                    
                    }

                });

        }

        function print(){
        console.log("print");
		var _html = $('#receipt').clone();
		var newWindow = window.open(" "," ","menubar=no,scrollbars=yes,resizable=yes,width=700,height=600");
		newWindow.document.write(_html.html())
		newWindow.document.close()
		newWindow.focus()
		newWindow.print()
		setTimeout(function(){;newWindow.close();}, 1500);
	}
    
        </script>
   

    <script src="jquery/jquery3.7.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.bootstrap5.js"></script>
    
    
</body>
</html>