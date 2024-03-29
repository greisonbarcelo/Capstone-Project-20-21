<?php 
    include 'database.php';
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
			<a href="#" class="nav-item nav-link active">Home</a>
			<a href="#about" class="nav-item nav-link">About</a>
			<a href="reserve.php" class="nav-item nav-link">Reserve</a>
			<a href="#pricing" class="nav-item nav-link">Pricing</a>
			<a href="#" class="nav-item nav-link">Contact</a>
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