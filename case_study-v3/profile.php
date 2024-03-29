<?php 
    include 'database.php';
	include ("logfunc.php");
    session_start();
    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
    $count = mysqli_num_rows($select);
    if ($count == 0) {
        header("location:index.php#myModal");
        //echo "<td>" . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . "</td>"; 
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
					<a href="profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></a>
					<a href="reserve.php" class="dropdown-item"><i class="fa fa-calendar-o"></i> Reserve</a></a>
					<div class="dropdown-divider"></div>
					<a href="logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></a>
				</div>
			</div>
		</div>
	</div>
</nav>
	

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

<div class="container">
  <div class="row">
	<div class="col-lg-6 d-flex flex-column justify-content-center">
	  <h1 data-aos="fade-up">
        <?php 
            $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email = '$_SESSION[email]'");
            while($rows = mysqli_fetch_assoc($select)){
                $fname = $rows['fname'];
                echo $fname . " ";
				$lname = $rows['lname'];
                echo $lname;
            } 
        ?> 
        <i class="avatar bi bi-person-circle"></i>
      </h1><br>
	  <h6 data-aos="fade-up"><b>
        <?php 
			$select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email = '$_SESSION[email]'");
            while($rows = mysqli_fetch_assoc($select)){
                $fname = $rows['fname'];
				$lname = $rows['lname'];
				$email = $rows['email'];
				$password = $rows['password'];
				$bday = $rows['bday'];
                $number = $rows['number'];
				$image = $rows['image'];
				$reservation = $rows['reservation'];
				$gender = $rows['gender'];
            } 


            echo "Reservation: " . $reservation . "<br><br>";
            echo "Email Address: " . $email . "<br><br>";
            function getAge($date) {
                return intval(date('Y', time() - strtotime($date))) - 1970;
                
            }
            echo "Age: " . " " . getAge($bday). " " . "years old" . "<br><br>";
            echo "Birth Date: " . $bday . "<br><br>"; 
            echo "Gender: " . $gender . "<br><br>";
            echo "Phone Number: " . $number . "<br><br>";
            
        ?>
      </b></h6>
      
	  <div data-aos="fade-up">
		<div class="text-center text-lg-start">
		  <a href="#myModal" data-toggle="modal" class=" trigger-btn nav-link btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
			<span>Edit your Profile</span>
			<i class="bi bi-pencil-square"></i>
		  </a>
		</div>
	  </div>
	</div>
	<div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
	  
        <?php  
            $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email = '$_SESSION[email]'");
            while($rows = mysqli_fetch_assoc($select)){
                $image = $rows['image'];
                if ($image == 0) {
                    echo "N/A";
                } else{
                    echo "<h3 data-aos='fade-up'><b>I.D. Photo:". "<br><b></h3>";
                    echo '<img src="data:image;base64,'.base64_encode($rows['image']).'" style="width: 400px; height: 400px;" class="img-fluid rounded" alt="">'; 
                } 
            }   
        ?>
	</div>
  </div>
</div>
</section><!-- End Hero -->

<!-- Modal HTML -->
<form class="form" method="POST" enctype="multipart/form-data">
	<div id="myModal" class="modal fade">
		<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<div class="avatar">
				<span class="material-icons md-light md-48">account_circle</span>
				</div>				
				<h4 class="modal-title">Edit Profile</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
                    <div class="form-group input-group">
						<input type="text" class="form-group form-control" name="fname" value="<?php echo $_SESSION['fname']; ?> " maxlength = "20">
						<input type="text" class="form-group form-control" name="lname" value="<?php echo $_SESSION['lname']; ?>"  maxlength = "20">	
					</div>
				<div class="form-group">
					<input type="text" class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>">		
				</div>
				<div class="form-group input-group" id="show_hide_password">
							<input type="password" class="form-control" name="password" value="<?php echo $_SESSION['password']; ?>"  maxlength="20">
							<div class="input-group-addon">
        						<a href=""><i class="fa fa-eye-slash pt-2 ml-3" aria-hidden="true"></i></a>
      						</div>	
						</div>
                <div class="form-group">
					<input name="bday" placeholder="Date of Birth" class="textbox-n form-control" type="text" value="<?php echo $_SESSION['bday']; ?>" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />		
				</div>
                <div class="form-group">
					<select name="gender" class="form-control select-form">
						<option value="$_SESSION['gender'];" aria-label="Disabled select example" ><?php echo $_SESSION['gender']; ?></option>
                		<option value="male">Male</option>
                		<option value="female">Female</option>
                		<option value="other">Other</option>
            		</select>		
				</div>
                <div class="form-group">
					<input type="tel" class="form-control" name="number" value="<?php echo $_SESSION['number']; ?>"  maxlength = "11">		
				</div>
                <div class="form-group">
    					<label for="image">I.D. Photo</label>
    					<input type="file" class="form-control-file" id="image" name="image">
  				</div>

				<div class="form-group pt-3">
					
					<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-lg btn-block login-btn" data-toggle="modal" data-target="#exampleModalCenter">
  					Update
				</button>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Save Changes?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to update your profile account?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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

        $num_pattern = "/^09[0-9]+]$/";
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
		if ($fname_validation == "valid" && $lname_validation == "valid" && $gender_validation == "valid" && $email_validation == "valid" && $password_validation == "valid") {

			$hashed_password = md5($password); //hashing method md5 and same in login page

			$insert_into_db = mysqli_query($con, "UPDATE tbl_user SET email='$email', password='$hashed_password', fname='$fname', lname='$lname', bday='$bday', gender='$gender', number='$number', image='$image' WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
			//parameters of mysqli_query();
			//connection - $con
			//database query - ......
			if (!$insert_into_db) {
				die("unable to save!");
			}
			else{
				echo "<div class='alert alert-success alert-dismissible fade show fixed-top'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<center>
				<strong>Successfully Updated Account</strong>
				<div class='spinner-border'></div>
				</center>
			  </div>";
			  header("Location: logout.php");

			}
		}
		else{
			echo "<script>alert('SUM TING WONG')</script>";
		}

	}
?>


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