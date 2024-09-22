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
    <!--<link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/dtcss/dataTables.bootstrap5.css">-->
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
     <a class="alink" href="legalentry.php"><button class = "add">New Entry <i class="fa-solid fa-plus"></i></button></a>
                <div id="search">
                    <div id ="outer"><input type ="text" placeholder ="Search........" id="search_field" name="search_field" onfocus="filt()"></input></div>
                    <button id="search_btn" onclick="view()">Search</button>
                </div>
            <table class="table table-bordered " id="tab">
                     
                    <thead id="tab_head">
                    <tr>
                    <th class="tab_head" scope="col">#</th>
                    <th class="tab_head" scope="col">Title</th>
                    <th class="tab_head" scope="col">Author</th>
                    <th class="tab_head" scope="col">Publishers Name</th>
                    <th class="tab_head" scope="col">ISBN/ISSN</th>
                    <th class="tab_head" scope="col">Accession No</th>
                    <th class="tab_head" scope="col">Legal Deposit No</th>
                    <th class="tab_head" scope="col">Copies Deposited</th>
                    <!--<th class="tab_head" scope="col">Remark</th>-->
                    <th class="tab_head" scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody id="tab_bod">
                    
                    <?php
                        $query = "select books.book_id, books.title, books.author, books.p_name,books.p_of_pub,books.y_of_pub,books.isbn_ssn,books.access_no,legald.l_dep_no,legald.copies_deposit,legald.contact_address,legald.remark from books inner join legald on books.book_id = legald.book_id ORDER by legald.d_o_dep DESC";
                        $result = mysqli_query($config, $query);
                        
                                
                            $i =1;
                        while($row = mysqli_fetch_assoc($result)){
                            
                    ?>
                
                    <tr scope="row" class="tab-row">
                    <td class="tab_data"><?php echo $i?></td>
                    <td class="tab_data"><?php echo trim($row['title'])?></td>
                    <td class="tab_data"><?php echo trim($row['author'])?></td>
                    <td class="tab_data"><?php echo trim($row['p_name'])?></td>
                    <td class="tab_data"><?php echo trim($row['isbn_ssn'])?></td>
                    <td class="tab_data"><?php echo trim($row['access_no'])?></td>
                    <td class="tab_data"><?php echo trim($row['l_dep_no'])?></td>
                    <td class="tab_data"><?php echo trim($row['copies_deposit'])?></td>
                    <!--<td class="tab_data"><?php echo trim($row['remark'])?></td>-->
                    <?php if($_SESSION['sType'] == 'admin'){ ?>
                    <td class="tab_data action_butt"><a class="btt"><button id="del" onclick = "deleted(<?php echo $row['book_id']?>)" value = "<?php echo $row['book_id']?>">Delete</button></a>
                    <a class="btt" href= "edit.php?id=<?php echo $row['book_id']?> & crazy"  ><button id="edit">Edit</button></a>
                    <!--<a class="btt" href= "view.php?id=/*<?php echo $row['book_id']?> & crazy"  >--><button type="button" value="" class=" " data-bs-toggle="modal" data-bs-target="#exampleModal" id="view_btn" onclick= "view_details(<?php echo $row['book_id']?>)">View</button>
                    </a>
                    </td> 
                    <?php }
                    else {?>
                    <td class="tab_data action_butt">
                    <a class="btt" href= "edit.php?id=<?php echo $row['book_id']?> & crazy"  ><button id="edit">Edit</button></a>
                    <!--<a class="btt" href= "view.php?id=/*<?php echo $row['book_id']?> & crazy"  >--><button type="button" value="" class=" " data-bs-toggle="modal" data-bs-target="#exampleModal" id="view_btn" onclick= "view_details(<?php echo $row['book_id']?>)">View</button>

                    <?php }?>
                    
                    </tr>
                    <?php 
                    $i++;
                    } ?>
                    </tbody>
            </table>
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
    let you  = document.getElementById('mod');
    let you2  = document.getElementById('weyre');
    let you3  = document.getElementById('del');
    let yes  = document.getElementById('yesbtn');
    let yesA  = document.getElementById('yesA');
    let lori  = document.getElementById('lori');
    let ref= document.querySelector('.tt');
    let yrr  = document.getElementById('yy');
    function dissappear(){
            you.style.display = "none";
    }
   /* window.onload = function(){
        $('table').dataTable({searching: false, paging: false, info: false});
    }*/
    function appear(){
        you.style.display = "block";
        let r = you3.value;
        yes.value = r;
        lori.innerText = r;
        yesA.href = "delete.php?id="+yes.value;

        


    }

    function deleted(id){
        
        
        console.log(id);
        var result = confirm("Are you sure you want to delete?");
   if(result){

        $.ajax({
			url: "delete.php",
			method: "POST",
			data: {id: id,
                action: "deleterecord"
            
                  }
            ,
			success: function(response){
                           
             if(response == 1){
               alert("Data Deleted Successfully");
               location.reload();
             }
             else {
              alert("Data Cannot Be Deleted");
              location.reload();
             }
            }
		});

    }  

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
    function filt(){
        $("#tab_head").hide();
        $("#tab_bod").hide();
       $("#search_field").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tab_bod tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


    }

    function view (){
        var input = $("#search_field").val();
        console.log(input);
        if(input){
            $("#tab_head").show();
            $("#tab_bod").show();
          
        }else{
            
        }
        
       
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
<script>
/*$(document).ready(function(){
  $("#search_field").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tab_bod tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});*/
</script>
    <script src="jquery/jquery3.7.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <!--<script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.bootstrap5.js"></script>-->
    
    
</body>
</html>