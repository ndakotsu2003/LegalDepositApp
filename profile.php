<?php
    session_start();
    include("php/config.php");
    include("php/functions.php");
    
    
    
    $user_data = check_login($config);
    $user_id = $_SESSION['userName'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/dtcss/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery/jquery3.7.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Profile</title>
</head>
<body>
    <header>
    <?php include("topbarr.php"); ?>
    </header>
    <div class="containpr">
    <?php
    if ($_SESSION['sType'] == 'admin'){
    include("sidebar.php");   
                          }
                       else {
                        include("sidebar1.php");
                       } ?>
        <div id="profile">
            
            <div id="prof_img">

            </div>
            <div id="edit_prof"><button id="edit_pro"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >Edit Profile</button></div>
            <div id="prof_work">
                <table class="table table-bordered " id="tabpr">
                    <thead>
                        <tr>
                            <th class="tab_head" scope="col">#</th>
                            <th class="tab_head" scope="col">Title</th>
                            <th class="tab_head" scope="col">Author</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "select books.title, books.author, legald.dep_type, legald.user_id from books inner join legald on books.book_id = legald.book_id where legald.user_id = '$user_id'";
                        $result = mysqli_query($config, $query);
                        
                                
                            $i =1;
                        while($row = mysqli_fetch_assoc($result)){
                            
                    ?>
                        <tr scope="row" class="tab-row">
                            <td class="tab_data"><?php echo $i?></td>
                            <td class="tab_data"><?php echo trim($row['title'])?></td>
                            <td class="tab_data"><?php echo trim($row['author'])?></td>
                            
                    
                    </tr>
                    <?php 
                    $i++;
                    } ?>
                    </tbody>
                </table>

            </div>
        </div>
        
                <!-- Edit profile Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php
                                if(isset($_POST['update'])){
                                    $firstname = $_POST['fname'];
                                    $sname = $_POST['surname'];
                                        
                                    $query = "update   users SET f_name ='$firstname',surname ='$sname' where user_id = $user_id";
                                    mysqli_query($config,$query) or die("Error connecting to server");
                                
                                    
                                    header("Location: profile.php");

                                }
                            ?>
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p id = "display_message"></p>
                                <div id= "Records">
                                    <p id="prof_details">Profile Details</p>
                                    <?php 
                                    $query = "select f_name, surname from users where user_id='$user_id'";
                                    $result = mysqli_query($config, $query); 

                                        $row= mysqli_fetch_assoc($result);

                                    
                                    ?>
                                   <div id= "view_records"> 
                                        <div class="prof_info">
                                            <label for= "uID" class="labels">User ID: </label>
                                            <input class="u_prof" type="text" value="<?php echo $user_id?>" id="uId">
                                        </div>
                                        <div class="prof_info">
                                            <label for= "fname" class="labels">First Name: </label>
                                            <input class="u_prof" type="text" value="<?php echo $row['f_name']?>" id="fname" name="fname">
                                        </div>
                                        <div class="prof_info">
                                            <label for= "surname" class="labels">First Name: </label>
                                            <input class="u_prof" type="text" value="<?php echo $row['surname']?>" id="surname" name="surname">
                                        </div>
                            </div>
                                    </div>

                                <button type="button" class="btn btn secondary"data-bs-toggle="modal" data-bs-target="#modal2" data-bs-dismiss="modal">Edit Password</button>  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="update" name="update">Save changes</button>
                                    
                                  </div>
                        </div>
                    </div>
         </div>

                            <!-- Change password Modal -->
                <div class="modal fade " id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                               <h5 class="modal-title">Update Password</h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="p_details">
                                <?php
                                        $query2 = "select p_word from users where user_id='$user_id'";
                                        $result2 = mysqli_query($config, $query2); 
    
                                            $row2= mysqli_fetch_assoc($result2);
                                    ?>
                                    <input type = "hidden" id="old_password"  value="<?php echo $row2['p_word']?>">
                                        <div class="prof_info">
                                                    <label for= "old_p" class="labels">Old Password: </label>
                                                    <input class="u_prof" type="password"  id="old_p" name="old_p">
                                        </div>
                                        <div class="prof_info">
                                            <label for= "new_p" class="labels">New Password:  </label>
                                            <input class="u_prof" type="password"  id="new_p" name="new_p">
                                        </div>                                    

                                </div>

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_p" name="update_p" onclick="check('<?php echo $user_id?>')">Update</button> 
                            </div>

                        </div>

                    </div>

                </div>
                             
                            <!-- end  -->
    
    </div>
    
<script>
    function update(id){
        $.ajax({

            url: "profile_deets.php",
			method: "POST",
            data: {profile: true,
                id: id
                    
              }
            ,
			success: function(reply){
                           
             $('#view_records').html(reply);
            
             
            }
        });

    }

    function check(data){
        var o = $('#old_password').val();
        var n= $('#old_p').val();
        var n_p = $('#new_p').val();
            console.log(data + n+ n_p);
       
    if(o == n){
       
            $.ajax({
                url:"updatepassword.php",
                method: "POST",
                data:{update_password: true,
                        n_p: n_p,
                        data: data

                },
                success: function(reply){
                           if (reply == 1){
                            alert('Success!!');

                           }
                           else{
                            alert('Fail');
                           }
               
                          
                           
                 }

            });
        }else{
            alert("Not Updated");
        }
    }
    </script>
    
       
    
    
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.bootstrap5.js"></script>
    
    <script src="jquery/jquery3.7.js"> </script>
    
    
    
</body>
</html>

