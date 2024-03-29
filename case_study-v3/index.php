<?php 
	include("database.php");
	include ("logfunc.php");
	session_start(); //beginning of session

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


</head> 
<body>
<nav class="navbar navbar-expand-xl navbar-light bg-light fixed-top">
	<a href="index.php" class="navbar-brand"><i class="fa fa-cube"></i>Almon<b>Waterpark</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="#" class="nav-item nav-link active">Home</a>
			<a href="#about" class="nav-item nav-link">About</a>
			<a href="#pricing" class="nav-item nav-link">Pricing</a>
			<a href="#" class="nav-item nav-link">Contact</a>
		</div>
		
		
		<div class="navbar-nav ml-auto">
		<a href="#myModal" class="trigger-btn nav-link  mr-4" data-toggle="modal">Login</a>
		<a href="#myModals" class="btn btn-primary sign-up-btn" data-toggle="modal">Sign up</a>	
		</div>
	</div>
</nav>
	<!-- Modal HTML -->
	<form class="form" method="POST" enctype="multipart/form-data">
	<div id="myModal" class="modal fade">
		<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<div class="avatar">
				<span class="material-icons md-light md-48">account_circle</span>
				</div>				
				<h4 class="modal-title">Login</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				
					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Email Address" required="required">		
					</div>
					<div class="form-group input-group" id="show_hide_password">
							<input type="password" class="form-control" name="password" placeholder="Password" required="required" maxlength="20">
							<div class="input-group-addon">
        						<a href=""><i class="fa fa-eye-slash pt-2 ml-3" aria-hidden="true"></i></a>
      						</div>	
						</div>
					<div class="g-recaptcha brochure__form__captcha" data-sitekey="6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG"></div>        
					<div class="form-group pt-3">
						<button type="login" name="login" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
					</div>
					
				
			</div>
			<div class="modal-footer"> Don't have an Account?
				<a href="#" data-target="#myModals" class="trigger-btn nav-link  mr-4" data-toggle="modal" data-dismiss="modal" aria-label="Close">Signup here</a>
			</div>
			<div class="modal-footer">
				<a href="#">Forgot Password?</a>
			</div>
			</div>
		</div>
	</div>
