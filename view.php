<?php
 session_start();
 include("php/config.php");
 include("php/functions.php");
 $user_data = check_login($config);

 ?>
 <?php
        if (isset($_POST['pop_out3']))
        {
            
            $bookId = $_POST['see'];
            $query = "select books.book_id, books.title, books.author, books.p_name,books.p_of_pub,books.y_of_pub,books.isbn_ssn,books.access_no,legald.l_dep_no,legald.copies_deposit,SUM(depo_history.deposited)as tots,legald.s_o_dep,legald.d_o_dep,legald.contact_address,legald.remark from books inner join legald on books.book_id = legald.book_id inner join depo_history on legald.l_dep_no = depo_history.l_dep_no  where books.book_id = '$bookId'";
    
            $result = mysqli_query($config, $query); 

                        $row2= mysqli_fetch_assoc($result);

                        echo '

                     
                           <div class="row">
                <p>BOOK TITLE : '. $row2['title'] .'</p>
            </div>
            <div class="row">
                <p>AUTHOR/EDITORS NAME :'.$row2['author'].' </p>
            </div>
            <div class="row">
                <p>PUBLISHERS NAME : '.$row2['p_name'].'</p>
            </div>
            <div class="row">
                <p>PLACE OF PUBLICATION :   '.$row2['p_of_pub'].'</p>
            </div>
            <div class="row">
                <p>YEAR OF PUBLICATION :  '. $row2['y_of_pub'].'</p>
            </div>
            <div class="row">
                <p>ISBN/ISSN :'. $row2['isbn_ssn'].'</p>
            </div>
            <div class="row">
                <p>ACCESSION NUMBER : '. $row2['access_no'].'</p>
            </div>
            <div class="row">
                <p>LEGAL DEPOSIT NUMBER :  '.$row2['l_dep_no'].'</p>
            </div>
            <div class="row">
                <p>DATE OF DEPOSIT : '.$row2['d_o_dep'].'</p>
            </div>
            <div class="row">
                <p>TYPE OF DEPOSIT :  '.$row2['copies_deposit'].'</p>
            </div>
            <div class="row">
                <p>NUMBER DEPOSITED :  '.$row2['tots'].'</p>
            </div>
            <div class="row">
                <p>STATE OF DEPOSIT : '.$row2['s_o_dep'].'</p>
            </div>
            <div class="row">
                <p>CONTACT ADDRESS : '.$row2['contact_address'].'</p>
            </div>
            <div class="row">
                <p>REAMARKS : '.$row2['remark'].'</p>
            </div>
            <div id ="receipt">
            <p>Dear Sir/Ma,</p>
            <p><h4>ACKNOWLEDGEMENT</h4></p>
            <p>We Wishto acknowledge with thanks, the copy(ies) of the following title received as Legal Deposit in Compliance with the National Library Act Number 29 of 1970 obligation.</p>
            <p>If you titles fall short of the required number of copies. It will be highly appreciated if the remaining copies if any are deposited within two weeks from the date above.</p>
            <table>
              <thead>
              <tr>
              <th class="tab_head" scope="col">#</th>
              <th class="tab_head" scope="col">Publications</th>
              <th class="tab_head" scope="col">Required Number of Deposit</th>
              <th class="tab_head" scope="col">Number of Copies Deposited</th>
              <th class="tab_head" scope="col">Outstanding Copies</th>
              </tr>
            </thead>
            <tbody>
            <tr>
            <td class="tab_data">1 </td>
            <td class="tab_data">'.$row2['title'].'</td>
            <td class="tab_data">'.$row2['copies_deposit'].'</td>
            <td class="tab_data">'.$row2['tots'].'</td>
            <td class="tab_data">'.$row2['copies_deposit'] - $row2['tots'].'</td>
            </tr>
            </tbody>
            </table>
            </div>
            
            <div id="buttons">
            <a class=><button id="print" onclick="print()">Print Receipt</button></a>
            <a class="btt" href= "edit.php?id='.$bookId.' & crazy"  ><button id="edit">Edit</button></a>
        
            
            </div>

        </div>
                        
                        
                        
                        
                        ';

        }
    
        else{
            echo '<h4>Not Found</h4>';
            die();
        }
    
 ?>