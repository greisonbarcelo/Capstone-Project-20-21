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
	  <a href="admindashboard.php" class="active">Admins</a> <br>
	  <a href="adminusers.php">Users</a> <br>
	  <a href="adminreservations.php">Reservations</a> <br>
	  <a href="adminlogout.php">Log Out</a>
	</div>

	<div> 
		<h3>Create another admin account</h3>
		<form method="POST">
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" name="admin_username" required="" maxlength="10"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="admin_password" required="" maxlength="10"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	</div>
	<?php 
		if (isset($_POST['submit'])) {
			$admin_username = $_POST['admin_username'];
			$admin_password = $_POST['admin_password'];	

			$username_pattern = "/^.{5,10}$/";
			if (preg_match($username_pattern, $admin_username) == 0) {
				$log7 = "User entered invalid username";
				$username_validation = "invalid";
			}
			else{
				$log7 = "User entered valid username";
				$username_validation = "valid";
			}
			
			$password_pattern = "/^.{5,10}$/";
			if (preg_match($password_pattern, $admin_password) == 0) {
				$log8 = "User entered invalid password";
				$password_validation = "invalid";
			}
			else{
				$log8 = "User entered valid password";
				$password_validation = "valid";
			}

			//Inserting data onto databasee :)
			if ($username_validation == "valid" && $password_validation == "valid") {

				$admin_password = md5($admin_password); //hashing method md5 and same in login page

				$insert_into_db = mysqli_query($con, "INSERT INTO admins (admin_username, admin_password) VALUES ('$admin_username', '$admin_password')");
				//parameters of mysqli_query();
				//connection - $con
				//database query - ......
				if (!$insert_into_db) {
					die("unable to save!");
				}
				else{
					echo "<script>alert('Successfully created an account!')</script>";
				}
			}
			else{
				echo "<script>alert('theres something wrong with your input!')</script>";
			}
		}
	 ?>
	 <!-- Page content --><br><br>
	 <h1>List of Admins</h1> <br>
	 <div class="main">
	 	<table id="table">
	 		<tr>
	 			<td class='td'>Username</td>
	 			<td class='td'>Password</td>
	 			<td class='td'>Edit</td>
	 			<td class='td'>Delete</td>
	 		</tr>
	 		<?php 
	 			$select = mysqli_query($con, "SELECT * FROM admins");
	 			while ($row = mysqli_fetch_assoc($select)) {
	 				echo "<tr>";
	 					echo "<td class='td'>". $row['admin_username'] . '</td>';
	 					echo "<td class='td'>". $row['admin_password'] . '</td>';
	 					echo "<td class='td'>". "<a href = 'admindashboard.php?admin_username=$row[admin_username]'><button style='color: green;'>Edit</button>" . '</td>';
	 					echo "<td class='td'>". "<a href = 'admindashboard.php?del=$row[admin_username]'><button style='color: red;'>Delete</button>" . '</td>';
	 				echo "</tr>";
	 			}
	 		 ?>
	 		 <?php // if admin deletes an account
	 		 	if (isset($_GET['del'])) {
	 		 		$deleteuser = $_GET['del'];
	 		 		$delete = mysqli_query($con, "DELETE FROM admins WHERE admin_username = '$deleteuser'");
	 		 		
	 		 		echo "<script>alert('User deleted');window.location.href='admindashboard.php'</script>";
	 		 	}
	 		  ?>
	 		 </table>
	 		 </form> <br>
	 		 <?php 
	 		 	if (isset($_GET['admin_username'])) {
	 		 		$admin_username = $_GET['admin_username'];
	 		 		$select = mysqli_query($con, "SELECT * FROM admins WHERE admin_username = '$admin_username'");
	 		 		while ($row = mysqli_fetch_array($select)) {
	 		 ?>	
	 		 	<form method="POST">
	 		 		<table>
	 		 			<tr>
	 		 				<td>Username</td>
	 		 				<td><input type="text" name="admin_newuser" value="<?php echo ($row['admin_username']); ?>"></td>
	 		 			</tr>
	 		 			<tr>
	 		 				<td>Password</td>
	 		 				<td><input type="text" name="admin_newpass" value="<?php echo ($row['admin_password']); ?>" ></td>
	 		 			</tr>
	 		 			<tr>
	 		 				<td></td>
	 		 				<td><input type="submit" name="create" value="Edit"></td>
	 		 			</tr>

	 		<?php 
	 			}
	 		}
	 		?>
	 		<?php 
	 			if (isset($_POST['create'])) {
	 				$admin_newuser = $_POST['admin_newuser'];
	 				$admin_newpass = $_POST['admin_newpass'];

	 				$username_pattern = "/^.{5,10}$/";
	 				if (preg_match($username_pattern, $admin_newuser) == 0) {
	 					$log7 = "User entered invalid username";
	 					$username_validation = "invalid";
	 				}
	 				else{
	 					$log7 = "User entered valid username";
	 					$username_validation = "valid";
	 				}
	 				
	 				$password_pattern = "/^.{5,10}$/";
	 				if (preg_match($password_pattern, $admin_newpass) == 0) {
	 					$log8 = "User entered invalid password";
	 					$password_validation = "invalid";
	 				}
	 				else{
	 					$log8 = "User entered valid password";
	 					$password_validation = "valid";
	 				}

	 				//Inserting data onto databasee :)
	 				if ($username_validation == "valid" && $password_validation == "valid") {

	 					$admin_newpass = md5($admin_newpass); //hashing method md5 and same in login page

	 					$update = mysqli_query($con, "UPDATE admins SET admin_username ='$admin_newuser', admin_password = '$admin_newpass' WHERE admin_username = '$admin_username'");
	 					//parameters of mysqli_query();
	 					//connection - $con
	 					//database query - ......
	 					if (!$update) {
	 						die("unable to save!");
	 					}
	 					else{
	 						echo "<script>alert('Successfully created an account!');window.location.href='admindashboard.php'</script>";
	 					}
	 				}
	 				else{
	 					echo "<script>alert('theres something wrong with your input!')</script>";
	 				}
	 			}
	 		 ?>

	 	</table>
	 </div>

</body>
</html>