<?php
 session_start();
 include("php/config.php");
 include("php/functions.php");
 $user_data = check_login($config);

 $b_id = $_GET['id'];


 




 if(isset($_POST['submit'])){
   
    $book_title = $_POST['b_title'];
    $authorname = $_POST['authname'];
    $email = $_POST['email'];
    $p_number = $_POST['p_number'];
    $pub_name= $_POST['p_name'];
    $placeofpub = $_POST['p_publication'];
    $y_pub = $_POST['y_publication'];
    $isbn = $_POST['isbn_ssn'];
    $acc_no = $_POST["ac_no"];
    $book_cat = $_POST["bCat"];
    $deposit_no = $_POST["ld_no"];
    $date_dep = $_POST['d_o_d'];
    $booktype = $_POST["bType"];
    $aDeposited = $_POST["deposited"];
    $dep_type = $_POST["gui"];
    $state_dep = $_POST["sDepo"];
    $con_add = $_POST["c_add"];
    $remarks = $_POST["remarks"];

    $query = "update   books SET title ='$book_title',author ='$authorname', email = '$email',p_number = '$p_number',p_name ='$pub_name',p_of_pub ='$placeofpub',y_of_pub =$y_pub,isbn_ssn = '$isbn',access_no = '$acc_no',book_type='$book_cat' where book_id = $b_id";
    $query2="update legald SET l_dep_no='$deposit_no' ,copies_deposit='$booktype',deposited='$aDeposited',dep_type='$dep_type',s_o_dep ='$state_dep', d_o_dep='$date_dep', contact_address='$con_add',remark='$remarks' where book_id=$b_id";
    mysqli_query($config,$query) or die("Error connecting to server");
    mysqli_query($config,$query2) or die("Error connecting to server");


    header("Location: index.php");
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Legal Deposit</title>
</head>
<body>
<header>
        <?php include("topbarr.php"); ?>
        </header>

<div class="contain">
         <?php
        if ($_SESSION['sType'] == 'admin'){
                         include("sidebar.php");   
                          }
                       else {
                        include("sidebar1.php");
                       } ?>
                       
        <div class="form">
            <?php 
                    if(isset($_GET['id'])){
                            
                        $que ="select books.book_id, books.title, books.author,books.email, books.p_number, books.p_name,books.p_of_pub,books.y_of_pub,books.isbn_ssn,books.access_no,books.book_type,legald.l_dep_no,legald.copies_deposit,legald.dep_type,legald.s_o_dep,legald.d_o_dep,legald.contact_address,legald.remark ,SUM(depo_history.deposited) as tots from books inner join legald on books.book_id = legald.book_id inner join depo_history on legald.l_dep_no = depo_history.l_dep_no where books.book_id = '$b_id'";
                        $result = mysqli_query($config, $que); 

                        $row2= mysqli_fetch_assoc($result);
                   
            ?>
            <div id="logos">UPDATE LEGAL DEPOSIT ENTRY</div>
            <form method="post" action="" class="lForm">

                <div id="formname"><h3>UPDATE LEGAL DEPOSIT ENTRY</h3></div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Book title" placeholder="Book Title" value ="<?php echo $row2['title']?>" name="b_title" id="b_title">
                </div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Authors Name" placeholder="Author/Editors Name" value =<?php echo $row2['author']?> name="authname" id="authname">
                </div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Email Address" placeholder="Email Address" value =<?php echo $row2['email']?> name="email" id="email" >
                </div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Phone Number" placeholder="Phone Number" value =<?php echo $row2['p_number']?> name="p_number" id="p_number">
                </div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Publishers Name" placeholder="Publishers Name" value =<?php echo $row2['p_name']?> name="p_name" id="p_name">
                </div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Place of Publication" placeholder="Place of Publication" value=<?php echo $row2['p_of_pub']?> name="p_publication" id="p_publication">
                </div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Year of Publication" placeholder="Year of Publication" value=<?php echo $row2['y_of_pub']?> name="y_publication" id="y_publication">
                </div>

                <div class="inputentry">
                    <input type="text" class="legInput" alt="ISBN/ISSN" placeholder="ISBN/ISSN" value=<?php echo $row2['isbn_ssn']?> name="isbn_ssn" id="isbn_ssn">
                </div>
                <div class="bookCat">
                    <label for="bookCatee" id="booklabel2">Book Category</label>
                    <select name="bCat" id="bookCatee">
                        <option value=" " disabled selected>Select Type</option>
                        <option value="Monographs" <?php if($row2['book_type'] == "Monographs"){ echo 'selected';} ?>>Monographs</option>
                        <option value="Serials" <?php if($row2['book_type'] == "Serials"){ echo 'selected';} ?>>Serials</option>
                       

                    </select>
                </div>

                <div class="inputentry">
                    <input type="text" class="legInput" alt="Accession Number" placeholder="Accession Number" value=<?php echo $row2['access_no']?> name="ac_no" id="ac_no">
                </div>
                <div class="inputentry">
                    <input type="text" class="legInput" alt="Legal Deposit Number" placeholder="Legal Deposit Number" value="<?php echo $row2['l_dep_no']?>" name="ld_no" id="ld_no">
                </div>

                <div class="dateDep">
                <label for="d_o_d" id="datelabel">Date of Deposit</label>
                    <input type="text" class="legInput" alt="Date of Deposit"  value="<?php echo $row2['d_o_dep']?>" placeholder="Date of Deposit" name="d_o_d" id="d_o_d">
                </div>
                <div class="booktype">
                    <label for="bookt" id="booklabel">Type</label>
                    <select name="bType" id="bookt"  readonly>
                        <?php if ($row2['copies_deposit'] !="10" && $row2['copies_deposit'] !="3" && $row2['copies_deposit'] !="25") {?>
                        <option value="" selected></option> <?php } ?>
                        <option value="3" <?php if($row2['copies_deposit'] == "3"){ echo 'selected';} ?>>Private</option>
                        <option value="10"<?php if($row2['copies_deposit'] == "10"){ echo 'selected';} ?>>State</option>
                        <option value="25" <?php if($row2['copies_deposit'] == "25"){ echo 'selected';} ?>>Federal</option>

                    </select>
                    <input type="text" class="legInput" value=<?php echo $row2['tots']?> placeholder="Amount Deposited"name="deposited" id="deposited" readonly>
                    <input type="hidden" value=<?php echo $row2['copies_deposit']?> name="c_d" id="c_d" >
                    <button type="button" value="<?php echo $row2['l_dep_no']?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="tef" onclick= "testter('<?php echo $row2['l_dep_no']?>')">Add</button>
                    
                    <input type="hidden" value=<?php echo $row2['dep_type']?> name="gui" id="gui">
                </div>
                <div class="soDeposit">
                    <label for="soD" id="booklabel1">State of Deposit</label>
                    <select name="sDepo" id="soD">
                    
                            <option disabled <?php if($row2['s_o_dep'] == "NULL"){ echo 'selected';} ?>>Select State</option>
                            <option value="Abia" <?php if($row2['s_o_dep'] == "Abia"){ echo 'selected';} ?>>Abia</option>
                            <option value="Adamawa" <?php if($row2['s_o_dep'] == "Adamawa"){ echo 'selected';} ?>>Adamawa</option>
                            <option value="Akwa Ibom" <?php if($row2['s_o_dep'] == "Akwa Ibom"){ echo 'selected';} ?>>Akwa Ibom</option>
                            <option value="Anambra" <?php if($row2['s_o_dep'] == "Anambra"){ echo 'selected';} ?>>Anambra</option>
                            <option value="Bauchi" <?php if($row2['s_o_dep'] == "Bauchi"){ echo 'selected';} ?>>Bauchi</option>
                            <option value="Bayelsa" <?php if($row2['s_o_dep'] == "Bayelsa"){ echo 'selected';} ?>>Bayelsa</option>
                            <option value="Benue" <?php if($row2['s_o_dep'] == "Benue"){ echo 'selected';} ?>>Benue</option>
                            <option value="Borno" <?php if($row2['s_o_dep'] == "Borno"){ echo 'selected';} ?>>Borno</option>
                            <option value="Cross River" <?php if($row2['s_o_dep'] == "Cross River"){ echo 'selected';} ?>>Cross River</option>
                            <option value="Delta" <?php if($row2['s_o_dep'] == "Delta"){ echo 'selected';} ?>>Delta</option>
                            <option value="Ebonyi" <?php if($row2['s_o_dep'] == "Ebonyi"){ echo 'selected';} ?>>Ebonyi</option>
                            <option value="Edo" <?php if($row2['s_o_dep'] == "Edo"){ echo 'selected';} ?>>Edo</option>
                            <option value="Ekiti" <?php if($row2['s_o_dep'] == "Ekiti"){ echo 'selected';} ?>>Ekiti</option>
                            <option value="Enugu" <?php if($row2['s_o_dep'] == "Enugu"){ echo 'selected';} ?>>Enugu</option>
                            <option value="FCT" <?php if($row2['s_o_dep'] == "FCT"){ echo 'selected';} ?>>Federal Capital Territory</option>
                            <option value="Gombe" <?php if($row2['s_o_dep'] == "Gombe"){ echo 'selected';} ?>>Gombe</option>
                            <option value="Imo" <?php if($row2['s_o_dep'] == "Imo"){ echo 'selected';} ?>>Imo</option>
                            <option value="Jigawa" <?php if($row2['s_o_dep'] == "Jigawa"){ echo 'selected';} ?>>Jigawa</option>
                            <option value="Kaduna" <?php if($row2['s_o_dep'] == "Kaduna"){ echo 'selected';} ?>>Kaduna</option>
                            <option value="Kano" <?php if($row2['s_o_dep'] == "Kano"){ echo 'selected';} ?>>Kano</option>
                            <option value="Katsina" <?php if($row2['s_o_dep'] == "Katsina"){ echo 'selected';} ?>>Katsina</option>
                            <option value="Kebbi" <?php if($row2['s_o_dep'] == "Kebbi"){ echo 'selected';} ?>>Kebbi</option>
                            <option value="Kogi" <?php if($row2['s_o_dep'] == "Kogi"){ echo 'selected';} ?>>Kogi</option>
                            <option value="Kwara" <?php if($row2['s_o_dep'] == "Kwara"){ echo 'selected';} ?>>Kwara</option>
                            <option value="Lagos" <?php if($row2['s_o_dep'] == "Lagos"){ echo 'selected';} ?>>Lagos</option>
                            <option value="Nasarawa" <?php if($row2['s_o_dep'] == "Nasarawa"){ echo 'selected';} ?>>Nasarawa</option>
                            <option value="Niger" <?php if($row2['s_o_dep'] == "Niger"){ echo 'selected';} ?>>Niger</option>
                            <option value="Ogun" <?php if($row2['s_o_dep'] == "Ogun"){ echo 'selected';} ?>>Ogun</option>
                            <option value="Ondo" <?php if($row2['s_o_dep'] == "Ondo"){ echo 'selected';} ?>>Ondo</option>
                            <option value="Osun" <?php if($row2['s_o_dep'] == "Osun"){ echo 'selected';} ?>>Osun</option>
                            <option value="Oyo" <?php if($row2['s_o_dep'] == "Oyo"){ echo 'selected';} ?>>Oyo</option>
                            <option value="Plateau" <?php if($row2['s_o_dep'] == "Plateau"){ echo 'selected';} ?>>Plateau</option>
                            <option value="Rivers" <?php if($row2['s_o_dep'] == "Rivers"){ echo 'selected';} ?>>Rivers</option>
                            <option value="Sokoto" <?php if($row2['s_o_dep'] == "Sokoto"){ echo 'selected';} ?>>Sokoto</option>
                            <option value="Taraba" <?php if($row2['s_o_dep'] == "Taraba"){ echo 'selected';} ?>>Taraba</option>
                            <option value="Yobe" <?php if($row2['s_o_dep'] == "Yobe"){ echo 'selected';} ?>>Yobe</option>
                            <option value="Zamfara" <?php if($row2['s_o_dep'] == "Zamfara"){ echo 'selected';} ?>>Zamfara</option>
                            </select>
                </div>

                <div class="inputentry">
                    <input type="text" class="legInput" alt="Contact Address" placeholder="Contact Address" value=<?php echo $row2['contact_address']?> name="c_add" id="c_add">
                </div>
                <div class="textentry">
                    <label for="remarks" id="remarklabel">Remarks</label>
                    <textarea alt="Remarks" placeholder="Remarks to be made......" name="remarks" id="remarks" rows="5" cols="50" > <?php echo $row2['remark']?> </textarea>
                </div>
                <div id="subbutton">
                    <button type="submit" id="subLeg" name="submit">Update</button>
                </div>

               
            </form>
                       

            
            </div>
            
      
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Deposit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p id = "weyre"></p>
                                <div id= "add_depo">
                                    <p id="error"></p>
                                   <div> <label> Amount Remaining: </label><input type="text" name="amount_adep" id="amount_adep" readonly></div>
                                    <div><label>Deposting: </label><input type="text" name="amount_todep" id="amount_todep"></div>
                                </div>

                                  
                        </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"  onclick= "updater('<?php echo $row2['l_dep_no']?>','<?php echo $b_id?>')">Save changes</button>
                                  </div>
                        </div>
                    </div>
         </div>
         <?php } ?>
    </div>

                
    <script>
        document.getElementById('bookt').addEventListener("click",type,true);
         function type(){
            var vv = document.getElementById("bookt").value;
            if(vv == "3"){
                document.getElementById("gui").value= "Private";
            }
            else if (vv == "10"){
                document.getElementById("gui").value= "State";
            }
            else{
                document.getElementById("gui").value= "Federal";
            }
        }

        window.onload = function(){
            var btn = document.getElementById('tef');
            var a  = document.getElementById('c_d').value;
            var b = document.getElementById('deposited').value;
           
            if (a == b){
                    btn.disabled = true;
            }
            else{
                    btn.disabled = false;
            }
         }
        

        function trial(){
            var cc = document.getElementById('tef').value;
            document.getElementById('weyre').innerHTML= cc;
        } 

        function testter(check){
            console.log(check);
            $.ajax({
			url: "addition.php",
			method: "POST",
            data: {pop_out: true,
                check: check
                    
              }
            ,
			success: function(data){
                           
             $("#amount_adep").val(data);
             
            }
		});
        }

        function updater(legD, bookId){
            console.log('it passed the test before');
            var add = $('#amount_todep').val();
            var sub = $('#amount_adep').val();
            console.log(add + sub);
           if (add <= sub && add != '' && add != 0){
           
            $.ajax({
			url: "usecase.php",
			method: "POST",
            data: {update_dep: true,
                legD: legD,
                bookId: bookId,
                add: add
                    
              }
            ,
			success: function(reply){
                           
             $('#error').html(reply);
            
             
            }
		});
    }
    else{
        $('#error').html("Entry not valid");

    }
        }
    </script>
    <script>
    <script src="jquery/jquery3.7.js"></script>
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</script>
    
</body>
</html>