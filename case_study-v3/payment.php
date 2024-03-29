<?php 
    include 'database.php';
    session_start();
    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
    $count = mysqli_num_rows($select);
    if ($count == 0) {
        header("location:index.php#myModal");
        //echo "<td>" . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . "</td>"; 
    } else{
        $select2 = mysqli_query($con, "SELECT * FROM tbl_user WHERE email= '$_SESSION[email]' AND reservation='none'");
        $count2 = mysqli_num_rows($select2);
        $select3 = mysqli_query($con, "SELECT * FROM tbl_user WHERE email= '$_SESSION[email]' AND reservation='pending_paid'");
        $count3 = mysqli_num_rows($select3);
        $select4 = mysqli_query($con, "SELECT * FROM tbl_user WHERE email= '$_SESSION[email]' AND reservation='approved'");
        $count4 = mysqli_num_rows($select4);
        if ($count2 == 1 || $count3 == 1 || $count4 == 1) {
            header("location:userhome.php");
        }
    }
 ?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Almon Waterpark</title>
<link rel="shortcut icon" type="image/fav-icon" href="img/cube.png"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://www.google.com/recaptcha/api.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">


    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/icon.min.css">
    <link rel="stylesheet" type="text/css" href="demo/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="demo/css/ui.css"/>
    <link rel="stylesheet" type="text/css" href="dist/css/pignose.calendar.min.css"/>
    <script type="javascript" src="dist/js/pignose.calendar.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    .card {
    width: 340px;
    border-radius: 35px;
    background-color: #fff;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

.total-amount {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
}

.amount-container {
    background-color: #e9eaeb;
    padding: 6px;
    padding-left: 15px;
    padding-right: 15px;
    border-radius: 8px
}

.amount-text {
    font-size: 20px;
    font-weight: 700;
    color: black;
}

.dollar-sign {
    font-size: 20px;
    font-weight: 700;
    color: #000
}

.label-text {
    font-size: 16px;
    font-weight: 600;
    color: #b2b2b2
}

.credit-card-number {
    width: 290px;
    z-index: 28;
    border: 2px solid #ced4da;
    border-radius: 6px;
    font-weight: 600
}

.credit-card-number:focus {
    box-shadow: none;
    border: 2px solid black
}

.visa-icon {
    position: relative;
    top: 42px;
    right: 14px;
    z-index: 30
}

.expiry-class {
    width: 120px;
    border: 2px solid #ced4da;
    font-weight: 600;
    font-size: 12px;
    height: 48px
}

.expiry-class:focus {
    box-shadow: none;
    border: 2px solid black
}

.cvv-class {
    width: 120px;
    border: 2px solid #ced4da;
    font-weight: 600;
    font-size: 12px;
    height: 48px
}

.cvv-class:focus {
    box-shadow: none;
    border: 2px solid black
}

.payment-btn {
    background-color: black;
    padding: 15px;
    padding-left: 25px;
    padding-right: 25px;
    color: #fff;
    font-weight: 600;
    border-radius: 12px
}



.cancel-btn {
    background-color: #fff;
    color: #b2b2b2;
    padding: 0px;
    padding-top: 3px;
    padding-bottom: 3px;
    font-weight: 600;
    border-radius: 6px
}

.cancel-btn:hover {
    border: 2px solid #b2b2b2;
    color: #b2b2b2
}

.cancel-btn:focus {
    box-shadow: none
}

.label-text-cc-number {
    position: relative;
    top: 4px
}
</style>



</head> 
<body>
<nav class="navbar navbar-expand-xl navbar-light bg-light fixed-top">
	<a href="userhome.php" class="navbar-brand"><i class="fa fa-cube"></i>Almon<b>Waterpark</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="userhome.php" class="nav-item nav-link active">Home</a>
			<a href="userhome.php#about" class="nav-item nav-link">About</a>
			<a href="reserve.php" class="nav-link nav-item" >Reserve</a>
			<a href="userhome.php#pricing" class="nav-item nav-link">Pricing</a>
			<a href="userhome.php#contact" class="nav-item nav-link">Contact</a>
		</div>
		
		<div class="navbar-nav ml-auto">
            
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
				<i class="avatar bi bi-person-circle"></i>
					<?php 
                   		 $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email = '$_SESSION[email]'");
                            while($rows = mysqli_fetch_assoc($select)){
                                $fname = $rows['fname'];
                                echo $fname . " ";
                                $lname = $rows['lname'];
                                echo $lname;
                            } 
                   	 ?> 
				<b class="caret"></b></a>
				<div class="dropdown-menu">
					<a href="profile.php" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></a>
					<a href="reserve.php" class="dropdown-item"><i class="fa fa-calendar-o"></i> Reserve</a></a>
					
					<div class="dropdown-divider"></div>
					<a href="logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></a>
				</div>
			</div>
		</div>
	</div>
