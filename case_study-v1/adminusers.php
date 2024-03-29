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
	<title>Administrator Dashboard</title>
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
	  <a href="adminusers.php" class="active">Users</a> <br>
	  <a href="adminreservations.php">Reservations</a> <br>
	  <a href="adminlogout.php">Log Out</a>
	</div>

	<!-- Page content --><br><br>
	<h1 class="active">List of Registered Users</h1> <br> <br>
	<div class="main">
		<table id="table">
			<tr>
				<td class='td'>First Name</td>
				<td class='td'>Last Name</td>
				<td class='td'>Age</td>
				<td class='td'>Gender</td>
				<td class='td'>Email</td>
				<td class='td'>Username</td>
				<td class='td'>Password</td>
				<td class='td'>Number</td>
				<td class='td'>Action</td>
			</tr>
			<?php 
				$select = mysqli_query($con, "SELECT * FROM users");
				while ($row = mysqli_fetch_assoc($select)) {
					echo "<tr>";
						echo "<td class='td'>". $row['first_name'] . '</td>';
						echo "<td class='td'>". $row['last_name'] . '</td>';
						echo "<td class='td'>". $row['age'] . '</td>';
						echo "<td class='td'>". $row['gender'] . '</td>';
						echo "<td class='td'>". $row['email'] . '</td>';
						echo "<td class='td'>". $row['username'] . '</td>';
						echo "<td class='td'>". $row['password'] . '</td>';
						echo "<td class='td'>". $row['number'] . '</td>';
						echo "<td class='td'>". "<a href = 'adminusers.php?del=$row[username]'><button style='color: red;'>Delete</button>" . '</td>';
					echo "</tr>";
				}
			 ?>
			 <?php // if admin deletes an account
			 	if (isset($_GET['del'])) {
			 		$deleteuser = $_GET['del'];
			 		$delete = mysqli_query($con, "DELETE FROM users WHERE username = '$deleteuser'");
			 		
			 		echo "<script>alert('User deleted');window.location.href='adminusers.php'</script>";
			 	}
			  ?>
		</table>
	</div>
	
</body>
</html>