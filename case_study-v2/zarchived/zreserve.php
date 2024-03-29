<?php 
    include 'database.php';
    session_start();
    $select = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id = '$_SESSION[user_id]' AND user_password = '$_SESSION[user_password]'");
    $count = mysqli_num_rows($select);
    if ($count == 0) {
        header("location:login.php");
        //echo "<td>" . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . "</td>"; 
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
                        echo "<td>" . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . "</td>"; 
                     ?>
                 </button>
                 <div class="dropdown-menu">
                   <a class="dropdown-item" href="#">View Account</a>
                   <a class="dropdown-item" href="#">Reservation Status</a>
                   <a class="dropdown-item" href="reserve.php">Make a Reservation</a>
                   <h5 class="dropdown-header">Sign out</h5>
                   <a class="dropdown-item material-icons md-36" href="logout.php">logout</a>
                 </div>
               </div>
         </form>
         </center>
     </div>
     </nav> <br><br><br><br>

     <h1 class="w3-animate-bottom" style="font-weight: bolder;">Enter Reservation Details</h1>
     <form method="POST">
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
                    <a href="userhome.php">
                        <button type="button" class="btn w3-button  w3-red w3-margin-bottom">Cancel</button>
                    </a>
                </td>
                <td>
                    <input type="submit" name="submit" value="Proceed to Payment" class="w3-button w3-block w3-black w3-margin-bottom">
                </td>
            </tr>
        </table>
    </div>
    </form>






























     <!-- Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  
 </body>
 </html>

 <?php 

    if (isset($_POST['submit'])) {
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

            //echo "<br>". $daynight . "<br>" . $roomcottage . "<br>" . $people . "<br>" . $adults . "<br>" . $kids . "<br>" . $seniorcitizen . "<br>" . $date;
            //next step here is create new table for reservations to be stored and be displayed in cart :)
            $insert_into_db = mysqli_query($con, "INSERT INTO tbl_reservations (reservation_date, reservation_type, reservation_roomcottage, reservation_people, reservation_adult, reservation_kid, reservation_seniorcitizen, user_id) VALUES ('$reservation_date', '$reservation_type', '$reservation_roomcottage', '$reservation_people', '$reservation_adult', '$reservation_kid', '$reservation_seniorcitizen', '$_SESSION[user_id]')");
            //$insert_into_db = mysqli_query($con, "INSERT INTO users (daynight) VALUES ('$daynight')");

            if (!$insert_into_db) {
                die("unable to save!");
            }
            else{
                echo "<script>alert('Successfully reserved!');window.location.href='userhome.php'</script>";
            }
        }
        else{
            echo "<script>alert('theres something wrong with your input!')</script>";
        
        }
    
    } 
  ?>