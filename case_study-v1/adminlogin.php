<?php 
	//admin password auto created: 21232f297a57a5a743894a0e4a801fc3
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
	<title>Admin Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
	<div>
		<table>
			<tr>
				<td><td><img src="pics/admin1.png" class="adminlogologin"></td></td>
			</tr>
			<tr>
				<td></td>
				<td><h1 class="active w3-animate-opacity">Administrator Login</h1></td>
			</tr>
		</table>
	</div> <br>
	<form method="POST">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="admin_username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="admin_password"></td>
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
				<td><a href="#" class="signz">Request main admin to create an account</a></td>
			</tr>
		</table>		
	</form>

	<?php 
		include ("logfunc.php");
		session_start();

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			if (isset($_POST['submit'])) {
				$admin_username = $_POST['admin_username'];
				$admin_password = $_POST['admin_password'];
				$recaptcha = $_POST['g-recaptcha-response'];
				$res = reCaptcha($recaptcha);

				if(!$res['success']){
				  $captcha_validation = "invalid";
				}
				else{
					$captcha_validation = "valid";
				}

				$username_pattern = "/^.{5,10}$/";
				if (preg_match($username_pattern, $admin_username) == 0) {
					$log1 = "User entered invalid username";
					
					$username_validation = "invalid";
				}
				else{
					//echo "Valid username" . "<br>";
					$log1 = "User entered valid username";
					$username_validation = "valid";
				}
				$password_pattern = "/^.{5,10}$/";
				if (preg_match($password_pattern, $admin_password) == 0) {
					//echo "Invalid password" . "<br>";
					$log2 = "User entered invalid password";
					$password_validation = "invalid";
				}
				else{
					//echo "Valid password" . "<br>";
					$log2 = "User entered valid password";
					$password_validation = "valid";
				}
				$log = "Log in: " . $log1 . " and " . $log2;
				logger($log);


				$admin_password = md5($admin_password); //hashing method md5 and same in signup page
				if ($username_validation == "valid" && $password_validation == "valid" && $captcha_validation == "valid") {
					$select = mysqli_query($con, "SELECT * FROM admins WHERE admin_username ='$admin_username' AND admin_password ='$admin_password'");
					while ($result = mysqli_fetch_array($select)) { //for pulling out the information before starting session
						$_SESSION['admin_username'] = $result['admin_username'];
						$_SESSION['admin_password'] = $result['admin_password'];
					}
					$count = mysqli_num_rows($select); //parameters: mysqli_query, 
					if ($count == 1) {
						header("location:admindashboard.php");
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