<?php 
	//Site key 6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG
	//Server/secret key 6LcT3tUaAAAAAELJ9s7fbxkED1ncR7FUJtSQPgxK
	include("database.php");
	function reCaptcha($recaptcha){
		  $secret = "6LcT3tUaAAAAAELJ9s7fbxkED1ncR7FUJtSQPgxK";
		  $ip = $_SERVER['REMOTE_ADDR'];

		  $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
		  $url = "https://www.google.com/recaptcha/api/siteverify";
		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $url);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
		  $data = curl_exec($ch);
		  curl_close($ch);

		  return json_decode($data, true);
		}
 ?>
<html>
<head>
	<title>Sign up</title>
	<meta charset="utf-8">
	<!-- External css named 'style.css' -->
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
	<div id="header">
		<div class="w3-top">
		  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
		    <a href="index.php" class="w3-bar-item w3-button">Almon Waterpark</a>
		    <!-- Right-sided navbar links. Hide them on small screens -->
		    <div class="w3-right w3-hide-small">
		      <a href="index.php#about" class="w3-bar-item w3-button">About</a>
		      <a href="index.php#roomscottage" class="w3-bar-item w3-button">Rooms & Cottages</a>
		      <a href="index.php#amenities" class="w3-bar-item w3-button">Amenities</a>
		      <a href="login.php" class="w3-bar-item w3-button">Login</a>
		    </div>
		  </div>
		</div>
	</div> 
	<h1 class="w3-animate-opacity">Create an Account</h1>
	
	<!-- ADD SECURITY BELOW ONCE FINISHED -->
	<form method="POST"> 
		<table class="w3-animate-opacity">
			<tr>
				<td><label>First Name</label> </td>
				<td><input type="text" name="fname" required="" maxlength="20"></td>
			</tr>

			<tr>
				<td><label>Last Name</label> </td>
				<td><input type="text" name="lname" required="" maxlength="20"></td>
			</tr>

			<tr>
				<td><label>Age</label> </td>
				<td><input type="text" name="age" required="" maxlength="2"></td>
			</tr>

			<tr>
				<td><label>Gender</label></td>
				<td>
					<select name="gender" required="">
						<option value="male">Male</option>
						<option value="female">Female</option>
						<option value="other">Other</option>
					</select>
				</td>
			</tr>

			<tr>
				<td><label>Phone number</label> </td>
				<td><input type="text" name="number" required="" maxlength="11"></td>
			</tr>

			<tr>
				<td><label>Email</label> </td>
				<td><input type="email" name="email" required="" maxlength="255"></td>
			</tr>

			<tr>
				<td><label>Username</label> </td>
				<td><input type="text" name="username" required="" maxlength="10"></td>
			</tr>

			<tr>
				<td><label>Password</label> </td>
				<td><input type="password" name="password" required="" maxlength="10"></td>
			</tr>

			<tr>
				<td></td>
				<td>
					<div class="g-recaptcha brochure__form__captcha" data-sitekey="6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG"></div>
				</td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Create an Account"></td>
			</tr>
			<tr>
				<td></td>
				<td><a class="signz" href="login.php">Already have an Account? Login here</a></td>
			</tr>
		</table>
	</form>

	<?php 
		include ("logfunc.php");
		if ($_SERVER['REQUEST_METHOD'] === "POST") {

		if (isset($_POST['submit'])) {
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$age = $_POST['age'];
			$email = $_POST['email'];
			$number = $_POST['number'];
			$gender = $_POST['gender'];
			$username = $_POST['username'];
			$password = $_POST['password'];

			$recaptcha = $_POST['g-recaptcha-response'];
			$res = reCaptcha($recaptcha);
			if(!$res['success']){
			  $captcha_validation = "invalid";
			}
			else{
				$captcha_validation = "valid";
			}
			//REGEX
			//Sanitizing user input and use of RegEx
			$names_pattern = "/^\s+|[0-9]+$/";
			if (preg_match($names_pattern, $fname) == 1) {	
				$log1 = "User entered invalid first name";
				$fname_validation = "invalid";
			}
			elseif(strlen($fname) > 20 || strlen($fname) < 2){
				$log1 = "User entered invalid first name";
				$fname_validation = "invalid";
			}
			else{
				$log1 = "User entered valid first name";
				$fname_validation = "valid";
			}
			if (preg_match($names_pattern, $lname) == 1) {	
				$log2 = "User entered invalid last name";
				$lname_validation = "invalid";
			}
			elseif(strlen($lname) > 20 || strlen($lname) < 2){
				$log2 = "User entered invalid last name";
				$lname_validation = "invalid";
			}
			else{
				$log2 = "User entered valid last name";
				$lname_validation = "valid";
			}

			$age_pattern = "/^[a-zA-Z]|\s+$/";
			if (preg_match($age_pattern, $age) == 1) {
				$log3 = "User entered invalid age";
				$age_validation = "invalid";
			}
			elseif(strlen($age) > 2 || strlen($age) < 1){
				$log3 = "User entered invalid age";
				$age_validation = "invalid";
			}
			else{
				$log3 = "User entered valid age";
				$age_validation = "valid";
			}

			$num_pattern = "/^09[0-9]+]$/";
			if (preg_match($num_pattern, $number) == 1) {
				$log4 = "User entered invalid number";
				$number_validation = "invalid" ;
			}
			elseif ($number != 11) {
				$log4 = "User entered invalid number";
				$number_validation = "invalid" ;
			}
			else{
				$log4 = "User entered valid number";
				$number_validation = "valid" ;
			} 

			if ($gender == "male" || $gender == "female" || $gender == "other") {
				$log5 = "Sign up: User entered valid gender";
				$gender_validation = "valid";
			}
			else{
				$log5 = "User entered invalid gender";
				$gender_validation = "invalid";
			}

			$email_pattern = "/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z\d]+\.[a-zA-Z\.]+$/";
			if (preg_match($email_pattern, $email)) {
				$log6 = "User entered valid email";
				$email_validation = "valid";
			}
			else{
				$log6 = "User entered invalid email";
				$email_validation = "invalid";
			}

			$username_pattern = "/^.{5,10}$/";
			if (preg_match($username_pattern, $username) == 0) {
				$log7 = "User entered invalid username";
				$username_validation = "invalid";
			}
			else{
				$log7 = "User entered valid username";
				$username_validation = "valid";
			}
			
			$password_pattern = "/^.{5,10}$/";
			if (preg_match($password_pattern, $password) == 0) {
				$log8 = "User entered invalid password";
				$password_validation = "invalid";
			}
			else{
				$log8 = "User entered valid password";
				$password_validation = "valid";
			}
			$log = "Sign up: " . $log1 . " and " . $log2 . " and " . $log3 . " and " . $log4 . " and " . $log5 . " and " . $log6 . " and " . $log7 . " and " . $log8;
			logger($log);

			//Inserting data onto databasee :)
			if ($fname_validation == "valid" && $lname_validation == "valid" && $age_validation == "valid" && $gender_validation == "valid" && $email_validation == "valid" && $username_validation == "valid" && $password_validation == "valid" && $captcha_validation =="valid") {

				$hashed_password = md5($password); //hashing method md5 and same in login page

				$insert_into_db = mysqli_query($con, "INSERT INTO users (first_name, last_name, age, gender, email, username, password, number) VALUES ('$fname', '$lname', '$age', '$gender', '$email', '$username', '$hashed_password', '$number')");
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
		} 
	 ?>
	
</body>
</html>