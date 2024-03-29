<?php 
	include 'database.php';
	session_start();
	$select = mysqli_query($con, "SELECT * FROM users WHERE username = '$_SESSION[username]' AND password = '$_SESSION[password]'");
	$count = mysqli_num_rows($select);
	if ($count == 0) {
		header("location:login.php");
	}
 ?>
<html>
<head>
	<title>Reservation</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="w3-top">
	  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
	    <a href="userhome.php#userhome" class="w3-bar-item w3-button">Almon Waterpark</a>
	    <!-- Right-sided navbar links. Hide them on small screens -->
	    <div class="w3-right w3-hide-small">
	    	<div class="dropdown">
	    	  <button id="close-CSS" class="dropbtn w3-bar-item w3-button" onclick="myFunction()">
	    	  </button>
	    	  <div class="dropdown-content" id="myDropdown">
	    	    <a href="cart.php">Account</a>
	    	    <a href="finalreserve.php">Reserve</a>
	    	    <a href="logout.php">Log out</a>
	    	  </div>
	    	  </div> 
	      <a href="userhome.php#userabout" class="w3-bar-item w3-button">About</a>
	      <a href="userhome.php#userroomscottage" class="w3-bar-item w3-button">Rooms & Cottages</a>
	      <a href="userhome.php#useramenities" class="w3-bar-item w3-button">Amenities</a>
	    </div>
	  </div>
	</div>
	<br><br><br>
	<h1 class="w3-animate-opacity" style="font-weight: bolder;">Enter Reservation Details</h1>

	<form method="POST">
	<div>
		<table class="w3-animate-opacity">
			<tr>
				<td><label>Entrance Type</label></td>
				<td>
					<select name="daynight">
						<option value="day">Day Swimming</option> 
						<option value="night">Night Swimming</option>
					</select>
				</td>
			</tr>

			<tr>
				<td><label>Select Room/Cottage Type</label></td>
				<td>
					<select name="roomcottage">
						<option value="none">None</option>
						<option value="cottage1">Small Cottage</option>
						<option value="cottage2">Medium Cottage</option>
						<option value="cottage3">Large Cottage</option>
						<option value="ac1">Air Conditioned Room (6 Hours)</option>
						<option value="ac2">Air Conditioned Room (12 Hours)</option>
						<option value="ac3">Air Conditioned Room (24 Hours)</option>
						<option value="drivein1">Drive-in (3 Hours)</option>
						<option value="drivein2">Drive-in (12 Hours)</option>
						<option value="drivein3">Drive-in (24 Hours)</option>
					</select>
				</td>
			</tr>

			<tr>
				<td><label>Number of people</label></td>
				<td>
					<select name="people">
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
				<td><h6 class="disclaimer">*Capacity limited due to COVID-19 protocols</h6></td>
			</tr>

			<tr>
				<td><label>Number of Adults</label></td>
				<td>
					<select name="adults">
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
					<select name="kids">
						<option value="0">0</option>
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
					<select name="seniorcitizen">
						<option value="0">0</option>
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
				<td><label>Date</label></td>
				<td><input type="date" name="date" value="" min="2021-05-11" max="2022-5-11" required=""></td>
			</tr>

			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" value="Reserve" class="w3-button w3-block w3-black w3-margin-bottom">
				</td>
			</tr>
		</table>
	</div>
	</form>
	<?php 

		if (isset($_POST['submit'])) {
			$daynight = $_POST['daynight'];
			$roomcottage = $_POST['roomcottage'];
			$people = $_POST['people'];
			$adults = $_POST['adults'];
			$kids = $_POST['kids'];
			$seniorcitizen = $_POST['seniorcitizen'];
			$date = $_POST['date']; 
		
			if ($daynight == "day" || $daynight == "night") {
				$daynight_validation = "valid";
			}
			else{
				$daynight_validation = "invalid";
			}

			if ($roomcottage == "none" || $roomcottage == "cottage1" || $roomcottage == "cottage2" || $roomcottage == "cottage3" || $roomcottage == "ac1" || $roomcottage == "ac2" || $roomcottage == "ac3" || $roomcottage == "drivein1" || $roomcottage == "drivein2" || $roomcottage == "drivein3") {
				$roomcottage_validation = "valid";
			}
			else{
				$roomcottage_validation = "invalid";
			}

			if ($people == "1" || $people == "2" || $people == "3" || $people == "4" || $people == "5" || $people == "6" || $people == "7" || $people == "8" || $people == "9" || $people == "10") {
				$people_validation = "valid";
			}
			else{
				$people_validation = "invalid";
			}

			if ($adults == "1" || $adults == "2" || $adults == "3" || $adults == "4" || $adults == "5" || $adults == "6" || $adults == "7" || $adults == "8" || $adults == "9" || $adults == "10") {
				$adults_validation = "valid";
			}
			else{
				$adults_validation = "invalid";
			}

			if ($kids == "0" || $kids == "1" || $kids == "2" || $kids == "3" || $kids == "4" || $kids == "5" || $kids == "6" || $kids == "7" || $kids == "8" || $kids == "9" || $kids == "10") {
				$kids_validation = "valid";
			}
			else{
				$kids_validation = "invalid";
			}

			if ($seniorcitizen == "0" || $seniorcitizen == "1" || $seniorcitizen == "2" || $seniorcitizen == "3" || $seniorcitizen == "4" || $seniorcitizen == "5" || $seniorcitizen == "6" || $seniorcitizen == "7" || $seniorcitizen == "8" || $seniorcitizen == "9" || $seniorcitizen == "10") {
				$seniorcitizen_validation = "valid";
			}
			else{
				$seniorcitizen_validation = "invalid";
			}

			$validation_amount = $adults + $kids + $seniorcitizen;
			if ($people == $validation_amount) {
				$amount_validation = "valid";
			}
			else{
				$amount_validation = "invalid";
			}

			$dayprice = 130;
			$nightprice = 140;
			$daypricechild = 120;
			$nightpricechild = 130;
			$seniorcitizendayprice = .20 * $dayprice;
			$seniorcitizennightprice = .20 * $nightprice;
			/* */

			if ($daynight == "day") {
				$pricedaynight = 130;
				//echo "Day Swimming Php 130" . "<br>";
			}
			else{
				$pricedaynight = 140;
				//echo "Night Swimming Php 140" . "<br>";
			}

			if ($roomcottage == "cottage1") {
				$priceroomcottage = 300;
				//echo "Small Cottage Php 300" . "<br>";
			}
			elseif ($roomcottage == "cottage2") {
				$priceroomcottage = 400;
				//echo "Medium Cotage Php 400" . "<br>";
			}
			elseif ($roomcottage == "cottage3") {
				$priceroomcottage = 600;
				//echo "Large Cottage Php 600" . "<br>";
			}
			elseif ($roomcottage == "ac1") {
				$priceroomcottage = 750;
				//echo "Air Conditioned room 6hours Php 750" . "<br>";
			}
			elseif ($roomcottage == "ac2") {
				$priceroomcottage = 1500;
				//echo "Air Conditioned room 12hours Php 1500" . "<br>";
			}
			elseif ($roomcottage == "ac3") {
				$priceroomcottage = 3000;
				//echo "Air Conditioned room 24hours Php 3000" . "<br>";
			}
			elseif ($roomcottage == "drivein1") {
				$priceroomcottage = 350;
				//echo "Drive-in 3hours Php 350" . "<br>";
			}
			elseif ($roomcottage == "drivein2") {
				$priceroomcottage = 1500;
				//echo "Drive-in 12hours Php 1500" . "<br>";
			}
			elseif ($roomcottage == "drivein3") {
				$priceroomcottage = 2600;
				//echo "Drive-in 24hours Php 2600" . "<br>";
			}
			else{
				$priceroomcottage = 0;
				//echo "No room" . "<br>";
			}

			if ($people == "1") {
				$peoplecount = 1;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "2") {
				$peoplecount = 2;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "3") {
				$peoplecount = 3;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "3") {
				$peoplecount = 3;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "4") {
				$peoplecount = 4;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "5") {
				$peoplecount = 5;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "6") {
				$peoplecount = 6;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "7") {
				$peoplecount = 7;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "8") {
				$peoplecount = 8;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			elseif ($people == "9") {
				$peoplecount = 9;
				//echo "Amount of people: " . $peoplecount . "<br>";
			}
			else {
				$peoplecount = 10;
				//echo "Amount of people: " . $peoplecount  . "<br>";
			}

			if ($adults == "1") {
				$adultscount = 1;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "2") {
				$adultscount = 2;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "3") {
				$adultscount = 3;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "4") {
				$adultscount = 4;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "5") {
				$adultscount = 5;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "6") {
				$adultscount = 6;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "7") {
				$adultscount = 7;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "8") {
				$adultscount = 8;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			elseif ($adults == "9") {
				$adultscount = 9;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}
			else{
				$adultscount = 10;
				//echo "Amount of adults: " . $adultscount  . "<br>";
			}

			if ($kids == "1") {
				$kidscount = 1;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "2") {
				$kidscount = 2;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "3") {
				$kidscount = 3;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "4") {
				$kidscount = 4;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "5") {
				$kidscount = 5;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "6") {
				$kidscount = 6;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "7") {
				$kidscount = 7;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "8") {
				$kidscount = 8;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "9") {
				$kidscount = 9;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			elseif ($kids == "10") {
				$kidscount = 10;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}
			else{
				$kidscount = 0;
				//echo "Amount of kids: " . $kidscount  . "<br>";
			}

			if ($seniorcitizen == "1") {
				$seniorcitizencount = 1;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "2") {
				$seniorcitizencount = 2;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "3") {
				$seniorcitizencount = 3;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "4") {
				$seniorcitizencount = 4;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "5") {
				$seniorcitizencount = 5;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "6") {
				$seniorcitizencount = 6;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "7") {
				$seniorcitizencount = 7;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "8") {
				$seniorcitizencount = 8;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "9") {
				$seniorcitizencount = 9;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			elseif ($seniorcitizen == "10") {
				$seniorcitizencount = 10;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}
			else{
				$seniorcitizencount = 0;
				//echo "Amount of seniorcitizen: " . $seniorcitizencount  . "<br>";
			}

			if ($daynight == "day") {
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
				$insert_into_db = mysqli_query($con, "INSERT INTO reservation (daynight, roomcottage, people, adults, kids, seniorcitizen, date, username) VALUES ('$daynight', '$roomcottage', '$people', '$adults', '$kids', '$seniorcitizen', '$date', '$_SESSION[username]')");
				//$insert_into_db = mysqli_query($con, "INSERT INTO users (daynight) VALUES ('$daynight')");

				if (!$insert_into_db) {
					die("unable to save!");
				}
				else{
					echo "<script>alert('Successfully reserved!');window.location.href='cart.php'</script>";
				}
			}
			else{
				echo "<script>alert('theres something wrong with your input!')</script>";
			
			}
		
		} 
	 ?>
</body>
<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
</script>
</html>