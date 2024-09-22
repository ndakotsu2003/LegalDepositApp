<?php
    session_start();
    include("php/config.php");
    include("php/functions.php");
    include("topbarr.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="jquery/jquery3.7.js"></script>
    <script defer src="js.js"></script>
    <title>Home</title>
</head>
<body>
        
<div id="displaytable">
<?php
if ($_SESSION['sType'] == 'admin'){
    include("sidebar.php");   
                          }
                       else {
                        include("sidebar1.php");
                       } ?>
        
        
        <div id="tabdiv">
        <a class="alink" href="register.php"><button class="add">New User <i class="fa-solid fa-plus"></i></button></a>
                <table class="table table-bordered" id="tab">
                    <thead class="">
                        <th class="tab_head">#</th>
                        <th class="tab_head">First Name</th>
                        <th class="tab_head">Surname</th>
                        <th class="tab_head">Type</th>
                        <th class="tab_head">Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $query = "select * from users";
                            $result = mysqli_query($config, $query);
                            
                                    
                                $i =1;
                            while($row = mysqli_fetch_assoc($result)){
                                
                        ?>
                    
                        <tr>
                        <td class="tab_data"><?php echo $i?></td>
                        <td class="tab_data"><?php echo $row['f_name']?></td>
                        <td class="tab_data"><?php echo $row['surname']?></td>
                        <td class="tab_data"><?php echo $row['type']?></td>
                        <!--<td class="tab_data"><a><button id="del" onclick = "deleted(<?php echo $row['user_id']?>)"  value = "<?php echo $row['user_id']?>">Delete </button></a><a href= "register.php?id=<?php echo $row['user_id']?> & crazy"  ><button >Edit</button></a></td> -->
                        <td class="tab_data action_butt"><a class="btt"><button id="del1" onclick = "deleted('<?php echo $row['user_id']?>')" value = "<?php echo $row['user_id']?>">Delete</button></a>
                        <a class="btt" ><button id="edit1" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="fill('<?php echo $row['user_id']?>', '<?php echo $row['f_name']?>', '<?php echo $row['type']?>')" >Edit</button></a>
                        </td> 
                        </tr>
                        <?php 
                    $i++;
                    } ?>
                    </tbody>
             </table>
            
             <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">User Info</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p id = "weyre"></p>
                                <div id= "add_depo">
                                    <p id="error"></p>
                                    <div class="inputfield">
                                        <p>USERNAME:  <span id="username"></span></p>
                                        <p>FIRSTNAME:  <span id="firstname"></span></p>
                                        <p>TYPE:  <span id="s_type"></span></p>
                                    </div>
                                    <div id="update_h"><p>Update Staff Type</p></div>
                                    <div id="update_t">
                                        
                                        <label for="stafft1" id="stafflabel1">Type</label>
                                                <select name="sType" id="stafft1">
                                                
                                                    <option value=" "></option>
                                                    <option value="staff">Staff</option>
                                                    <option value="admin">Admin</option>

                                                </select>
                                    
                                </div>
                            </div>

                                  
                        </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"  onclick= "upload()">Save changes</button>
                                  </div>
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
    let tester  = document.getElementById('rre');
    

    function deleted(id){
          
        var result = confirm("Are you sure you want to delete?");
   if(result){
        $.ajax({
			url: "delete.php",
			method: "POST",
			data: {
                id: id,
                action: "deleteuser"
                }
			,
			success: function(response){
              // Response is the output of action file
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

    function fill(u_name, f_name, s_type){
        document.getElementById('username').innerHTML = u_name;
        document.getElementById('firstname').innerHTML = f_name;
        document.getElementById('s_type').innerHTML = s_type;
       
    }
    function upload(){
        var user_id = document.getElementById('username').innerHTML;
        var new_type = document.getElementById('stafft1').value;
        console.log(new_type + user_id);
        $.ajax({
            url: "user_edit.php",
			method: "POST",
            data: {popT: true,
               user_id: user_id,
               new_type: new_type
                    
              }
            ,
			success: function(reply){
                           
             if(reply ==1){
                alert("Success");
             }else{
                alert("fail");
             }
             
             
            }

        });
    }
    </script>
    </script>
    <script src="jquery/jquery3.7.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.bootstrap5.js"></script>
</body>
</html>