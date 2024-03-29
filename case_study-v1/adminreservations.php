<?php 
	include("database.php");
	session_start();
	$select = mysqli_query($con, "SELECT * FROM admins WHERE admin_username = '$_SESSION[admin_username]' AND admin_password = '$_SESSION[admin_password]'");
	$count = mysqli_num_rows($select);
	if ($count == 0) {
		header("location:adminlogin.php");
	}
 ?>
<html>
<head>
	<title>Reservations</title>
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		/* The sidebar menu */
		.sidenav {
		  height: 100%; /* Full-height: remove this if you want "auto" height */
		  width: 160px; /* Set the width of the sidebar */
		  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
		  z-index: 1; /* Stay on top */
		  top: 0; /* Stay at the top */
		  left: 0;
		  background-color: #111; /* Black */
		  overflow-x: hidden; /* Disable horizontal scroll */
		  padding-top: 20px;
		}

		/* The navigation menu links */
		.sidenav a {
		  padding: 6px 8px 6px 16px;
		  text-decoration: none;
		  font-size: 25px;
		  color: #818181;
		  display: block;
		}

		/* When you mouse over the navigation links, change their color */
		.sidenav a:hover {
		  color: #f1f1f1;
		}

		/* Style page content */
		.main {
		  margin-left: 160px; /* Same as the width of the sidebar */
		  padding: 0px 10px;
		}

		/* On smaller screens, where height is less than 450px, change the style of the sidebar (less padding and a smaller font size) */
		@media screen and (max-height: 450px) {
		  .sidenav {padding-top: 15px;}
		  .sidenav a {font-size: 18px;}
		}
		#table, th, .td {
			border:1px solid #d6d6d6;
			border-collapse: collapse;
			width:800px;
			text-align:center;
		}
	</style>
</head>
<body>
	<!-- Side navigation -->
	<div class="sidenav">
	  <a href="admindashboard.php"><img src="pics/admin1.png" class="adminlogo"></a>
	  <a href="admindashboard.php">Admins</a> <br>
	  <a href="adminusers.php">Users</a> <br>
	  <a href="adminreservations.php" class="active">Reservations</a> <br>
	  <a href="adminlogout.php">Log Out</a>
	</div>

	<!-- Page content --><br><br>
	<h1 class="active">List of Reservations</h1> <br> <br>
	<div class="main">
		<table id="table">
			<tr>
				<td class='td'>ID</td>
				<td class='td'>Day/Night</td>
				<td class='td'>Rooms/Cottage</td>
				<td class='td'>People</td>
				<td class='td'>Adults</td>
				<td class='td'>Kids</td>
				<td class='td'>Senior Citizens</td>
				<td class='td'>Date</td>
				<td class='td'>Username</td>
				<td class='td'>Edit</td>
				<td class='td'>Delete</td>
			</tr>
			<?php 
				$select = mysqli_query($con, "SELECT * FROM reservation");
				while ($row = mysqli_fetch_assoc($select)) {
					echo "<tr>";
						echo "<td class='td'>". $row['id'] . '</td>';
						echo "<td class='td'>". $row['daynight'] . '</td>';
						echo "<td class='td'>". $row['roomcottage'] . '</td>';
						echo "<td class='td'>". $row['people'] . '</td>';
						echo "<td class='td'>". $row['adults'] . '</td>';
						echo "<td class='td'>". $row['kids'] . '</td>';
						echo "<td class='td'>". $row['seniorcitizen'] . '</td>';
						echo "<td class='td'>". $row['date'] . '</td>';
						echo "<td class='td'>". $row['username'] . '</td>';
						echo "<td class='td'>". "<a href = 'adminreservations.php?id=$row[id]'><button style='color: green;'>Edit</button></a>" . '</td>';
						echo "<td class='td'>". "<a href = 'adminreservations.php?del=$row[id]'><button style='color: red;'>Delete</button></a>" . '</td>';
						
					echo "</tr>";
				}
			 ?>
			 <?php // if admin deletes an account
			 	if (isset($_GET['del'])) {
			 		$deleteuser = $_GET['del'];
			 		$delete = mysqli_query($con, "DELETE FROM reservation WHERE id = '$deleteuser'");
			 		
			 		echo "<script>alert('Reservation deleted');window.location.href='adminreservations.php'</script>";
			 	}
			  ?>
		</table>
	</div>
	<?php 
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$select = mysqli_query($con, "SELECT * FROM reservation WHERE id = '$id'");
			while ($row = mysqli_fetch_array($select)) {
	?>
		<br><form method="POST">
		<table>
			<tr>
				<td><label>Entrance Type</label></td>
				<td>
					<select name="daynight" value ="<?php echo($row['daynight']); ?>">
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
				<td><input type="submit" name="save" value="Save"></td>
			</tr>
		</table>
		</form>
	<?php	
			}
		}
	 ?>

	 <?php 
	 	if (isset($_POST['save'])) {
	 		//saving when admin edits their reservation :)
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

	 			if ($daynight_validation == "valid" && $roomcottage_validation == "valid" && $people_validation == "valid" && $adults_validation == "valid" && $kids_validation == "valid" && $seniorcitizen_validation == "valid" && $amount_validation =="valid"){

	 			$update = mysqli_query($con, "UPDATE reservation SET daynight='$daynight', roomcottage='$roomcottage', people='$people', adults='$adults', kids='$kids', seniorcitizen='$seniorcitizen', date='$date' WHERE id = '$id'");
	 			if (!$update) {
	 				echo "<script>alert('Unable to edit reservation!')</script>";
	 			}
	 			else
	 				echo "<script>alert('Successfully changed reservation!');window.location.href='adminreservations.php?=$id'</script>";
	 		}
	 	}
	  ?>
</body>
</html>