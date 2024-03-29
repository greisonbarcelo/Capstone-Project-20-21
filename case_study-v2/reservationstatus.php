<?php 
    include 'database.php';
    
    session_start();
    $select = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id = '$_SESSION[user_id]' AND user_password = '$_SESSION[user_password]'");
    $count = mysqli_num_rows($select);

    if ($count == 0) {
        header("location:login.php");
        
    } else{
        $select2 = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id= '$_SESSION[user_id]' AND user_reservation='1'");
        $count2 = mysqli_num_rows($select2);
        if ($count2 == 0) {
            header("location:reserve.php");
            
        }
    }
 ?>
 <html lang="en">
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" href="styles.css">
     <link rel="stylesheet" type="text/css" href="w3.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
     <script src="https://www.google.com/recaptcha/api.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

     <title>Almon Waterpark</title>
     <style>
         .material-icons.md-48 { font-size: 48px; }
         table,
         th,
         td {
           padding: 10px;
           border: 1px solid black;
           border-collapse: collapse;
         }
         
     </style>
 </head>
 <body>

     <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
     <div class="container">
         <a href="userhome.php" class="navbar-brand mb-0 h1"><img class="d-inline-block align-top" src="pics/logo1.png" width="230" height="35"></a>
         <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
             <span class="navbar-toggler-icon"></span>   
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav">
                 <li class="nav-item active">
                     <a class="nav-link active" href="userhome.php#home">Home</a>
                 </li>
                 <li class="nav-item active">
                     <a class="nav-link" href="reserve.php">Reserve</a>
                 </li>
                 <li class="nav-item active">
                     <a class="nav-link" href="userhome.php#pricing">Pricing</a>
                 </li>
                 <li class="nav-item active">
                     <a class="nav-link" href="userhome.php#amenities">Amenities</a>
                 </li>
                 <li class="nav-item active">
                     <a class="nav-link" href="userhome.php#about">About</a>
                 </li>
             </ul>
         </div>
         <center>
         <form class="d-flex">
            
             <span class="material-icons md-36">account_circle</span>
               <div class="dropdown">
                 <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                   <?php 
                        echo $_SESSION['user_fname'] . " " . $_SESSION['user_lname']; 
                     ?>
                 </button>
                 <div class="dropdown-menu">
                   <a class="dropdown-item" href="myaccount.php">View Account</a>
                   <a class="dropdown-item" href="reservationstatus.php">Reservation Status</a>
                   <a class="dropdown-item" href="reserve.php">Make a Reservation</a>
                   <a class="dropdown-item" href="check.php">
                       <?php    
                            $select = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                if ($rows['user_reservation'] == "1") {
                                    if ($rows['reservation_id'] != "0") {
                                        if ($rows['payment_id'] != "0") {
                                            $user_check = $rows['user_check'];
                                            if ($user_check == "1") {
                                                echo "Check-in";
                                            } elseif ($user_check == "2") {
                                                $user_check = "2";
                                                echo "Check-out";
                                            } elseif ($user_check == "0") {
                                                $user_check = "0";
                                            }
                                        }
                                    }
                                } 
                            }
                                
                            

                        ?>
                   </a>
                   <h5 class="dropdown-header">Sign out</h5>
                   <a class="dropdown-item material-icons md-36" href="logout.php">logout</a>
                 </div>
               </div>
         </form>
         </center>
     </div>
     </nav> <br><br><br><br>

     <div class="container w3-animate-bottom">
        <center>
            <span class="material-icons md-48">description</span><br>
            <span><h1>Reservation Details</h1></span> <br>

            <table>
                <tr>
                    <th>Username:</th>
                    <td>
                        <?php   
                            echo $_SESSION['user_id'];
                         ?>
                    </td>
                </tr>
                <tr>
                    <th>Full Name:</th>
                    <td>
                        <?php   
                            echo $_SESSION['user_fname'] . " " . $_SESSION['user_lname'];
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Reservation:</th>
                    <td>
                        <?php   
                            $select = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $user_reservation = $rows['user_reservation'];

                                if ($user_reservation == 0) {
                                 echo "No Reservation";
                             } elseif ($user_reservation == 1) {
                                 echo "<p style='color: #f57905;'>Pending Reservation</p>";
                             } elseif ($user_reservation == 2) {
                                 echo "<p style='color: #4ad400;'>Reservation Active</p>";
                             } elseif ($user_reservation == 3) {
                                 echo "<p style='color: red;'>Reservation Declined</p>";
                             }
                            }  
                            
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Reservation ID:</th>
                    <td>
                        <?php 
                            $select = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $reservation_id = $rows['reservation_id'];
                                if ($reservation_id == 0) {
                                    echo "N/A";
                                } else{
                                    echo "#". $reservation_id;
                                } 
                            }  
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Reservation Date:</th>
                    <td>
                        <?php 
                            $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $reservation_date = $rows['reservation_date'];
                                    echo $reservation_date;
                            }  
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Reservation Type:</th>
                    <td>
                        <?php 
                            $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $reservation_type = $rows['reservation_type'];
                                if ($reservation_type == "day") {
                                    $res_type_price = 130;
                                    echo "Day Swimming";
                                } elseif ($reservation_type == "night") {
                                    $res_type_price = 140;
                                    echo "Night Swimming";
                                } else{
                                    $res_type_price = 250;
                                    echo "Whole Day Swimming";     
                                } 
                            }

                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Room/Cottage:</th>
                    <td>
                        <?php 
                            $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $reservation_roomcottage = $rows['reservation_roomcottage'];
                                if ($reservation_roomcottage == "smallcottage") {
                                    $room_price = 300;
                                    echo "Small Cottage";
                                } elseif ($reservation_roomcottage == "mediumcottage") {
                                    $room_price = 400;
                                    echo "Medium Cottage";
                                } elseif ($reservation_roomcottage == "largecottage") {
                                    $room_price = 600;
                                    echo "Large Cottage";
                                } elseif ($reservation_roomcottage == "acroom1") {
                                    $room_price = 750;
                                    echo "Air Conditioned Room 6hrs";
                                } elseif ($reservation_roomcottage == "acroom2") {
                                    $room_price = 1500;
                                    echo "Air Conditioned Room 12hrs";
                                } elseif ($reservation_roomcottage == "acroom3") {
                                    $room_price = 3000;
                                    echo "Air Conditioned Room 24hrs";
                                } elseif ($reservation_roomcottage == "drivein1") {
                                    $room_price = 350;
                                    echo "Drive-in 3hrs";
                                } elseif ($reservation_roomcottage == "drivein2") {
                                    $room_price = 1500;
                                    echo "Drive-in 12hrs";
                                } elseif ($reservation_roomcottage == "drivein3") {
                                    $room_price = 2600;
                                    echo "Drive-in 24hrs";
                                } else{
                                    $room_price = 0;
                                    echo "None";
                                }
                            }

                         ?>
                    </td>
                </tr>

                <tr>
                   <th> People: </th>
                   <td>
                       <?php  
                           $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                           while($rows = mysqli_fetch_assoc($select)){
                               if ($rows['reservation_people'] == "1") {
                                   $res_people = 1;
                                   echo $res_people;
                               } elseif ($rows['reservation_people'] == "2") {
                                   $res_people = 2;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "3") {
                                   $res_people = 3;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "4") {
                                   $res_people = 4;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "5") {
                                   $res_people = 5;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "6") {
                                   $res_people = 6;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "7") {
                                   $res_people = 7;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "8") {
                                   $res_people = 8;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "9") {
                                   $res_people = 9;
                                   echo $res_people;                                   
                               } elseif ($rows['reservation_people'] == "10") {
                                   $res_people = 10;
                                   echo $res_people;                                   
                               } 
                           }

                        ?>
                   </td>
                </tr>

                 <tr>
                        <th> Adults: </th>
                        <td>
                            <?php  
                                $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                                while($rows = mysqli_fetch_assoc($select)){
                                    if ($rows['reservation_adult'] == "1") {
                                        $res_adult = 1;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;
                                    } elseif ($rows['reservation_adult'] == "2") {
                                        $res_adult = 2;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "3") {
                                        $res_adult = 3;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "4") {
                                        $res_adult = 4;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "5") {
                                        $res_adult = 5;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "6") {
                                        $res_adult = 6;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "7") {
                                        $res_adult = 7;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "8") {
                                        $res_adult = 8;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "9") {
                                        $res_adult = 9;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } elseif ($rows['reservation_adult'] == "10") {
                                        $res_adult = 10;
                                        $adult_price = $res_type_price * $res_adult;
                                        echo $res_adult;                                   
                                    } 
                                }

                             ?>
                        </td>
                </tr>

                <tr>
                        <th> Kids: </th>
                        <td>
                            <?php  
                                $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                                while($rows = mysqli_fetch_assoc($select)){
                                    if ($rows['reservation_kid'] == "1") {
                                        $res_kid = 1;
                                       
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_adult;
                                    } elseif ($rows['reservation_kid'] == "2") {
                                        $res_kid = 2;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "3") {
                                        $res_kid = 3;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "4") {
                                        $res_kid = 4;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "5") {
                                        $res_kid = 5;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "6") {
                                        $res_kid = 6;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "7") {
                                        $res_kid = 7;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "8") {
                                        $res_adult = 8;
                                       
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "9") {
                                        $res_kid = 9;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } elseif ($rows['reservation_kid'] == "10") {
                                        $res_kid = 10;
                                        
                                        $kid_price = $res_type_price * $res_kid - 10;
                                        echo $res_kid;                                   
                                    } else{
                                        $res_kid = "0";
                                        $kid_price = "0";
                                        echo $res_kid;
                                    }
                                }
                             ?>
                        </td>
                </tr>

                <tr>
                        <th> Senior Citizens: </th>
                        <td>
                            <?php  
                                $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                                while($rows = mysqli_fetch_assoc($select)){
                                    if ($rows['reservation_seniorcitizen'] == "1") {
                                        $res_sc = 1;
                                       
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;
                                    } elseif ($rows['reservation_seniorcitizen'] == "2") {
                                        $res_sc = 2;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                  
                                    } elseif ($rows['reservation_seniorcitizen'] == "3") {
                                        $res_kid = 3;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_seniorcitizen'] == "4") {
                                        $res_kid = 4;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_seniorcitizen'] == "5") {
                                        $res_kid = 5;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_seniorcitizen'] == "6") {
                                        $res_kid = 6;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_seniorcitizen'] == "7") {
                                        $res_kid = 7;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_seniorcitizen'] == "8") {
                                        $res_adult = 8;
                                       
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_seniorcitizen'] == "9") {
                                        $res_kid = 9;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_seniorcitizen'] == "10") {
                                        $res_kid = 10;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } else{
                                        $res_sc = "0";
                                        $sc_price = "0";
                                        echo $res_kid;
                                    }
                                }
                             ?>
                        </td>
                </tr>

                <tr>
                     <th> Total: 
                     
                         <?php  
                             $total = $sc_price + $kid_price + $adult_price + $room_price;
                          ?>
                    </th>
                    <td>
                       <?php  echo "Php. " . $total; ?>
                   </td>
                </tr>

                <tr>
                    <th>Payment ID:</th>
                    <td>
                        <?php  
                            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $payment_id = $rows['payment_id'];
                                if ($payment_id == 0) {
                                    echo "N/A";
                                } else{
                                    echo "#".$payment_id;
                                } 
                            }   
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Payment Method:</th>
                    <td>
                        <?php  
                            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $payment_method = $rows['payment_method'];
                                if ($payment_method == "gcash") {
                                    echo "via GCASH";
                                } else{
                                    echo "N/A";
                                } 
                            }   
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Payment Amount:</th>
                    <td>
                        <?php  
                            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $payment_amount = $rows['payment_amount'];
                                if ($payment_amount == 0) {
                                    echo "N/A";
                                } else{
                                    echo "Php. ". $payment_amount;
                                } 
                            }   
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Payment Date:</th>
                    <td>
                        <?php  
                            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $payment_date = $rows['payment_date'];
                                if ($payment_date == 0) {
                                    echo "N/A";
                                } else{
                                    echo $payment_date;
                                } 
                            }   
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Payment Time:</th>
                    <td>
                        <?php  
                            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $payment_time = $rows['payment_time'];
                                if ($payment_time == 0) {
                                       echo "N/A";
                                } else{
                                    echo $payment_time;
                                } 
                            }   
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Payment Approval:</th>
                    <td>
                        <?php   
                            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $payment_approval = $rows['payment_approval'];

                                if ($payment_approval == 0) {
                                 echo "No Payment";
                             } elseif ($payment_approval == 1) {
                                 echo "<p style='color: #f57905;'>Pending Payment Approval</p>";
                             } elseif ($payment_approval == 2) {
                                 echo "<p style='color: #4ad400;'>Payment Confirmed</p>";
                             } elseif ($payment_approval == 3) {
                                 echo "<p style='color: red;'>Payment Declined</p>";
                             }
                            }  
                            
                         ?>
                    </td>
                </tr>

                <tr>
                    <th>Payment Photo:</th>
                    <td>
                        <?php  
                            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $payment_photo = $rows['payment_photo'];
                                if ($payment_photo == 0) {
                                    echo "N/A";
                                } else{
                                    echo '<img src="data:payment_photo;base64,'.base64_encode($rows['payment_photo']).'" style="width: 400px; height: 400px;">'; 
                                } 
                            }   
                         ?>
                    </td>
                </tr>

                
            </table>
            <span><a href="#"><button class="btn btn-secondary mt-2">Generate PDF</button></a></span>
            <span><a href="payment.php"><button class="btn btn-primary mt-2">Edit Reservation/Payment</button></a></span>
        </center> 
     </div>
     
    
     




     <!-- Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  
 </body>
 </html>
 
 