</form>
<?php
	
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$recaptcha = $_POST['g-recaptcha-response'];
		$res = reCaptcha($recaptcha);
		if(!$res['success']){
		  $captcha_validation = "invalid";
		}
		else{
			$captcha_validation = "valid";
		}

		$email_pattern = "/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z\d]+\.[a-zA-Z\.]+$/";
        if (preg_match($email_pattern, $email)) {
            $log1 = "User entered valid email";
            $email_validation = "valid";
        }
        else{
            $log1 = "User entered invalid email";
            $email_validation = "invalid";
        }

		$password_pattern = "/^.{5,10}$/";
		if (preg_match($password_pattern, $password) == 0) {
			$log2 = "User entered invalid password";
			$password_validation = "invalid";
		}
		else{
			$log2 = "User entered valid password";
			$password_validation = "valid";
		}
		//adds all logs and combines them into logs.txt same with signup.php to keep track of user activities :))
		$log = "Log in: " . $log1 . " and " . $log2;
		logger($log);

		$hashed_password = md5($password); //hashing method md5 and same in signup page
		

		if ($email_validation == "valid" && $password_validation == "valid" && $captcha_validation == "valid") {
			$select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email ='$email'");
			$select2 = mysqli_query($con, "SELECT * FROM tbl_user WHERE password ='$hashed_password'");
			$select3 = mysqli_query($con, "SELECT * FROM tbl_user WHERE email ='$email' AND password ='$hashed_password'");

			while ($result = mysqli_fetch_array($select3)) { //for pulling out the information before starting session
				$_SESSION['fname'] = $result['fname'];
				$_SESSION['lname'] = $result['lname'];
				$_SESSION['bday'] = $result['bday'];
				$_SESSION['gender'] = $result['gender'];
				$_SESSION['email'] = $result['email'];
				$_SESSION['id'] = $result['id'];
				$_SESSION['password'] = $result['password'];
				$_SESSION['number'] = $result['number'];
				$_SESSION['image'] = $result['image'];
				$_SESSION['reservation'] = "none";
				$_SESSION['notif'] = $result['notif'];
			} 

			$count = mysqli_num_rows($select); //parameters: mysqli_query,
			$count2 = mysqli_num_rows($select2); //parameters: mysqli_query, 

			if ($count == 1) {
				if ($count2 == 1) {
					echo "<script>window.location.href='userhome.php';</script>";
    exit;
				}
				else{
					echo "<div class='alert alert-warning alert-dismissible fade show fixed-top'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<center>
						<strong>Incorrect Password.</strong>
						<div class='spinner-border'></div>
						</center>
					  </div>";
				}
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible fade show fixed-top'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<center>
						<strong>Account does not exist.</strong>
						<div class='spinner-border'></div>
						</center>
					  </div>";
		}
			
	}
}
?>
<form action="#" class="form" method="POST" enctype="multipart/form-data">
	<div id="myModals" class="modal fade">
		<div class="modal-dialog modal-login">
			<div class="modal-content">
				<div class="modal-header">
					<div class="avatar">
					<span class="material-icons md-light md-48">account_circle</span>
					</div>				
					<h4 class="modal-title">Create an Account</h4>	
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="Email Address" required="required" maxlength="255">		
						</div>

						<div class="form-group input-group" id="show_hide_password">
							<input type="password" class="form-control" name="password" placeholder="Password" required="required" maxlength="20">
							<div class="input-group-addon">
        						<a href=""><i class="fa fa-eye-slash pt-2 ml-3" aria-hidden="true"></i></a>
      						</div>	
						</div>

					<div class="form-group input-group">
						<input type="text" class="form-group form-control" name="fname" placeholder="First Name" required="required" maxlength = "20">
						<input type="text" class="form-group form-control" name="lname" placeholder="Last Name" required="required"  maxlength = "20">	
					</div>
					<div class="form-group">
						<input name="bday" placeholder="Date of Birth" class="textbox-n form-control" type="text" required="required" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />		
					</div>
					<div class="form-group">
						<select name="gender" required="" class="form-control select-form">
							<option value="male" aria-label="Disabled select example">Gender</option>
                			<option value="male">Male</option>
                			<option value="female">Female</option>
                			<option value="other">Other</option>
            			</select>		
					</div>
					<div class="form-group">
						<input type="tel" class="form-control" name="number" placeholder="Phone Number" required="required" maxlength = "11">		
					</div>
					
  					<div class="form-group">
    					<label for="image">I.D. Photo</label>
    					<input type="file" required class="form-control-file" id="image" name="image">
  					</div>
						
					<div class="g-recaptcha brochure__form__captcha" data-sitekey="6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG"></div>

					<div class="form-group">
						<label class="form-check-label">
							<input type="checkbox" required="required">
							 I accept the <a href="#" type="button"  data-toggle="modal" data-target="#exampleModalLong">Terms of Use</a> &amp; 
							 <a href="#" type="button" data-toggle="modal" data-target="#exampleModalLong">Privacy Policy</a>
						</label>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block login-btn">Sign up</button>
					</div>
			</div>
			<div class="modal-footer"> Already have an Account?
				<a href="#" data-target="#myModal" class="trigger-btn nav-link  mr-4" data-toggle="modal" data-dismiss="modal" aria-label="Close">Login here</a>
			</div>
		</div>
	</div>
