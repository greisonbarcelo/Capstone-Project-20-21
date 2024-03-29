<?php 
    include 'database.php';
    session_start();
    $select = mysqli_query($con, "SELECT * FROM tbl_admin WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
    $count = mysqli_num_rows($select);
    if ($count == 0) {
        header("location:adminlogin.php");
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
	<a href="admindashboard.php" class="navbar-brand"><i class="fa fa-cube"></i>Almon<b>Waterpark</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="admindashboard.php" class="nav-item nav-link active">Dashboard</a>
            <a href="adminlist.php" class="nav-item nav-link">Admins</a>
			<a href="adminuser.php" class="nav-item nav-link">Users</a>
			<a href="adminreservation.php" class="nav-item nav-link">Reservations</a>
			<a href="adminpayment.php" class="nav-item nav-link">Payment</a>
            <a href="adminprice.php#" class="nav-item nav-link">Price</a>
		</div>
		
		<div class="navbar-nav ml-auto">

			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
				<i class="bi bi-person-check"></i>
					<?php 
                   		 $select = mysqli_query($con, "SELECT * FROM tbl_admin WHERE email = '$_SESSION[email]'");
							while($rows = mysqli_fetch_assoc($select)){
								$fname = $rows['fname'];
								echo $fname . " ";
								$lname = $rows['lname'];
								echo $lname;
							}  
                   	 ?> 
				<b class="caret"></b></a>
				<div class="dropdown-menu">
					<div class="dropdown-divider"></div>
					<a href="logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></a>
				</div>
			</div>
		</div>
	</div>
</nav>

<section class="herooo">
    <!-- ======= Counts Section ======= -->
<section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

      <div class="row gy-4">
        <div class="col-lg-12 col-md-12">
            <div class="count-box">
            <p><h1><b>Total Revenue</b></h1></p>
            <i class="pera" style="color: #15be56;">  </i><span>₱</span>
              <div>
                
                <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                    $result = mysqli_query($con, 'SELECT SUM(amount_paid) AS value_sum FROM tbl_payment'); 
                    $row = mysqli_fetch_assoc($result); 
                    $sum = $row['value_sum'];
                    echo $sum;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                
              </div>
            </div>
          </div>
        </div>

      <div class="row gy-4 pt-3 ">
        <div class="col-lg-4 col-md-4 ">
            <div class="count-box">
              <i class="bi bi-people" style="color: #4a8cfd"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_user");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Registered Users</p>
                <a href="adminuser.php"><strong><b>View</b></strong></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="count-box">
              <i class="bi bi-person-check" style="color: #bb0852;"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_admin");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Admins</p>
                <a href="adminlist.php"><strong><b>View</b></strong></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="count-box">
              <i class="bi bi-calendar-check" style="color: #15be56;"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_reservation");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Reservations</p>
                <a href="adminreservation.php"><strong><b>View</b></strong></a>
              </div>
            </div>
          </div>
        </div>

   
            
        
          <!-- <div class="col-lg-4 col-md-6">
            <div class="count-box">
              <i class="bi bi-calendar2-minus" style="color: orange;"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Pending Reservation</p>
                <a href=""><strong><b>View</b></strong></a>
              </div>
            </div>
          </div>
        
          <div class="col-lg-4 col-md-6">
            <div class="count-box">
              <i class="bi bi-calendar-x" style="color: red;"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Pending Refunds</p>
                <a href=""><strong><b>View</b></strong></a>
              </div>
            </div>
          </div> -->
     

        <div class="row pt-3">
            <div class="col-lg-6 col-md-6">
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
          <div class="col-lg-6 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-frown"></i>
              <div>
			  <span data-purecounter-start="0" data-purecounter-end="
				<?php 
                   	$select = mysqli_query($con, "SELECT * FROM tbl_rating WHERE sad LIKE '1'");
					   $num_rows = mysqli_num_rows($select);
					   echo $num_rows;
                 ?>
				" data-purecounter-duration="1" class="purecounter"></span>
                <p>Unsatisfied Clients</p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </section><!-- End Counts Section -->
</section>


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