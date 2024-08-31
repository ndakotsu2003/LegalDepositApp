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
            <div id="edit_prof"><a  href= "register.php?id=<?php echo $user_id?> & crazy"  ><button id="edit_pro">Edit Profile</button></a></div>
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

    </div>
    

    
       
    
    <script src="jquery/jquery3.7.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.bootstrap5.js"></script>
    
    <script src="jquery/jquery3.7.js"> </script>
    
    
    
</body>
</html>

