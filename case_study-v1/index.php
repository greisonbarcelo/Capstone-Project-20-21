<?php 
	include("database.php");
 ?>
<html>
<head>
	<title>Almon Waterpark</title>
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		#h1{
			padding: 20px; 
			color: black;
			border-radius: 9px; 
			text-align: center;
			font-size:30px;
		}
		#p1{
		text-align:justify;
		}
		#img{
		width: 350px; 
		height: 200px; 
		border-radius: 6px;
		border: 4px solid black;
		margin-left: 60px ;
		margin-right: 10px;
		margin-top:20px;
		}
	</style>
</head>
<body>
	<div class="w3-top">
	  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
	    <a href="#home" class="w3-bar-item w3-button">Almon Waterpark</a>
	    <!-- Right-sided navbar links. Hide them on small screens -->
	    <div class="w3-right w3-hide-small">
	      <a href="#about" class="w3-bar-item w3-button">About</a>
	      <a href="#roomscottage" class="w3-bar-item w3-button">Rooms & Cottages</a>
	      <a href="#amenities" class="w3-bar-item w3-button">Amenities</a>
	      <a href="login.php" class="w3-bar-item w3-button">Login</a>
	    </div>
	  </div>
	</div>
	
	<div id="home" class="w3-container w3-padding-32 w3-center"> <br> <br>
		<h3>Almon Waterpark Reservation System</h3>
		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
		<img src="pics/almon2.jpg" class="homepic w3-animate-opacity" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
		<div class="w3-padding-32">
		  <h4><b>Almon Waterpark</b></h4>
		  <h6><i>Beat the heat, reserve at Almon Waterpark now!</i></h6>
		  <p>Almon Waterpark reopens for summer fun! With the newest aquisition of certification to operate during the pandemic by reducing capacity and implementing safety precautions for COVID-19. Almon Waterpark now have an Online Reservation System. Reserve to Almon Waterpark to beat the heat with safety guaranteed from COVID-19 protocols! Almon Water Park opened in April, 2007 aiming to be one of the best family-friendly resorts in the Philippines. It features outdoor pools, covered pools, exciting super slides with multiple loops, family slides and the hi-speed, mind-numbing rampage slides. It also features shallow, child-friendly pools and interactive play area complete with kiddie slides and swings. Those seeking a little more peace and quiet can relax in the quiet, covered pools or even book the private pool area for ultimate private party. Have fun with the barkada in our numerous outdoor cottages or stay overnight in our airconditioned rooms or drive-in rooms.</p>
		</div>
	</div>
	  <hr>

	<div id="roomscottage" class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:0px"><br> <br>
		<h1>Rooms and Cottages</h1>

		<h3>Entrance Rates</h3>
		<div class="w3-row-padding w3-padding-16">
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/almon1.jpg" style="width:100%;" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Day Swimming</h3>
		      <h6 class="w3-opacity">From Php 130</h6>
		      <h6 class="w3-opacity">Child price Php 120</h6>
		      <h6 class="w3-opacity">Senior Citizen (20% off adult rates)</h6>
		    </div>
		  </div>

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/almon1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Night Swimming</h3>
		      <h6 class="w3-opacity">From Php 140</h6>
		      <h6 class="w3-opacity">Child price Php 130</h6>
		      <h6 class="w3-opacity">Senior Citizen (20% off adult rates)</h6>
		    </div>
		  </div> 
		</div>
		<hr>
		<h3>Cottage Rates</h3>

		<div class="w3-row-padding w3-padding-16">
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/smallcottage.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Small Cottage</h3>
		      <h6 class="w3-opacity">From Php 300</h6>
		    </div>
		  </div>
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/cottage1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Medium Cottage</h3>
		      <h6 class="w3-opacity">From Php 400</h6>
		    </div>
		  </div> 

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/cottagelarge.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Large Cottage</h3>
		      <h6 class="w3-opacity">From Php 600</h6>
		    </div>
		  </div> 
		</div>
		<hr>

		<h3>Room Rates</h3>
		<div class="w3-row-padding w3-padding-16">
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/room1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Air-Conditioned (6 hours)</h3>
		      <h6 class="w3-opacity">From Php 750</h6>
		    </div>
		  </div>

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/room1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Air-Conditioned (12 hours)</h3>
		      <h6 class="w3-opacity">From Php 1500</h6>
		    </div>
		  </div> 

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/room1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Air-Conditioned (24 hours)</h3>
		      <h6 class="w3-opacity">From Php 3000</h6>
		    </div>
		  </div> 

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/drivein1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Drive-in (3 hours)</h3>
		      <h6 class="w3-opacity">From Php 350</h6>
		    </div>
		  </div>

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/drivein1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Drive-in (12 hours)</h3>
		      <h6 class="w3-opacity">From Php 1500</h6>
		    </div>
		  </div> 

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/drivein1.jpg" style="width:100%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		      <h3>Drive-in (24 hours)</h3>
		      <h6 class="w3-opacity">From Php 2600</h6>
		    </div>
		  </div> 
		</div>
		<a href="login.php"><button class="w3-button w3-block w3-black w3-margin-bottom">Reserve Now</button></a>
	</div> <hr>

	<div id="amenities" class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:-10px"> <br><br>
		<h3>Amenities</h3>
		<div class="w3-row-padding w3-padding-16">
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/image1.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div>
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/image5.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div> 

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/image2.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div> 
		  <h4 style="text-align: center;">Variety of slides!</h4>
		</div>

		<div class="w3-row-padding w3-padding-16">
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/coveredpool1.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div>
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/pool1.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div> 

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/kidpool2.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div> 
		  <h4 style="text-align: center;">Covered and Open Pools for adults and kids!</h4>
		</div>

		<div class="w3-row-padding w3-padding-16">
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/image22.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div>
		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/drivein1.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div> 

		  <div class="w3-third w3-margin-bottom">
		    <img src="pics/cottage1.jpg" style="width:100%" height="50%" class ="w3-animate-opacity">
		    <div class="w3-container w3-white">
		    </div>
		  </div> 
		  <h4 style="text-align: center;">Rooms, Drive-in and Cottages!</h4>
		</div>
		<hr>
	</div> <br><br>

	<div id="aboutus" class="w3-container w3-padding-32 w3-center">
		<div class="w3-content" style="max-width:1100px">

		  <!-- About Section -->
		  <div class="w3-row w3-padding-64" id="about">
		    <div class="w3-col m6 w3-padding-large w3-hide-small">
		     <img src="pics/almon1.jpg" class="w3-round w3-image w3-animate-opacity" style="width: 550px; height: 530px;">
		    </div>

		    <div class="w3-col m6 w3-padding-large">
		      <h1 class="w3-center w3-animate-left">About Almon Waterpark</h1>
		      <p class="w3-large w3-animate-right">Almon Water Park opened in April 2007 aiming to be one of the best family-friendly resorts in the Philippines. It features outdoor pools, covered pools, exciting super slides with multiple loops, family slides and the high-speed, mind numbing rampage slides. It also features shallow, child-friendly pools and interactive play area complete with kiddie slides and swings. Those seeking a little more peace and quiet can relax in the quiet, covered pools or even book the private pool area for ultimate private party. Have fun with the barkada in our numerous outdoor cottages or stay overnight in our airconditioned rooms or drive-in rooms. What's in the name? Almon Water park was named after our parents, Alejandro and Monica. It was our father's vision to build a resort like this and we were fortunate enough to have the resources to make that vision into a reality. The resort is therefore dedicated to them and their vision of offering world-class resort facilities at a price that is very affordable to the ordinary Filipino.</p>
		    </div>
		  </div>
		  
		  <hr>

		  <div class="w3-row w3-padding-64" id="menu">
		    <div class="w3-col l6 w3-padding-large w3-center">
		      <h1 class="w3-center w3-animate-right">Opening Hours</h1><br>
		      <h4 class="w3-animate-left">Monday-Sunday</h4>
		      <p class="w3-text-grey w3-animate-right">08:00 - 18:00</p><br> 
		    </div>
		    
		    <div class="w3-col l6 w3-padding-large">
		      <img src="pics/gate1.jpg" class="w3-round w3-image w3-animate-opacity" style="width: 550px; height: 500px;">
		    </div>
		  </div>

		  <hr>

		<div class="w3-row w3-padding-64" id="about">
		    <div class="w3-col m6 w3-padding-large w3-hide-small">
		     <img src="pics/certificate1.jpg" class="w3-round w3-image w3-animate-opacity" style="width: 550px; height: 530px;">
		    </div>

		    <div class="w3-col m6 w3-padding-large">
		      <h1 class="w3-center w3-animate-right">Certification</h1> <br>
		      <p class="w3-large w3-animate-left">Almon Water Park has aquired certification to operate during the pandemic.</p>
		    </div>
		  </div>
		</div>
	</div> <hr>
	<h3>Almon Waterpark featured in PopTalk GMA 2017</h3>
	<video class="vid" poster="pics/almon2.jpg" controls>
		<source src="vids/almonwaterpark.mp4" type="video/mp4">
	</video>

</body>
<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
</html>