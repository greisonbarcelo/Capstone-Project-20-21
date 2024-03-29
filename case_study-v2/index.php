<?php 
    include("database.php");
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    

    <title>Almon Waterpark</title>
</head>
<body>

	</style>
    <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
    <div class="container">
    	<a href="index.php" class="navbar-brand mb-0 h1"><img class="d-inline-block align-top" src="pics/logo1.png" width="230" height="35"></a>
    	<button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
    		<span class="navbar-toggler-icon"></span>	
    	</button>
    	<div class="collapse navbar-collapse" id="navbarNav">
    		<ul class="navbar-nav">
    			<li class="nav-item active">
    				<a class="nav-link active" href="#home">Home</a>
    			</li>
    			<li class="nav-item active">
    				<a class="nav-link" href="#pricing">Pricing</a>
    			</li>
    			<li class="nav-item active">
    				<a class="nav-link" href="#amenities">Amenities</a>
    			</li>
    			<li class="nav-item active">
    				<a class="nav-link" href="#about">About</a>
    			</li>
    		</ul>
    	</div>
    	<form class="d-flex">
    		<a href="login.php"><button type="button" class="btn btn-outline-secondary ">Sign in</button></a>
            <span class="material-icons md-36">account_circle</span>
            
    	</form>
    </div>
    </nav> <br><br><br><br>
    
 	<div class="row w3-animate-top" id="home">
      <div class="col-xs-1 center-block">
        <center>
          <span><h3>Welcome to Almon Waterpark</h3></span>
        </center>
      </div>
    </div>
    <div>
        <center>
            <img src="pics/almon1.jpg" class="img-thumbnail img-fluid" alt="Almon Waterpark" width="600" height="100">
        </center>
    </div>
    <div>
        <div class="col-xs-1 center-block">
            <center>
                <span><b><h3>Almon Waterpark</h3></b></span>
                <span><i><h6>Beat the heat, reserve at Almon Waterpark now!</h6></i></span>
                <span class="container ">Almon Waterpark reopens for summer fun! With the newest aquisition of certification to operate during the pandemic by reducing capacity and implementing safety precautions for COVID-19. Almon Waterpark now have an Online Reservation System. Reserve to Almon Waterpark to beat the heat with safety guaranteed from COVID-19 protocols! Almon Water Park opened in April, 2007 aiming to be one of the best family-friendly resorts in the Philippines. It features outdoor pools, covered pools, exciting super slides with multiple loops, family slides and the hi-speed, mind-numbing rampage slides. It also features shallow, child-friendly pools and interactive play area complete with kiddie slides and swings. Those seeking a little more peace and quiet can relax in the quiet, covered pools or even book the private pool area for ultimate private party. Have fun with the barkada in our numerous outdoor cottages or stay overnight in our airconditioned rooms or drive-in rooms.</span>
            </center> <hr><br><br>
        </div>
    </div> 
    <br><br><br><br>
    <div class="row w3-animate-top" id="pricing">
      <div class="col-xs-1 center-block">
        <center>
          <span><h3>Pricing</h3></span>
          <span><h6>Entrance Rates</h6></span>
        </center>
      </div>
    </div>

    <div class="container">
            <center>
           <div class="row">
             <div class="col"></div>
             <div class="col">
               <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/almon2.jpg" width="350" height="300">
               <div>
                       <span><h5>Day Swimming</h5></span>
                       <span><h6>From Php 130</h6></span>
                       <span><h6>Child Php 120</h6></span>
                       <span><h6>Senior Citizen (20% off adult rates)</h6></span>
               </div>
             </div>
             <div class="col">
               <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/almon2.jpg" width="350" height="300">
               <div> 
                       <span><h5>Night Swimming</h5></span>
                       <span><h6>From Php 140</h6></span>
                       <span><h6>Child Php 130</h6></span>
                       <span><h6>Senior Citizen (20% off adult rates)</h6></span>
               </div>
             </div>      
             <div class="col"></div>
           </div><br>

           <div class="row w3-animate-top">
             <div class="col-xs-1 center-block">
               <center>
                 <span><h3>Cottage Rates</h3></span>
               </center>
             </div>
           </div>

               <div class="row">
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/smallcottage.jpg" width="350" height="300">
                       <div> 
                               <span><h5>Small Cottage</h5></span>
                               <span><h6>From Php 300</h6></span>
                       </div>
                   </div>
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/mediumcottage.jpg" width="350" height="300">
                       <div>
                               <span><h5>Medium Cottage</h5></span>
                               <span><h6>From Php 400</h6></span>
                       </div>
                   </div>
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/largecottage.jpg" width="350" height="300">
                       <div>
                               <span><h5>Large Cottage</h5></span>
                               <span><h6>From Php 600</h6></span>
                       </div>
                   </div>
               </div><br>

               <div class="row w3-animate-top">
                 <div class="col-xs-1 center-block">
                   <center>
                     <span><h3>Room Rates</h3></span>
                   </center>
                 </div>
               </div>

               <div class="row">
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/room1.jpg" width="350" height="300">
                       <div> 
                               <span><h5>Air-Conditioned (6 hours)</h5></span>
                               <span><h6>From Php 750</h6></span>
                       </div>
                   </div>
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/room1.jpg" width="350" height="300">
                       <div>
                               <span><h5>Air-Conditioned (12 hours)</h5></span>
                               <span><h6>From Php 1500</h6></span>
                       </div>
                   </div>
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/room1.jpg" width="350" height="300">
                       <div>
                               <span><h5>Air-Conditioned (24 hours)</h5></span>
                               <span><h6>From Php 3000</h6></span>
                       </div>
                   </div>
               </div><br>

               <div class="row">
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/room2.jpg" width="350" height="300">
                       <div> 
                               <span><h5>Drive-in (3 hours)</h5></span>
                               <span><h6>From Php 350</h6></span>
                       </div>
                   </div>
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/room2.jpg" width="350" height="300">
                       <div>
                               <span><h5>Drive-in (12 hours)</h5></span>
                               <span><h6>From Php 1500</h6></span>
                       </div>
                   </div>
                   <div class="col">
                       <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/room2.jpg" width="350" height="300">
                       <div>
                               <span><h5>Drive-in (24 hours)</h5></span>
                               <span><h6>From Php 2600</h6></span>
                       </div>
                   </div>
               </div><br>
               <div class="row"> 
                       <a href="login.php"><button type="button" class="btn btn-dark btn-block">Reserve Now!</button></a>
               </div>
           </center>
    </div> <br> <hr>


    <div class="row w3-animate-top" id="amenities">
      <div class="col-xs-1 center-block">
        <center>
          <span><h3>Amenities</h3></span>
        </center>
      </div>
    </div>
    <div class="container">
    <center>
        <div id="demo" class="carousel slide" data-ride="carousel">
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
            <li data-target="#demo" data-slide-to="3"></li>
            <li data-target="#demo" data-slide-to="4"></li>
            <li data-target="#demo" data-slide-to="5"></li>
            <li data-target="#demo" data-slide-to="6"></li>
            <li data-target="#demo" data-slide-to="7"></li>
          </ul>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="pics/amenities1.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Variety of slides!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="pics/amenities3.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Variety of slides!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="pics/pool1.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Covered and Open Pools for adults and kids!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="pics/pool2.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Covered and Open Pools for adults and kids!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="pics/pool3.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Covered and Open Pools for adults and kids!</p>
              </div>   
            </div>

            <div class="carousel-item">
              <img src="pics/pool3.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Covered and Open Pools for adults and kids!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="pics/room1.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Rooms, Drive-ins, and Cottages!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="pics/room2.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Rooms, Drive-ins, and Cottages!</p>
              </div>  
              <div class="carousel-item">
              <img src="pics/mediumcottage.jpg" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Almon Waterpark</h3>
                <p>Rooms, Drive-ins, and Cottages!</p>
              </div>   
            </div> 
            </div>
          </div>
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>

         <hr> <br><br>
   
   <div class="row w3-animate-top" id="about">
    <center>
     <div class="col-xs-1 center-block">
       
         <span><h3>About Almon Waterpark</h3></span>
     </div><br><br>
   </div>

   <div class="container">
       <div class="row">
           <div class="col-sm-4">
                <img class="rounded img-fluid" alt="Almon Waterpark" src="pics/almon2.jpg" width="350" height="800">
           </div>
           <div class="col-sm-8">
                <span><h6>Almon Water Park opened in April 2007 aiming to be one of the best family-friendly resorts in the Philippines. It features outdoor pools, covered pools, exciting super slides with multiple loops, family slides and the high-speed, mind numbing rampage slides. It also features shallow, child-friendly pools and interactive play area complete with kiddie slides and swings. Those seeking a little more peace and quiet can relax in the quiet, covered pools or even book the private pool area for ultimate private party. Have fun with the barkada in our numerous outdoor cottages or stay overnight in our airconditioned rooms or drive-in rooms. What's in the name? Almon Water park was named after our parents, Alejandro and Monica. It was our father's vision to build a resort like this and we were fortunate enough to have the resources to make that vision into a reality. The resort is therefore dedicated to them and their vision of offering world-class resort facilities at a price that is very affordable to the ordinary Filipino.</h6></span>
            
           </div>
       </div>
       </center>
   </div><br><hr>
<!--
   <section class="bg-dark text-light p-5 text-center">
       <div class="container">
           <div class="d-sm-flex">
               <div>
                <h1>Swim now</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
               <div class="pt-5">
                   <img class="img-fluid h-90 w-100" src="pics/official1.png">
               </div>
               
           </div>
       </div>
   </section>
-->





































    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

 
</body>
</html>