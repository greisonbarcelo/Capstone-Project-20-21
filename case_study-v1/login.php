<?php 
	//Site key 6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG
	//Server/secret key 6LcT3tUaAAAAAELJ9s7fbxkED1ncR7FUJtSQPgxK
	include("database.php");
	//recaptcha function
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
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
	<form method="POST">
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
		</div> <br> <br> <br>

		<h1 class="w3-animate-opacity">Log in</h1>

		<table  class="w3-animate-opacity">
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
				<td><input type="submit" name="submit" value="Login"></td>
			</tr>
			<tr>
				<td></td>
				<td><a class="signz" href="signup.php">Don't have an Account? Sign up here</a></td>
			</tr>
		</table>
		
	</form>
	<?php 
		include ("logfunc.php");
		session_start(); //beginning of session

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			
		
		if (isset($_POST['submit'])) {
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

			$username_pattern = "/^.{5,10}$/";
			if (preg_match($username_pattern, $username) == 0) {
				$log1 = "User entered invalid username";
				
				$username_validation = "invalid";
			}
			else{
				//echo "Valid username" . "<br>";
				$log1 = "User entered valid username";
				$username_validation = "valid";
			}
			$password_pattern = "/^.{5,10}$/";
			if (preg_match($password_pattern, $password) == 0) {
				//echo "Invalid password" . "<br>";
				$log2 = "User entered invalid password";
				$password_validation = "invalid";
			}
			else{
				//echo "Valid password" . "<br>";
				$log2 = "User entered valid password";
				$password_validation = "valid";
			}
			//adds all logs and combines them into logs.txt same with signup.php to keep track of user activities :))
			$log = "Log in: " . $log1 . " and " . $log2;
			logger($log);

			$hashed_password = md5($password); //hashing method md5 and same in signup page
			if ($username_validation == "valid" && $password_validation == "valid" && $captcha_validation == "valid") {
				$select = mysqli_query($con, "SELECT * FROM users WHERE username ='$username' AND password ='$hashed_password'");

				while ($result = mysqli_fetch_array($select)) { //for pulling out the information before starting session
					$_SESSION['firstname'] = $result['first_name'];
					$_SESSION['lastname'] = $result['last_name'];
					$_SESSION['age'] = $result['age'];
					$_SESSION['gender'] = $result['gender'];
					$_SESSION['email'] = $result['email'];
					$_SESSION['username'] = $result['username'];
					$_SESSION['password'] = $result['password'];
					$_SESSION['number'] = $result['number'];

					$_SESSION['daynight'] = $result['daynight'];
					$_SESSION['roomcottage'] = $result['roomcottage'];
					$_SESSION['people'] = $result['people'];
					$_SESSION['adults'] = $result['adults'];
					$_SESSION['kids'] = $resultwo['kids'];
					$_SESSION['seniorcitizen'] = $result['seniorcitizen'];
					$_SESSION['date'] = $result['date'];
				}
				
				$count = mysqli_num_rows($select); //parameters: mysqli_query, 
				if ($count == 1) {
					header("location:userhome.php");
				}
				else{
					echo "<script>alert('Account doesnt exist! ')</script>";
			}
				
		}
	}
	}
	 ?>
</body>
</html>