</div>
<!-- TOS Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Terms of use and Privacy Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>1.Terms of Use</strong>
		<h6><b>Conditions of use</b></h6>
		<p>By using this website, you certify that you have read and reviewed this Agreement and that you agree to comply with its terms. If you do not want to be bound by the terms of this Agreement, you are advised to leave the website accordingly. Accounts are needed to make a reservation to this website, if you don’t have an account you can only view the website's Amenities. its services to those who have accepted its terms.</p>
		<h6><b>Privacy Policy</b></h6>
		<p>We advise you to read our privacy policy regarding our users’ privacy. It will help you better understand our Website, and according to Philippines law in 2012 the Data Privacy Act comprehensive and strict privacy legislation “to protect the fundamental human right of privacy, of communication while ensuring free flow of information to promote innovation and growth. That law is Republic Act. No. 10173, Ch. 1, Sec. 2. </p>
		<h6><b>Intellectual property</b></h6>
		<p>You agree that all services provided on this website are the property of CLICK to RES a online reservation system for almon water park , its affiliates, Admins, , employees, staff, or licensors including all copyrights, trademarks, patents, and other intellectual property. </p>
		<h6><b>User accounts</b></h6>
		<p>As a user of this website, you may be asked to register and use a mobile banking accounts such as gcash. and provide private information. You are responsible for ensuring the accuracy of this information, and you are responsible for maintaining the safety and security of your identifying information. You are also responsible for all activities that occur under your account or password.</p>
		<br><p>If you think there are any possible issues regarding the security of your account on the website, inform us immediately so we may address it accordingly.</p>
		<br><p>We reserve all rights to terminate accounts, edit or remove reservations that are being cancelled.</p>
		<h6><b>Disputes</b></h6>
		<p>The website or the resort will not be liable to any law suit or unnecessary or un-president event that may cost harm to the customer.</p>
		<h6><b>Indemnification</b></h6>
		<p>You agree to indemnify customers and its affiliates and hold almon water park harmless against legal claims and demands that may arise from your use or misuse of our services. We reserve the right to select our own legal counsel. </p>
		<h6><b>Limitation on liability</b></h6>
		<p>CLICK TO RES is not liable for any damages that may occur to the user as a result of misuse of our website.</p><br>
		<p>Users reserves the right to edit, modify, and change this Agreement any time. We let our users know of these changes through electronic mail. This Agreement is an understanding between CLICK TO RES and the user, and this supersedes and replaces all prior agreements regarding the use of this website.</p>
		<h6><b>Payment</b></h6>
		<p>The use agrees to any payment conditions. If the users wants to cancel their reservation the user are compensated  with 5% of agreed payment.</p><br>
		<strong>2.Privacy policy</strong>
		<p>Philippines law in 2012 the Data Privacy Act comprehensive and strict privacy legislation “to protect the fundamental human right of privacy, of communication while ensuring free flow of information to promote innovation and growth. That law is Republic Act. No. 10173, Ch. 1, Sec. 2. </p>
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form> 
<?php
	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$bday = $_POST['bday'];
		$gender = $_POST['gender'];
		$number = $_POST['number'];
		$reservation = "none";
	
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

        $num_pattern = "/^09[0-9]+$/";
        if (preg_match($num_pattern, $number) == 1) {
            $log3 = "User entered invalid number";
            $number_validation = "invalid" ;
        }
        elseif ($number != 11) {
            $log3 = "User entered invalid number";
            $number_validation = "invalid" ;
        }
        else{
            $log3 = "User entered valid number";
            $number_validation = "valid" ;
        } 

        if ($gender == "male" || $gender == "female" || $gender == "other") {
            $log4 = "Sign up: User entered valid gender";
            $gender_validation = "valid";
        }
        else{
            $log4 = "User entered invalid gender";
            $gender_validation = "invalid";
        }

        $email_pattern = "/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z\d]+\.[a-zA-Z\.]+$/";
        if (preg_match($email_pattern, $email)) {
            $log5 = "User entered valid email";
            $email_validation = "valid";
        }
        else{
            $log5 = "User entered invalid email";
            $email_validation = "invalid";
        }

                
        $password_pattern = "/^.{5,10}$/";
        if (preg_match($password_pattern, $password) == 0) {
            $log6 = "User entered invalid password";
            $password_validation = "invalid";
        }
        else{
            $log6 = "User entered valid password";
            $password_validation = "valid";
        }


        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

		$log = "Sign up: " . $log1 . " and " . $log2 . " and " . $log3 . " and " . $log4 . " and " . $log5 . " and " . $log6;
        logger($log);
		
		//Inserting data onto databasee :)
		if ($fname_validation == "valid" && $lname_validation == "valid" && $gender_validation == "valid" && $email_validation == "valid" && $password_validation == "valid" && $captcha_validation =="valid") {

			$hashed_password = md5($password); //hashing method md5 and same in login page


			$insert_into_db = mysqli_query($con, "INSERT INTO tbl_user (email, password, fname, lname, bday, gender, number, image, reservation) VALUES ('$email', '$hashed_password', '$fname', '$lname', '$bday', '$gender', '$number', '$image', '$reservation')");
			
			//parameters of mysqli_query();
			//connection - $con
			//database query - ......
			if (!$insert_into_db) {
				die("unable to save!");
			}
			else{
				echo "<script>alert('Successfully Created an Account, Please Login using Email and Password.');window.location.href='index.php'</script>";

			}
		}
		else{
			echo "<script>alert('There's Something Wrong with the input.');window.location.href='index.php'</script>";
		}

	}
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>



<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

<div class="container">
  <div class="row">
	<div class="col-lg-6 d-flex flex-column justify-content-center">
	  <h1 data-aos="fade-up">Almon Waterpark</h1>
	  <h2 data-aos="fade-up">ClicktoRes. An online reservation system made for Almon Waterpark.</h2>
	  <div data-aos="fade-up">
		<div class="text-center text-lg-start">
		  <a href="#pricing" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
			<span>Get Started</span>
			<i class="bi bi-arrow-right"></i>
		  </a>
		</div>
	  </div>
	</div>
	<div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
	  <img src="img/glass.jpg" class="img-fluid rounded" alt="">
	</div>
  </div>
</div>
</section><!-- End Hero -->

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up">
            <div class="content">
              <h3>Almon Waterpark</h3>
              <h2>Reservations are now easier than ever, no need to wait for long queueing lines.</h2>
              <p>
                Almon Waterpark's online reservation system. This will let users reserve their swimming plans at the comfort of your home.
              </p>
              <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" >
            <img src="img/6515.jpg" class="img-fluid rounded" alt="">
          </div>

        </div>
      </div>
    </section><!-- End About Section -->
</main>

<!-- ======= Counts Section ======= -->
<section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_rating WHERE happy LIKE '1'");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_reservation");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Reservations</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_user");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Registered Users</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people" style="color: #bb0852;"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_admin");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Admins</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

