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
      .table,
      .th,
      .td {
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
                   <h5 class="dropdown-header">Sign out</h5>
                   <a class="dropdown-item material-icons md-36" href="logout.php">logout</a>
                 </div>
               </div>
         </form>
         </center>
     </div>
     </nav> <br><br><br><br>

     <div class="container">
         <center>
            <h1>Payment</h1>
             
                 <table class="table">
                    <tr>
                        <th class="th"> Name: </th>
                        <td class="td"> <?php  echo $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] ; ?></td>
                     </tr>

                     <tr>
                        <th class="th"> Reservation Date: </th>
                        <td class="td">
                            <?php  

                                $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                                while($rows = mysqli_fetch_assoc($select)){
                                    echo $rows['reservation_date'];
                                }

                             ?>
                        </td>
                     </tr>
                     <tr>
                        <th class="th"> Reservation Type: </th>
                        <td class="td">
                            <?php  

                                $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                                while($rows = mysqli_fetch_assoc($select)){
                                    if ($rows['reservation_type'] == "day") {
                                        $res_type = "Day Swimming";
                                        $res_type_price = 130;
                                        echo $res_type;
                                    } elseif ($rows['reservation_type'] == "night") {
                                        $res_type = "Night Swimming";
                                        $res_type_price = 140;
                                        echo $res_type;
                                    }
                                    else{
                                        $res_type = "Whole Day Swimming";
                                        $res_type_price = 250;
                                        echo $res_type;
                                    }
                                }

                             ?>
                        </td>
                        <td class="td">
                            <?php  echo "Php. " . $res_type_price . " Per person";  ?>
                        </td>
                     </tr>
                     <tr>
                        <th class="th"> Rooms/Cottage: </th>
                        <td class="td">
                            <?php  

                                $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                                while($rows = mysqli_fetch_assoc($select)){
                                    if ($rows['reservation_roomcottage'] == "smallcottage") {
                                        $room_type = "Small Cottage";
                                        $room_price = 300;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "mediumcottage") {
                                        $room_type = "Medium Cottage";
                                        $room_price = 400;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "largecottage") {
                                        $room_type = "Large Cottage";
                                        $room_price = 600;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "acroom1") {
                                        $room_type = "Air Conditioned Room 6 hours";
                                        $room_price = 750;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "acroom2") {
                                        $room_type = "Air Conditioned Room 12 hours";
                                        $room_price = 1500;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "acroom3") {
                                        $room_type = "Air Conditioned Room 24 hours";
                                        $room_price = 3000;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "drivein1") {
                                        $room_type = "Drive-in room 3 hours";
                                        $room_price = 350;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "drivein2") {
                                        $room_type = "Drive-in room 12 hours";
                                        $room_price = 1500;
                                        echo $room_type;
                                    } elseif ($rows['reservation_roomcottage'] == "drivein3") {
                                        $room_type = "Drive-in room 24 hours";
                                        $room_price = 2600;
                                        echo $room_type;
                                    } else{
                                        $room_type = "None";
                                        $room_price = 0;
                                        echo $room_type;
                                    }
                                }

                             ?>
                        </td>
                        <td class="td">
                            <?php  echo "Php. " . $room_price; ?>
                        </td>
                     </tr>

                     <tr>
                        <th class="th"> People: </th>
                        <td class="td">
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
                        <th class="th"> Adults: </th>
                        <td class="td">
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
                        <td class="td">
                            <?php  echo "Php. " . $adult_price; ?>
                        </td>
                     </tr>

                     <tr>
                        <th class="th"> Kids: </th>
                        <td class="td">
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
                        <td class="td">
                            <?php  echo "Php. " . $kid_price; ?>
                        </td>
                     </tr>

                     <tr>
                        <th class="th"> Senior Citizens: </th>
                        <td class="td">
                            <?php  
                                $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                                while($rows = mysqli_fetch_assoc($select)){
                                    if ($rows['reservation_kid'] == "1") {
                                        $res_sc = 1;
                                       
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;
                                    } elseif ($rows['reservation_kid'] == "2") {
                                        $res_sc = 2;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                  
                                    } elseif ($rows['reservation_kid'] == "3") {
                                        $res_kid = 3;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_kid'] == "4") {
                                        $res_kid = 4;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_kid'] == "5") {
                                        $res_kid = 5;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_kid'] == "6") {
                                        $res_kid = 6;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_kid'] == "7") {
                                        $res_kid = 7;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_kid'] == "8") {
                                        $res_adult = 8;
                                       
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_kid'] == "9") {
                                        $res_kid = 9;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } elseif ($rows['reservation_kid'] == "10") {
                                        $res_kid = 10;
                                        
                                        $sc_disc = $res_type_price * ($res_sc * 0.2);
                                        $sc_price = $adult_price - $sc_disc;
                                        echo $res_sc;                                   
                                    } else{
                                        $res_kid = "0";
                                        $sc_price = "0";
                                        echo $res_kid;
                                    }
                                }
                             ?>
                        </td>
                        <td class="td">
                            <?php  echo "Php. " . $sc_price; ?>
                        </td>
                     </tr>

                   




                     <tr>
                         <td class="td"></td>
                          <th class="th"> Total: 
                          
                              <?php  
                                  $total = $sc_price + $kid_price + $adult_price + $room_price;
                               ?>
                         </th>
                         <td class="td">
                            <?php  echo "Php. " . $total; ?>
                        </td>
                     </tr>

                 </table>
             
         </center>
     </div>

     <div class="container pt-3">
         <center>
            <form method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <label><h1> GCASH Payment</h1> </label> 
                    </tr>
                    
                                
                    <tr>
                        <td>
                            <label> 
                                <?php   
                                    echo "Screenshot of payment";
                                 ?>
                            </label>
                        </td>
                        <td>
                            <input type="file" name="payment_photo" id="payment_photo" required="">
                        </td>
                    </tr> 

                    <tr>
                        <td>
                           <label>
                               Payment Amount
                           </label> 
                        </td>
                        <td>
                            <input type="number" name="pymnt_amount" readonly="" placeholder="
                            <?php 
                                echo "PHP " . $total;
                             ?>
                            ">
                        </td>
                    </tr>

                    <tr>
                       <?php
                       $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
                       while($rows = mysqli_fetch_assoc($select)){
                           
                       
                       echo "<td><a href = 'payment.php?del=$rows[reservation_id]'><button type='button' class='btn w3-button  w3-red w3-margin-bottom'>Cancel Reservation</button></a></td>";
                       echo "<td><input type='submit' name='submit' value='Pay Reservation' class='w3-button w3-block btn-primary w3-margin-bottom'></td>";
                       echo "<td><a href = 'payment.php?id=$rows[reservation_id]'><button type='button' class='w3-button w3-block w3-black w3-margin-bottom'>Edit Reservation</button></a></td>";
                       
                       }

                         ?>
                    </tr>        
                             
                </table>
            </form>
            
            <?php 
        if (isset($_GET['id'])) {
            $editid = $_GET['id'];
            $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE reservation_id = '$editid'");
            while ($row = mysqli_fetch_assoc($select)) {
        ?><br>
                <h1 class="w3-animate-bottom" style="font-weight: bolder;">Edit Reservation Details</h1>
                     <form method="POST" enctype="multipart/form-data">
                    <div>
                        <table class="w3-animate-bottom">
                            <tr>
                                <td><label>Date of Reservation</label></td>
                                <td><input type="date" name="reservation_date" value="" min="2021-05-11" max="2022-5-11" required=""></td>
                            </tr>

                            <tr>
                                <td><label>Entrance Type</label></td>
                                <td>
                                    <select name="reservation_type">
                                        <option></option>
                                        <option value="day">Day Swimming</option> 
                                        <option value="night">Night Swimming</option>
                                        <option value="whole">Whole Day</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><h6 class="disclaimer">*Day 8:00AM-3:00PM, Night 3:00PM-10:00PM*</h6></td>
                            </tr>

                            <tr>
                                <td><label>Select Room/Cottage Type</label></td>
                                <td>
                                    <select name="reservation_roomcottage">
                                        <option value="none">None</option>
                                        <option value="smallcottage">Small Cottage</option>
                                        <option value="mediumcottage">Medium Cottage</option>
                                        <option value="largecottage">Large Cottage</option>
                                        <option value="acroom1">Air Conditioned Room (6 Hours)</option>
                                        <option value="acroom2">Air Conditioned Room (12 Hours)</option>
                                        <option value="acroom3">Air Conditioned Room (24 Hours)</option>
                                        <option value="drivein1">Drive-in (3 Hours)</option>
                                        <option value="drivein2">Drive-in (12 Hours)</option>
                                        <option value="drivein3">Drive-in (24 Hours)</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label>Number of people</label></td>
                                <td>
                                    <select name="reservation_people">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><h6 class="disclaimer">*Capacity limited due to COVID-19 protocols*</h6></td>
                            </tr>

                            <tr>
                                <td><label>Number of Adults</label></td>
                                <td>
                                    <select name="reservation_adult">
                                        <option value="0"></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Number of Kids</label></td>
                                <td>
                                    <select name="reservation_kid">
                                        <option value="0"></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Number of Senior Citizen</label></td>
                                <td>
                                    <select name="reservation_seniorcitizen">
                                        <option value="0"></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="payment.php">
                                        <button type="button" class="btn w3-button  w3-red w3-margin-bottom">Cancel</button>
                                    </a>
                                </td>
                                <td>
                                    <input type="submit" name="save" value="Update" class="w3-button w3-block w3-black w3-margin-bottom">
                                </td>
                            </tr>
                        </table>
                    </div>
                    </form>
                    <?php 
                               }
                           }
                    ?>
                    <?php 
                        if (isset($_GET['del'])) {
                            $id = $_GET['del'];

                            $user_reservation = 0;
                            $reservation_insert = mysqli_query($con, "UPDATE tbl_users SET user_reservation = ('$user_reservation') WHERE user_id = '$_SESSION[user_id]'");

                            $reservation_id = 0;
                            $reservationid_insert = mysqli_query($con, "UPDATE tbl_users SET reservation_id = ('$reservation_id') WHERE user_id = '$_SESSION[user_id]'");

                            $payment_id = 0;
                            $payment_insert = mysqli_query($con, "UPDATE tbl_users SET payment_id = ('$payment_id') WHERE user_id = '$_SESSION[user_id]'");

                            $delete = mysqli_query($con, "DELETE FROM tbl_reservations WHERE reservation_id = '$id'");
                            $delete = mysqli_query($con, "DELETE FROM tbl_payment WHERE reservation_id = '$id'");
                            echo "<script>alert('Reservation Cancelled!');window.location.href='payment.php'</script>";
                        }

                     ?>
                    <?php  
                        if (isset($_POST['save'])) {
                            $reservation_date = $_POST['reservation_date'];
                            $reservation_type = $_POST['reservation_type'];
                            $reservation_roomcottage = $_POST['reservation_roomcottage'];
                            $reservation_people = $_POST['reservation_people'];
                            $reservation_adult = $_POST['reservation_adult'];
                            $reservation_kid = $_POST['reservation_kid'];
                            $reservation_seniorcitizen = $_POST['reservation_seniorcitizen']; 
                            
                            if ($reservation_type == "day" || $reservation_type == "night" || $reservation_type == "whole") {
                                $daynight_validation = "valid";
                            }
                            else{
                                $daynight_validation = "invalid";
                            }

                            if ($reservation_roomcottage == "none" || $reservation_roomcottage == "smallcottage" || $reservation_roomcottage == "mediumcottage" || $reservation_roomcottage == "largecottage" || $reservation_roomcottage == "acroom1" || $reservation_roomcottage == "acroom2" || $reservation_roomcottage == "acroom3" || $reservation_roomcottage == "drivein1" || $reservation_roomcottage == "drivein2" || $reservation_roomcottage == "drivein3") {
                                $roomcottage_validation = "valid";
                            }
                            else{
                                $roomcottage_validation = "invalid";
                            }

                            if ($reservation_people == "1" || $reservation_people == "2" || $reservation_people == "3" || $reservation_people == "4" || $reservation_people == "5" || $reservation_people == "6" || $reservation_people == "7" || $reservation_people == "8" || $reservation_people == "9" || $reservation_people == "10") {
                                $people_validation = "valid";
                            }
                            else{
                                $people_validation = "invalid";
                            }

                            if ($reservation_adult == "0" || $reservation_adult == "1" || $reservation_adult == "2" || $reservation_adult == "3" || $reservation_adult == "4" || $reservation_adult == "5" || $reservation_adult == "6" || $reservation_adult == "7" || $reservation_adult == "8" || $reservation_adult == "9" || $reservation_adult == "10") {
                                $adults_validation = "valid";
                            }
                            else{
                                $adults_validation = "invalid";
                            }

                            if ($reservation_kid == "0" || $reservation_kid == "1" || $reservation_kid == "2" || $reservation_kid == "3" || $reservation_kid == "4" || $reservation_kid == "5" || $reservation_kid == "6" || $reservation_kid == "7" || $reservation_kid == "8" || $reservation_kid == "9" || $reservation_kid == "10") {
                                $kids_validation = "valid";
                            }
                            else{
                                $kids_validation = "invalid";
                            }

                            if ($reservation_seniorcitizen == "0" || $reservation_seniorcitizen == "1" || $reservation_seniorcitizen == "2" || $reservation_seniorcitizen == "3" || $reservation_seniorcitizen == "4" || $reservation_seniorcitizen == "5" || $reservation_seniorcitizen == "6" || $reservation_seniorcitizen == "7" || $reservation_seniorcitizen == "8" || $reservation_seniorcitizen == "9" || $reservation_seniorcitizen == "10") {
                                $seniorcitizen_validation = "valid";
                            }
                            else{
                                $seniorcitizen_validation = "invalid";
                            }

                            $validation_amount = $reservation_adult + $reservation_kid + $reservation_seniorcitizen;
                            if ($reservation_people == $validation_amount) {
                                $amount_validation = "valid";
                            }
                            else{
                                $amount_validation = "invalid";
                            }

                            $dayprice = 130;
                            $nightprice = 140;
                            $wholedayprice = 250;
                            $daypricechild = 120;
                            $nightpricechild = 130;
                            $seniorcitizendayprice = .20 * $dayprice;
                            $seniorcitizennightprice = .20 * $nightprice;
                            $seniorcitizenwholedayprice = .20 * $wholedayprice;
                            /* */

                            if ($reservation_type == "day") {
                                $pricedaynight = 130;
                                //echo "Day Swimming Php 130" . "<br>";
                            }
                            elseif ($reservation_type == "day") {
                                $pricedaynight = 140;
                                //echo "Night Swimming Php 140" . "<br>";
                            }
                            elseif ($reservation_type == "whole") {
                               $pricedaynight = 250;
                               //echo "Whole day swimming Php 250" . "<br>";
                            }

                            if ($reservation_roomcottage == "smallcottage") {
                                $priceroomcottage = 300;
                                //echo "Small Cottage Php 300" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "mediumcottage") {
                                $priceroomcottage = 400;
                                //echo "Medium Cotage Php 400" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "largecottage") {
                                $priceroomcottage = 600;
                                //echo "Large Cottage Php 600" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "acroom1") {
                                $priceroomcottage = 750;
                                //echo "Air Conditioned room 6hours Php 750" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "acroom2") {
                                $priceroomcottage = 1500;
                                //echo "Air Conditioned room 12hours Php 1500" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "acroom3") {
                                $priceroomcottage = 3000;
                                //echo "Air Conditioned room 24hours Php 3000" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "drivein1") {
                                $priceroomcottage = 350;
                                //echo "Drive-in 3hours Php 350" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "drivein2") {
                                $priceroomcottage = 1500;
                                //echo "Drive-in 12hours Php 1500" . "<br>";
                            }
                            elseif ($reservation_roomcottage == "drivein3") {
                                $priceroomcottage = 2600;
                                //echo "Drive-in 24hours Php 2600" . "<br>";
                            }
                            else{
                                $priceroomcottage = 0;
                                //echo "No room" . "<br>";
                            }

                            if ($reservation_people == "1") {
                                $peoplecount = 1;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "2") {
                                $peoplecount = 2;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "3") {
                                $peoplecount = 3;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "3") {
                                $peoplecount = 3;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "4") {
                                $peoplecount = 4;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "5") {
                                $peoplecount = 5;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "6") {
                                $peoplecount = 6;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "7") {
                                $peoplecount = 7;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "8") {
                                $peoplecount = 8;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            elseif ($reservation_people == "9") {
                                $peoplecount = 9;
                                //echo "Amount of people: " . $peoplecount . "<br>";
                            }
                            else {
                                $peoplecount = 10;
                                //echo "Amount of people: " . $peoplecount  . "<br>";
                            }

                            if ($reservation_adult == "1") {
                                $adultscount = 1;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "2") {
                                $adultscount = 2;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "3") {
                                $adultscount = 3;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "4") {
                                $adultscount = 4;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "5") {
                                $adultscount = 5;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "6") {
                                $adultscount = 6;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "7") {
                                $adultscount = 7;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "8") {
                                $adultscount = 8;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            elseif ($reservation_adult == "9") {
                                $adultscount = 9;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }
                            else{
                                $adultscount = 10;
                                //echo "Amount of adults: " . $adultscount  . "<br>";
                            }

                            if ($reservation_kid == "1") {
                                $kidscount = 1;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "2") {
                                $kidscount = 2;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "3") {
                                $kidscount = 3;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "4") {
                                $kidscount = 4;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "5") {
                                $kidscount = 5;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "6") {
                                $kidscount = 6;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "7") {
                                $kidscount = 7;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "8") {
                                $kidscount = 8;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "9") {
                                $kidscount = 9;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            elseif ($reservation_kid == "10") {
                                $kidscount = 10;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }
                            else{
                                $kidscount = 0;
                                //echo "Amount of kids: " . $kidscount  . "<br>";
                            }

                            if ($reservation_seniorcitizen == "1") {
                                $seniorcitizencount = 1;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "2") {
                                $seniorcitizencount = 2;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "3") {
                                $seniorcitizencount = 3;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "4") {
                                $seniorcitizencount = 4;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "5") {
                                $seniorcitizencount = 5;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "6") {
                                $seniorcitizencount = 6;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "7") {
                                $seniorcitizencount = 7;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "8") {
                                $seniorcitizencount = 8;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "9") {
                                $seniorcitizencount = 9;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            elseif ($reservation_seniorcitizen == "10") {
                                $seniorcitizencount = 10;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }
                            else{
                                $seniorcitizencount = 0;
                                //echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
                            }

                            if ($reservation_type == "day") {
                                $adultscount = $adultscount * 130;
                                $kidscount = $kidscount * 120;
                                $seniorcitizencount = $seniorcitizencount * 104;
                                $roomtype = $priceroomcottage;

                                $totalPrice = $adultscount + $kidscount + $seniorcitizencount + $roomtype;
                                echo "<p style = 'text-align: center;'>Total price: Php " . $totalPrice . "</p>";
                            }
                            else{
                                $adultscount = $adultscount * 140;
                                $kidscount = $kidscount * 130;
                                $seniorcitizencount = $seniorcitizencount * 102;
                                $roomtype = $priceroomcottage;

                                $totalPrice = $adultscount + $kidscount + $seniorcitizencount + $roomtype;
                                echo "<p style = 'text-align: center;'>Total price: Php " . $totalPrice . "</p>";
                            }
                            

                            if ($daynight_validation == "valid" && $roomcottage_validation == "valid" && $people_validation == "valid" && $adults_validation == "valid" && $kids_validation == "valid" && $seniorcitizen_validation == "valid" && $amount_validation =="valid"){

                                $update = mysqli_query($con, "UPDATE tbl_reservations SET reservation_type='$reservation_type', reservation_roomcottage='$reservation_roomcottage', reservation_people='$reservation_people', reservation_adult='$reservation_adult', reservation_kid='$reservation_kid', reservation_seniorcitizen='$reservation_seniorcitizen', reservation_date='$reservation_date' WHERE user_id = '$_SESSION[user_id]'");
                                if (!$update) {
                                    echo "<script>alert('Unable to edit reservation!')</script>";
                                }
                                else
                                    $user_payment = 0;
                                    $userR_payment = mysqli_query($con, "UPDATE tbl_users SET payment_id = ('$user_payment') WHERE user_id = '$_SESSION[user_id]'");

                                    $reser_payment = 0;
                                    $reser_payment = mysqli_query($con, "UPDATE tbl_reservations SET payment_id = ('$reser_payment') WHERE user_id = '$_SESSION[user_id]'");


                                    echo "<script>alert('Successfully changed reservation!');window.location.href='payment.php?=$id'</script>";

                            }
                        }

                     ?>

         </center>
     </div>










     <!-- Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  
 </body>
 </html>
 
<?php   
    if (isset($_POST['submit'])) {
        $payment_photo = addslashes(file_get_contents($_FILES['payment_photo']['tmp_name']));
        $payment_amount = $total;
        $payment_method = "gcash";

        $select = mysqli_query($con, "SELECT * FROM tbl_reservations WHERE user_id = '$_SESSION[user_id]'");
        while($rows = mysqli_fetch_assoc($select)){
            $reservation_id = $rows['reservation_id'];
        

        $insert_into_db = mysqli_query($con, "INSERT INTO tbl_payment (payment_photo, payment_amount, payment_method, payment_date, payment_time, user_id, reservation_id) VALUES ('$payment_photo', '$payment_amount', '$payment_method', CURDATE(), CURTIME(), '$_SESSION[user_id]', $reservation_id)");
        }
        if (!$insert_into_db) {
                die("unable to save!");
            }
        else{
            $select = mysqli_query($con, "SELECT * FROM tbl_payment WHERE user_id = '$_SESSION[user_id]'");
            while($rows = mysqli_fetch_assoc($select)){
                $payment_id = $rows['payment_id'];
                $payment_insert = mysqli_query($con, "UPDATE tbl_reservations SET payment_id = ('$payment_id') WHERE user_id = '$_SESSION[user_id]'");

                $payment_insertuser = mysqli_query($con, "UPDATE tbl_users SET payment_id = ('$payment_id') WHERE user_id = '$_SESSION[user_id]'");

                $payment_approval = 1;
                $payment_approval_insert = mysqli_query($con, "UPDATE tbl_payment SET payment_approval = ('$payment_approval') WHERE user_id = '$_SESSION[user_id]'");

                $user_check = 1;
                $user_check_insert = mysqli_query($con, "UPDATE tbl_users SET user_check = ('$user_check') WHERE user_id = '$_SESSION[user_id]'");

            }


            }
            echo "<script>alert('Please wait for admin approval!');window.location.href='reservationstatus.php'</script>";
        }


 ?>