</nav>
	
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center pt-5 mt-5">
<div class="container" data-aos="zoom-out" data-aos-delay="200">
    <div class="row">
        <div class="well col-lg-6 d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>Almon Waterpark</strong>
                        <br>
                        Fort Magsaysay Rd - Brgy. Soledad
                        <br>
                        Santa Rosa, Nueva Ecija
                        <br>
                        Number: (+63) 916-1159-245
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date:
                            <?php 
                                date_default_timezone_set('Asia/Manila'); 
                                echo date("M d Y H:i a");
                            ?>
                        </em>
                    </p>
                    <p>
                        <em>Reservation ID#:
                            <?php
                                $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                $rows = mysqli_fetch_assoc($select);
                                $reservation = $rows['id'];
                                echo $reservation;
                            ?>
                        </em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>List</th>
                            <th>#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><em>Entrance Type</em></h4></td>
                            <td class="col-md-1" style="text-align: center" > 
                                <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $entrance_type = $rows['entrance_type'];
                                        if ($entrance_type == "whole_day") {
                                            echo "Whole Day";
                                        }
                                        elseif ($entrance_type == "day") {
                                            echo "Day Entry";
                                        }
                                        elseif ($entrance_type == "night"){
                                            echo "Night Entry";
                                        }
                                    } 
                                ?>
                            </td>
                            <td class="col-md-1 text-center">-</td>
                            <td class="col-md-1 text-center">-</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Room Type</em></h4></td>
                            <td class="col-md-1" style="text-align: center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $room_type = $rows['room_type'];
                                        if ($room_type == "none") {
                                            echo "None";
                                        }
                                        elseif ($room_type == "cottage1") {
                                            echo "Small Cottage";
                                        }
                                        elseif ($room_type == "cottage2") {
                                            echo "Medium Cottage";
                                        }
                                        elseif ($room_type == "cottage3") {
                                            echo "Large Cottage";
                                        }
                                        elseif ($room_type == "acroom1") {
                                            echo "Air Conditioned Room 6 hours";
                                        }
                                        elseif ($room_type == "acroom2") {
                                            echo "Air Conditioned Room 12 hours";
                                        }
                                        elseif ($room_type == "acroom3") {
                                            echo "Air Conditioned Room 24 hours";
                                        }
                                        elseif ($room_type == "drivein1") {
                                            echo "Drive-In 3 hours";
                                        }
                                        elseif ($room_type == "drivein2") {
                                            echo "Drive-In 12 hours";
                                        }
                                        elseif ($room_type == "drivein3") {
                                            echo "Drive-In 24 hours";
                                        }
                                    } 
                                ?>
                            </td>
                            <td class="col-md-1 text-center">
                                <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $cottage1 = $rows['cottage1'];
                                        $cottage2 = $rows['cottage2'];
                                        $cottage3 = $rows['cottage3'];
                                        $acroom1 = $rows['acroom1'];
                                        $acroom2 = $rows['acroom2'];
                                        $acroom3 = $rows['acroom3'];
                                        $drivein1 = $rows['drivein1'];
                                        $drivein2 = $rows['drivein2'];
                                        $drivein3 = $rows['drivein3'];
                                        $none = $rows['none'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $room_type = $rows['room_type'];
                                            if ($room_type == "cottage1") {
                                                echo "₱" . " " . $cottage1;
                                            }
                                            elseif ($room_type == "cottage2") {
                                                echo "₱" . $cottage2;
                                            }
                                            elseif ($room_type == "cottage3") {
                                                echo "₱" . $cottage3;
                                            }
                                            elseif ($room_type == "acroom1") {
                                                echo "₱" . $acroom1;
                                            }
                                            elseif ($room_type == "acroom2") {
                                                echo "₱" . $acroom2;
                                            }
                                            elseif ($room_type == "acroom3") {
                                                echo "₱" . $acroom3;
                                            }
                                            elseif ($room_type == "drivein1") {
                                                echo "₱" . $drivein1;
                                            }
                                            elseif ($room_type == "drivein2") {
                                                echo "₱" . $drivein2;
                                            }
                                            elseif ($room_type == "drivein3") {
                                                echo "₱" . $drivein3;
                                            }
                                            elseif ($room_type == "drivein3") {
                                                echo  $none; 
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td class="col-md-1 text-center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $cottage1 = $rows['cottage1'];
                                        $cottage2 = $rows['cottage2'];
                                        $cottage3 = $rows['cottage3'];
                                        $acroom1 = $rows['acroom1'];
                                        $acroom2 = $rows['acroom2'];
                                        $acroom3 = $rows['acroom3'];
                                        $drivein1 = $rows['drivein1'];
                                        $drivein2 = $rows['drivein2'];
                                        $drivein3 = $rows['drivein3'];
                                        $none = $rows['none'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $room_type = $rows['room_type'];
                                            if ($room_type == "cottage1") {
                                                echo "₱" . $cottage1;
                                            }
                                            elseif ($room_type == "cottage2") {
                                                echo "₱" . $cottage2;
                                            }
                                            elseif ($room_type == "cottage3") {
                                                echo "₱" . $cottage3;
                                            }
                                            elseif ($room_type == "acroom1") {
                                                echo "₱" . $acroom1;
                                            }
                                            elseif ($room_type == "acroom2") {
                                                echo "₱" . $acroom2;
                                            }
                                            elseif ($room_type == "acroom3") {
                                                echo "₱" . $acroom3;
                                            }
                                            elseif ($room_type == "drivein1") {
                                                echo "₱" . $drivein1;
                                            }
                                            elseif ($room_type == "drivein2") {
                                                echo "₱" .  $drivein2;
                                            }
                                            elseif ($room_type == "drivein3") {
                                                echo "₱" . $drivein3;
                                            }
                                            elseif ($room_type == "none") {
                                                echo  "None"; 
                                            }
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>People</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 
                                <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $people = $rows['people'];
                                        echo $people;            
                                    } 
                                ?>
                            </td>
                            <td class="col-md-1 text-center">-</td>
                            <td class="col-md-1 text-center">-</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Adults</em></h4></td>
                            <td class="col-md-1" style="text-align: center">
                                <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $adult = $rows['adult'];
                                        echo $adult;            
                                    } 
                                ?>
                            </td>
                            <td class="col-md-1 text-center">
                                <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $day = $rows['day'];
                                        $night = $rows['night'];
                                        $whole_day = $rows['whole_day'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $entrance_type = $rows['entrance_type'];
                                            $adult = $rows['adult'];
                                            if ($entrance_type == "day"  && $adult > 0) {
                                                echo "₱" .  $day + $adult;
                                            }
                                            elseif ($entrance_type == "night" && $adult > 0) {
                                                echo "₱" .  $night * $adult;
                                            }
                                            elseif ($entrance_type == "whole_day" && $adult > 0) {
                                                echo "₱" .  $whole_day * $adult;
                                            }
                                            elseif ($adult == 0) {
                                                echo "-";
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td class="col-md-1 text-center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $day = $rows['day'];
                                        $night = $rows['night'];
                                        $whole_day = $rows['whole_day'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $entrance_type = $rows['entrance_type'];
                                            $adult = $rows['adult'];
                                            if ($entrance_type == "day"  && $adult > 0) {
                                                echo "₱" . $day + $adult;
                                            }
                                            elseif ($entrance_type == "night" && $adult > 0) {
                                                echo "₱" . $night * $adult;
                                            }
                                            elseif ($entrance_type == "whole_day" && $adult > 0) {
                                                echo "₱" . $whole_day * $adult;
                                            }
                                            elseif ($adult == 0) {
                                                echo "-";
                                            }
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Kids</em></h4></td>
                            <td class="col-md-1" style="text-align: center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $kid = $rows['kid'];
                                        echo $kid;            
                                    } 
                            ?>
                            </td>
                            <td class="col-md-1 text-center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $day = $rows['day'];
                                        $night = $rows['night'];
                                        $whole_day = $rows['whole_day'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $entrance_type = $rows['entrance_type'];
                                            $kid = $rows['kid'];
                                            if ($entrance_type == "day" && $kid > 0) {
                                                echo "₱" . $day + $kid;
                                            }
                                            elseif ($entrance_type == "night" && $kid > 0) {
                                                echo "₱" . $night * $kid;
                                            }
                                            elseif ($entrance_type == "whole_day" && $kid > 0) {
                                                echo "₱" . $whole_day * $kid;
                                            }
                                            elseif ($kid == 0) {
                                                echo "-";
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td class="col-md-1 text-center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $day = $rows['day'];
                                        $night = $rows['night'];
                                        $whole_day = $rows['whole_day'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $entrance_type = $rows['entrance_type'];
                                            $kid = $rows['kid'];
                                            if ($entrance_type == "day" && $kid > 0) {
                                                echo "₱" .  $day + $kid;
                                            }
                                            elseif ($entrance_type == "night" && $kid > 0) {
                                                echo "₱" .   $night * $kid;
                                            }
                                            elseif ($entrance_type == "whole_day" && $kid > 0) {
                                                echo "₱" .   $whole_day * $kid;
                                            }
                                            elseif ($kid == 0) {
                                                echo "-";
                                            }
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Senior Citizen</em></h4></td>
                            <td class="col-md-1" style="text-align: center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $senior = $rows['senior'];
                                        echo $senior;            
                                    } 
                            ?>
                            </td>
                            <td class="col-md-1 text-center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $day = $rows['day'];
                                        $night = $rows['night'];
                                        $whole_day = $rows['whole_day'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $entrance_type = $rows['entrance_type'];
                                            $senior = $rows['senior'];
                                            if ($entrance_type == "day" && $senior > 0) {
                                                echo "₱" .   $day + $senior;
                                            }
                                            elseif ($entrance_type == "night" && $senior > 0) {
                                                echo "₱" .   $night * $senior;
                                            }
                                            elseif ($entrance_type == "whole_day" && $senior > 0) {
                                                echo "₱" .   $whole_day * $senior;
                                            }
                                            elseif ($senior == 0) {
                                                echo "-";
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td class="col-md-1 text-center">
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $day = $rows['day'];
                                        $night = $rows['night'];
                                        $whole_day = $rows['whole_day'];
                                        
                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $entrance_type = $rows['entrance_type'];
                                            $senior = $rows['senior'];
                                            if ($entrance_type == "day" && $senior > 0) {
                                                echo "₱" .   $day + $senior;
                                            }
                                            elseif ($entrance_type == "night" && $senior > 0) {
                                                echo "₱" .   $night * $senior;
                                            }
                                            elseif ($entrance_type == "whole_day" && $senior > 0) {
                                                echo "₱" .   $whole_day * $senior;
                                            }
                                            elseif ($senior == 0) {
                                                echo "-";
                                            }
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>
                            <?php
                                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                                    while($rows = mysqli_fetch_assoc($select)){
                                        $day = $rows['day'];
                                        $night = $rows['night'];
                                        $whole_day = $rows['whole_day'];
                                        $cottage1 = $rows['cottage1'];
                                        $cottage2 = $rows['cottage2'];
                                        $cottage3 = $rows['cottage3'];
                                        $acroom1 = $rows['acroom1'];
                                        $acroom2 = $rows['acroom2'];
                                        $acroom3 = $rows['acroom3'];
                                        $drivein1 = $rows['drivein1'];
                                        $drivein2 = $rows['drivein2'];
                                        $drivein3 = $rows['drivein3'];
                                        $none = $rows['none'];

                                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                                        while($rows = mysqli_fetch_assoc($select)){
                                            $entrance_type = $rows['entrance_type'];
                                            $room_type = $rows['room_type'];
                                            $adult = $rows['adult'];
                                            $kid = $rows['kid'];
                                            $senior = $rows['senior'];

                                            if ($room_type == "cottage1") {
                                                $room_price = $cottage1;
                                            }
                                            elseif ($room_type == "cottage2") {
                                                $room_price = $cottage2;
                                            }
                                            elseif ($room_type == "cottage3") {
                                                $room_price = $cottage3;
                                            }
                                            elseif ($room_type == "acroom1") {
                                                $room_price = $acroom1;
                                            }
                                            elseif ($room_type == "acroom2") {
                                                $room_price = $acroom2;
                                            }
                                            elseif ($room_type == "acroom3") {
                                                $room_price = $acroom3;
                                            }
                                            elseif ($room_type == "drivein1") {
                                                $room_price = $drivein1;
                                            }
                                            elseif ($room_type == "drivein2") {
                                                $room_price = $drivein2;
                                            }
                                            elseif ($room_type == "drivein3") {
                                                $room_price = $drivein3;
                                            }
                                            elseif ($room_type == "none") {
                                                $room_price = $none;
                                            }

                                            if ($entrance_type == "day" && $kid > 0) {
                                                $kid_price = $day * $kid;
                                            }
                                            elseif ($entrance_type == "night" && $kid > 0) {
                                                $kid_price = $night * $kid;
                                            }
                                            elseif ($entrance_type == "whole_day" && $kid > 0) {
                                                $kid_price = $whole_day * $kid;
                                            }
                                            elseif ($kid == 0) {
                                                $kid_price = $none;
                                            }
                                            
                                            if ($entrance_type == "day" && $adult > 0) {
                                                $adult_price = $day * $adult;
                                            }
                                            elseif ($entrance_type == "night" && $adult > 0) {
                                                $adult_price = $night * $adult;
                                            }
                                            elseif ($entrance_type == "whole_day" && $adult > 0) {
                                                $adult_price = $whole_day * $adult;
                                            }
                                            elseif ($adult == 0) {
                                                $adult_price = $none;
                                            }

                                            if ($entrance_type == "day" && $senior > 0) {
                                                $senior_price = $day * $senior;
                                            }
                                            elseif ($entrance_type == "night" && $senior > 0) {
                                                $senior_price = $night * $senior;
                                            }
                                            elseif ($entrance_type == "whole_day" && $senior > 0) {
                                                $senior_price = $whole_day * $senior;
                                            }
                                            elseif ($senior == 0) {
                                                $senior_price = $none;
                                            }
                                            $total = $senior_price + $adult_price + $kid_price + $room_price;
                                            echo "₱". $total;
                                        }
                                    }
                                ?>
                            </strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
	  
        <div class="container mt-5 d-flex justify-content-center">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center">
                        <h5 class="total-amount pt-2" style="color: black;">Amount Payable</h5>
                        <div class="amount-container"><span class="amount-text"><span class="dollar-sign">₱</span>
                                <?php 
                                    echo $total;
                                ?>
                        </span></div>
                </div>
            <form class="form" method="POST" enctype="multipart/form-data">
            <div class="pt-4">
                <label class="d-flex justify-content-between">
                    <span class="label-text label-text-cc-number">GCASH NUMBER</span>
                    <img src="img/gcash.png" width="30" class="visa-icon" /></label> 
                    <input type="tel" name="gcash_number" class="form-control credit-card-number" maxlength="11" required="required">  
                </div>
            <div class="pt-4">
                <label class="d-flex justify-content-between">
                    <span class="label-text label-text-cc-number">Ref. No.</span>
                    <i class="bi bi-card-heading visa-icon"></i></label>
                    <input type="tel" name="ref_no" class="form-control credit-card-number" maxlength="20" required="required"> 
                </div>
            <div class="pt-4">
                <label class="d-flex justify-content-between">
                    <span class="label-text label-text-cc-number">Screenshot of Payment</span>
                    <i class="bi bi bi-image visa-icon"></i></label>
                    <input type="file" required class="form-control credit-card-number" id="image" name="image"> 
            </div>
            <div class="d-flex justify-content-between pt-5 align-items-center ml-4"> 
            <form class="form" method="GET" enctype="multipart/form-data">
                
                <?php
                    $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                    while($rows = mysqli_fetch_assoc($select)){
                        echo "<a href = 'status.php?del=$rows[id]'>
                            <button type='button' class='btn cancel-btn'>
                                Cancel Reservation
                            </button>
                          </a>";
                    }
                ?>
                </button> 
            </form>
                <button type="submit" class="payment-btn" name="submit">Make Payment</button> 
            </div>
            </form>
            <?php 
                if (isset($_POST['submit'])) {  
                    $gcash_number = $_POST['gcash_number'];
                    $ref_no = $_POST['ref_no'];
                    
                    $gc_pattern = "/^09[0-9]+$/";
                    if (preg_match($gc_pattern, $gcash_number)) {
                        $number_validation = "valid";
                    }
                    else{
                        $number_validation = "invalid";
                    }
                    $ref_pattern = "/^[0-9]+$/";
                    if (preg_match($ref_pattern, $ref_no)) {
                        $ref_validation = "valid";
                    }
                    else{
                        $ref_validation = "invalid";
                    }
                    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                    if ($image != NULL) {
                        $image_validation = "valid";
                    }
                    else{
                        $image_validation = "invalid";
                    }


                    if ($number_validation == "valid" && $ref_validation == "valid" && $image_validation == "valid") {
                        $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                        while($rows = mysqli_fetch_assoc($select)){
                            $reservation_id = $rows['id'];
 
                            $insert_into_db = mysqli_query($con, "INSERT INTO tbl_payment (amount_paid, gcash_number, reference_no, image, reservation_id, email, payment_date, payment_time) VALUES ('$total', '$gcash_number', '$ref_no', '$image', '$reservation_id', '$_SESSION[email]', CURDATE(), CURTIME())");
                            $reservation = "pending_paid";
                            date_default_timezone_set('Asia/Manila');
                            $dt = date('Y-m-d');
                            $dm = date('h:i:s');
                            $update = mysqli_query($con, "UPDATE tbl_user SET reservation='$reservation' WHERE email = '$_SESSION[email]'");
                            $update = mysqli_query($con, "UPDATE tbl_reservation SET payment='$reservation' WHERE email = '$_SESSION[email]'");
                            
                        }
                        if (!$insert_into_db) {
                            die("unable to save!");
                        }
                        else{
                            echo "<script>alert('Successfully submitted payment.');window.location.href='rating.php'</script>";
                        }
                    }
                    else{
                        echo "<script>alert('There's Something Wrong with the input.');window.location.href='userhome.php'</script>";
                    }
                }
            ?>
            <?php
                if (isset($_GET['del'])) {  
                    $delete = mysqli_query($con, "DELETE FROM tbl_reservation WHERE email = '$_SESSION[email]'");
    
                    $reservation = "cancelled";
                    $update = mysqli_query($con, "UPDATE tbl_user SET reservation='$reservation' WHERE email = '$_SESSION[email]'");
                    $update = mysqli_query($con, "UPDATE tbl_reservation SET payment='$reservation' WHERE email = '$_SESSION[email]'");
                    echo "<script>window.location.href='reserve.php'</script>";
                }
            ?>
         </div>
        </div>
	</div>
</div>
    
</section><!-- End Hero -->





<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/prism.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/components/prism-javascript.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/components/prism-typescript.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/components/prism-json.min.js"></script>
<script type="text/javascript" src="https://twemoji.maxcdn.com/2/twemoji.min.js?2.5"></script>

</body>
</html>                            
<script>
$(document).ready(function(){
	// Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function(){
		$(this).prev(".card-header").addClass("highlight");
	});
	
	// Highlight open collapsed element 
	$(".card-header .btn").click(function(){
		$(".card-header").not($(this).parents()).removeClass("highlight");
		$(this).parents(".card-header").toggleClass("highlight");
	});
});
</script>
<script>
	$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script>
	  !function(){"use strict";function e(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function t(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function r(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}new(function(){function n(e){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,n),this.defaults={start:0,end:100,duration:2e3,delay:10,once:!0,decimals:0,legacy:!0,currency:!1,currencysymbol:!1,separator:!1,separatorsymbol:",",selector:".purecounter"},this.configOptions=Object.assign({},this.defaults,e||{}),this.registerEventListeners()}var a,i,o;return a=n,(i=[{key:"registerEventListeners",value:function(){var e=document.querySelectorAll(this.configOptions.selector);if(this.intersectionListenerSupported()){var t=new IntersectionObserver(this.animateElements.bind(this),{root:null,rootMargin:"20px",threshold:.5});e.forEach((function(e){t.observe(e)}))}else window.addEventListener&&(this.animateLegacy(e),window.addEventListener("scroll",(function(t){this.animateLegacy(e)}),{passive:!0}))}},{key:"animateLegacy",value:function(e){var t=this;e.forEach((function(e){!0===t.parseConfig(e).legacy&&t.elementIsInView(e)&&t.animateElements([e])}))}},{key:"animateElements",value:function(e,t){var r=this;e.forEach((function(e){var n=e.target||e,a=r.parseConfig(n);if(a.duration<=0)return n.innerHTML=r.formatNumber(a.end,a);if(!t&&!r.elementIsInView(e)||t&&e.intersectionRatio<.5){var i=a.start>a.end?a.end:a.start;return n.innerHTML=r.formatNumber(i,a)}setTimeout((function(){return r.startCounter(n,a)}),a.delay)}))}},{key:"startCounter",value:function(e,t){var r=this,n=(t.end-t.start)/(t.duration/t.delay),a="inc";t.start>t.end&&(a="dec",n*=-1);var i=this.parseValue(t.start);e.innerHTML=this.formatNumber(i,t),!0===t.once&&e.setAttribute("data-purecounter-duration",0);var o=setInterval((function(){var s=r.nextNumber(i,n,a);e.innerHTML=r.formatNumber(s,t),((i=s)>=t.end&&"inc"==a||i<=t.end&&"dec"==a)&&(e.innerHTML=r.formatNumber(t.end,t),clearInterval(o))}),t.delay)}},{key:"parseConfig",value:function(r){var n=this,a=function(r){for(var n=1;n<arguments.length;n++){var a=null!=arguments[n]?arguments[n]:{};n%2?e(Object(a),!0).forEach((function(e){t(r,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(r,Object.getOwnPropertyDescriptors(a)):e(Object(a)).forEach((function(e){Object.defineProperty(r,e,Object.getOwnPropertyDescriptor(a,e))}))}return r}({},this.configOptions),i=[].filter.call(r.attributes,(function(e){return/^data-purecounter-/.test(e.name)})),o={};return i.forEach((function(e){var t=e.name.replace("data-purecounter-","").toLowerCase(),r="duration"==t?parseInt(1e3*n.parseValue(e.value)):n.parseValue(e.value);o[t]=r})),Object.assign(a,o)}},{key:"nextNumber",value:function(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"inc";return e=this.parseValue(e),t=this.parseValue(t),parseFloat("inc"===r?e+t:e-t)}},{key:"convertToCurrencySystem",value:function(e,t){var r=t.currencysymbol||"",n=t.decimals||1;return r+((e=Math.abs(Number(e)))>=1e12?"".concat((e/1e12).toFixed(n)," T"):e>=1e9?"".concat((e/1e9).toFixed(n)," B"):e>=1e6?"".concat((e/1e6).toFixed(n)," M"):e>=1e3?"".concat((e/1e12).toFixed(n)," K"):e.toFixed(n))}},{key:"applySeparator",value:function(e,t){return t.separator?e.replace(/(\d)(?=(\d{3})+(?!\d))/g,"$1,").replace(new RegExp(/,/gi,"gi"),t.separatorsymbol):e.replace(new RegExp(/,/gi,"gi"),"")}},{key:"formatNumber",value:function(e,t){var r={minimumFractionDigits:t.decimals,maximumFractionDigits:t.decimals};return e=t.currency?this.convertToCurrencySystem(e,t):parseFloat(e),this.applySeparator(e.toLocaleString(void 0,r),t)}},{key:"parseValue",value:function(e){return/^[0-9]+\.[0-9]+$/.test(e)?parseFloat(e):/^[0-9]+$/.test(e)?parseInt(e):/^true|false/i.test(e)?/^true/i.test(e):e}},{key:"elementIsInView",value:function(e){for(var t=e.offsetTop,r=e.offsetLeft,n=e.offsetWidth,a=e.offsetHeight;e.offsetParent;)t+=(e=e.offsetParent).offsetTop,r+=e.offsetLeft;return t>=window.pageYOffset&&r>=window.pageXOffset&&t+a<=window.pageYOffset+window.innerHeight&&r+n<=window.pageXOffset+window.innerWidth}},{key:"intersectionListenerSupported",value:function(){return"IntersectionObserver"in window&&"IntersectionObserverEntry"in window&&"intersectionRatio"in window.IntersectionObserverEntry.prototype}}])&&r(a.prototype,i),o&&r(a,o),n}())}();
  </script>