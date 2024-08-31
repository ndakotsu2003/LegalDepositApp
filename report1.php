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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="js.js"></script>
    <title>Report</title>
</head>
<body>
            <header>
            <?php include("topbarr.php"); ?>
            </header>
<div class="contain">
            <?php if ($_SESSION['sType'] == 'admin'){
                        include("sidebar.php");   
                          }
                       else {
                        include("sidebar1.php");
                       } 
            ?>
       <div id="div_bod">     
            <div id="top_part">
                        <div id="r_header"><span>REPORTS</span></div>
                    <div id="date">
                        <p id="instruction">Please Select the range you want reported</p>
                        <div id="selectt">
                            <div id="left_select">
                                <span class="sp">From :</span>
                                <input id="d_from" type="date">
                           </div>
                           <div id="right_select">
                                <span class="sp">To :</span>
                                <input id="d_to" type="date">
                           </div>
                        </div>
                        <div id="generate">
                            <button onclick="populate()">Generate</button>
                        </div>
                    </div>
                </div>
                <div id="report">
                    <div id="table1">
                        <p>A total of <span id="fillu"></span>  titles were recieved in the period between <span id="fr"></span> and <span id="to"></span>. <p>
                            <table class="table table-bordered" id="tab_1">
                                <thead>
                                    
                                    <colgroup>
                                                    <col width="10%">
                                                    <col width="20%">
                                                    <col width="10%">
                                                    <col width="10%">
                                                    
                                                </colgroup>
                                    <tr>
                                        <th class="text-center">S/N</th>
                                        <th class="text-center">Materials Recieved</th>
                                        <th class="text-center">Titles</th>
                                        <th class="text-center">Volumes</th>
                                        
                                    </tr>
                                                    </thead>
                            <tbody id="tab1">



                            </tbody>


                                                    </table>


                    </div>
                    <div id="table2">
                    <p>Statistics Report for the deposit of materials by State between the period of <span id="fr1"></span> and <span id="to1"></span>. <p>
                            <table class="table table-bordered" id="tab_2">
                                <thead>
                                    
                                    <colgroup>
                                                    <col width="10%">
                                                    <col width="20%">
                                                    <col width="10%">
                                                    <col width="10%">
                                                    
                                                </colgroup>
                                    <tr>
                                        <th class="text-center">S/N</th>
                                        <th class="text-center">State</th>
                                        <th class="text-center">Titles</th>
                                        <th class="text-center">Volumes</th>
                                        
                                        
                                    </tr>
                                                    </thead>
                            <tbody id="tab2">



                            </tbody>


                                                    </table>


                    </div>


                    <div id="table3">
                    <p>A total of <span id="fillu_1"></span> volumes in <span id="span"></span> titles of Monographs and Serials were documented. <p>
                            <table class="table table-bordered" id="tab_3">
                                <thead>
                                    
                                    <colgroup>
                                                    <col width="10%">
                                                    <col width="20%">
                                                    <col width="10%">
                                                    
                                                </colgroup>
                                    <tr>
                                        <th class="text-center">x</th>
                                        <th class="text-center">Titles</th>
                                        <th class="text-center">Volumes</th>
                                        
                                        
                                    </tr>
                                                    </thead>
                            <tbody id="tab3">



                            </tbody>


                                                    </table>


                    </div>
                </div>
         </div>
            
    </div>
    <script>
      
            
       
        function populate_year(){
            let dateDropdown = document.getElementById('year_drop'); 
       
            let currentYear = new Date().getFullYear();    
            let earliestYear = 2000;     
            while (currentYear >= earliestYear) {      
                let dateOption = document.createElement('option');          
                dateOption.text = currentYear;      
                dateOption.value = currentYear;        
                dateDropdown.add(dateOption);      
                currentYear -= 1;  
            }  
        }

        function populate(){
            firsttable();
           secondtable();
            thirdtable();
        }
        function firsttable(){
            var d_from = document.getElementById("d_from").value;
            var d_to = document.getElementById("d_to").value;
            console.log(d_from);
            console.log(d_to);

            $.ajax({
			url: "rep1.php",
			method: "POST",
			data: {d_from: d_from,
                    d_to: d_to,
                action: "populate_first"
            
                  }
            ,
			success: function(data){
                           
             $("#tab1").html(data);
             $vv = $("#fill_up1").text();
             //$("#see").text($vv);
             $("#fillu").html($vv);
             $("#fr").html(d_from);
             $("#to").html(d_to);
            }
		});
       
        }

        function secondtable(){
            var d_from = document.getElementById("d_from").value;
            var d_to = document.getElementById("d_to").value;
            $.ajax({
			url: "rep2.php",
			method: "POST",
			data: {d_from: d_from,
                    d_to: d_to,
                action: "populate_second"
            
                  }
            ,
			success: function(data){
                           
             $("#tab2").html(data);
             $("#fr1").html(d_from);
             $("#to1").html(d_to);
             

            }
		});
        }


        function thirdtable(){
            var d_from = document.getElementById("d_from").value;
            var d_to = document.getElementById("d_to").value;
            $.ajax({
			url: "rep3.php",
			method: "POST",
			data: {d_from: d_from,
                    d_to: d_to
                
            
                  }
            ,
			success: function(data){
                           
             $("#tab3").html(data);
             $vv = $("#fill_up").text();
             $uu = $("#fillt").text();
             $("#fillu_1").html($vv);
             $("#span").text($uu);
            }
		});
        }
        

        function popup(){
            document.getElementById("fillu").innerHTML = document.getElementByID("fill_up").innerText;
        }

        function change(para){
            let c = para.split('-').reverse().join('-');
            return c;
        }
    </script>
     <script src="jquery/jquery3.7.js"></script>
     <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
     <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.js"></script>
     <script src="./bootstrap-5.3.2-dist/js/dtjs/dataTables.bootstrap5.js"></script>
</body>
</html>