<!-- ======= Pricing Section ======= -->
<section id="pricing" class="pricing">

<div class="container" data-aos="fade-up">

  <header class="section-header">
	<h2>Pricing</h2>
	<p>Check our Pricing</p>
  </header>

  <div class="row gy-4" data-aos="fade-left">

	<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
	  <div class="box">
	  <span class="featured">Discount</span>
		<h3 style="color: #07d5c0;">Entrance Fee</h3>
		<sup><span>from</span></sup>
		<div class="price"><sup>₱</sup>
			<?php 
				$select = mysqli_query($con, "SELECT * FROM tbl_pricing");
				while($rows = mysqli_fetch_assoc($select)){
					$day = $rows['day'];
					echo $day;
				}
			?>
		</div>
		<img src="img/undraw_in_the_pool_c5h0.png" class="img-fluid" alt="">
		<ul>
		  <li>Day Swimming</li>
		  <li>Night Swimming</li>
		  <li class="na">WiFi Access</li>
		  <li class="na">Room Access</li>
		  <li class="na">Garage</li>
		</ul>
		<a href="#myModal" class="btn-buy trigger-btn nav-link  mr-4" data-toggle="modal">Reserve Now</a>
	  </div>
	</div>

	<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
	  <div class="box">
		<h3 style="color: #65c600;">Cottages</h3>
		<sup><span>from</span></sup>
		<div class="price"><sup>₱</sup>
			<?php 
				$select = mysqli_query($con, "SELECT * FROM tbl_pricing");
				while($rows = mysqli_fetch_assoc($select)){
					$cottage1 = $rows['cottage1'];
					echo $cottage1;
				}
			?>
		</div>
		<img src="img/undraw_select_house_qbag.png" class="img-fluid" alt="">
		<ul>
		  <li>Day Swimming</li>
		  <li>Night Swimming</li>
		  <li>WiFi Access</li>
		  <li>Room Access</li>
		  <li class="na">Garage</li>
		</ul>
		<a href="#myModal" class="btn-buy trigger-btn nav-link  mr-4" data-toggle="modal">Reserve Now</a>
	  </div>
	</div>

	<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
	  <div class="box">
		<h3 style="color: #ff901c;">Air-Conditioned Room</h3>
		<sup><span>from</span></sup>
		<div class="price"><sup>₱</sup>
			<?php 
				$select = mysqli_query($con, "SELECT * FROM tbl_pricing");
				while($rows = mysqli_fetch_assoc($select)){
					$acroom1 = $rows['acroom1'];
					echo $acroom1;
				}
			?>
		</div>
		<img src="img/undraw_at_home_octe.png" class="img-fluid" alt="">
		<ul>
		  <li>Day Swimming</li>
		  <li>Night Swimming</li>
		  <li>WiFi Access</li>
		  <li>Room Access</li>
		  <li class="na">Garage</li>
		</ul>
		<a href="#myModal" class="btn-buy trigger-btn nav-link  mr-4" data-toggle="modal">Reserve Now</a>
	  </div>
	</div>

	<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
	  <div class="box">
		<h3 style="color: #ff0071;">Drive-in</h3>
		<sup><span>from</span></sup>
		<div class="price"><sup>₱</sup>
			<?php 
				$select = mysqli_query($con, "SELECT * FROM tbl_pricing");
				while($rows = mysqli_fetch_assoc($select)){
					$drivein1 = $rows['drivein1'];
					echo $drivein1;
				}
			?>
		</div>
		<img src="img/undraw_city_driver_re_0x5e.png" class="img-fluid" alt="">
		<ul>
		  <li>Day Swimming</li>
		  <li>Night Swimming</li>
		  <li>WiFi Access</li>
		  <li>Room Access</li>
		  <li>Garage</li>
		</ul>
		<a href="#myModal" class="btn-buy trigger-btn nav-link  mr-4" data-toggle="modal">Reserve Now</a>
	  </div>
	</div>
  </div>
</div>

</section><!-- End Pricing Section -->
<!-- ABOUT
	<div class="container-lg">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-title">FAQs</h1>
			<div class="accordion" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="clearfix mb-0">
							<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> What is Bootstrap Framework?</a>									
						</h2>
					</div>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum id metus ac nisl bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet sagittis. In tincidunt orci sit amet elementum vestibulum.</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> How to Create Responsive Website with Bootstrap?</a>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> Does Bootstrap Framework Provide Cross-browser Support?</a>                     
						</h2>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum id metus ac nisl bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet sagittis. In tincidunt orci sit amet elementum vestibulum.</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingFour">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> Can I Use Bootstrap for Mobile App Development?</a>                               
						</h2>
					</div>
					<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
						<div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->



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