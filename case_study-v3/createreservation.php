<?php 
    include 'database.php';
    session_start();
    error_reporting(0);
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


    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/icon.min.css">
    <link rel="stylesheet" type="text/css" href="demo/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="demo/css/ui.css"/>
    <link rel="stylesheet" type="text/css" href="dist/css/pignose.calendar.min.css"/>
    <script type="javascript" src="dist/js/pignose.calendar.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





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
			<a href="admindashboard.php" class="nav-item nav-link ">Dashboard</a>
            <a href="adminlist.php" class="nav-item nav-link ">Admins</a>
			<a href="adminuser.php" class="nav-item nav-link ">Users</a>
			<a href="adminreservation.php" class="nav-item nav-link active">Reservations</a>
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
					<a href="profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></a>
					<div class="dropdown-divider"></div>
					<a href="logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></a>
				</div>
			</div>
		</div>
	</div>
</nav>
	
<div id="wrapper" class="heroo align-items-center" data-aos="fade-down" data-aos-delay="200">
    <form class="form" method="POST" enctype="multipart/form-data">
    <div id="disabled-multiple-range" class="article">
        <div class="title">
            <h1><span>Create Reservation</span></h1>
            <h6 class="pt-3"><strong>Dates Available</strong></h6>
        </div>
        <div class=" justify-content-center d-flex">
            <div class="form-group">
		        <input type="email" class="form-control mb-3" name="email" placeholder="Email Address" required="required" maxlength="255">		
		    </div>

        </div>
        <div class="disabled-ranges-calendar" data-aos="fade-up"></div>
        <!-- Displays Selected date -->
        <!-- <div class="box"></div> -->
        <input type="text" class="box d-flex justify-content-center" name="test" placeholder="Please Select Date" readonly="readonly" required="required" data-aos="fade-up">

        <div class="justify-content-center d-flex pt-4" data-aos="fade-up">
            <div class="form-group col-md-4">
                <label for="inputState" class="justify-content-center d-flex"><strong>Select Entrance Type</strong></label>
                <select name="entrance_type" class="form-control">
                    <option value="error" selected>Choose...</option>
                    <option value="day">Day</option>
                    <option value="night">Night</option>
                    <option value="whole_day">Whole Day</option>
                </select>
            </div>
        </div>

        <div class="justify-content-center d-flex pt-4" data-aos="fade-up">
            <div class="form-group col-md-4">
                <label for="inputState" class="justify-content-center d-flex"><strong>Room/Cottage Type</strong></label>
                <select name="room_type" class="form-control">
                    <option value="none" selected>None</option>
                    <option value="cottage1">Small Cottage</option>
                    <option value="cottage2">Medium Cottage</option>
                    <option value="cottage3">Large Cottage</option>
                    <option value="acroom1">Air-Conditioned Room 6 hours</option>
                    <option value="acroom2">Air-Conditioned Room 12 hours</option>
                    <option value="acroom3">Air-Conditioned Room 24 hours</option>
                    <option value="drivein1">Drive-in 3 hours</option>
                    <option value="drivein2">Drive-in 12 hours</option>
                    <option value="drivein3">Drive-in 24 hours</option>
                </select>
            </div>
        </div>

        <div class="justify-content-center d-flex pt-4" data-aos="fade-up">
            <div class="form-group col-md-4">
                <label for="inputState" class="justify-content-center d-flex"><strong>Number of People</strong></label>
                <select name="people" class="form-control">
                    <option value="0">Choose...</option>
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState" class="justify-content-center d-flex"><strong>Number of Adult</strong></label>
                <select name="adult" class="form-control">
                    <option value="0" selected>Choose...</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>
        <div class="justify-content-center d-flex pt-4" data-aos="fade-up">
            <div class="form-group col-md-4">
                <label for="inputState" class="justify-content-center d-flex"><strong>Number of Kids</strong></label>
                <select name="kid" class="form-control">
                    <option value="0" selected>Choose...</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState" class="justify-content-center d-flex"><strong>Number of Senior Citizen</strong></label>
                <select name="senior" class="form-control">
                    <option value="0" selected>Choose...</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>
        <div class="form-group pt-1">     
            <button type="submit" name="next" class="btn-get-started btn btn-primary btn-lg box d-flex justify-content-center ">
                Make reservation
            </button>
		</div>
       
    </div>
 
                            


   

    </form>
    
</div>
<?php
    if (isset($_POST['next'])) {
        //$test = $_POST['test'];
        //echo $test;
        $date = $_POST['test'];
        $email = $_POST['email'];
        $entrance_type = $_POST['entrance_type'];
        $room_type = $_POST['room_type'];
        $people = $_POST['people'];
        $adult = $_POST['adult'];
        $kid = $_POST['kid'];
        $senior = $_POST['senior'];
        //echo $date . $entrance_type . $room_type . $people . $adult . $kid . $senior;

        if ($date == NULL) {
            $date_validation = "invalid";
        }
        else{
            $date_validation = "valid";
        }
        if ($entrance_type == "day" || $entrance_type == "night" || $entrance_type == "whole_day") {
            $entrance_validation = "valid";
        }
        else{
            $entrance_validation = "invalid";
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

        if ($room_type == "none" || $room_type == "cottage1" || $room_type == "cottage2" || $room_type == "cottage3" || $room_type == "acroom1" || $room_type == "acroom2" || $room_type == "acroom3" || $room_type == "drivein1" || $room_type == "drivein2" || $room_type == "drivein3") {
            $room_validation = "valid";
        }
        else{
            $room_validation = "invalid";
        }
        if ($people == "1" || $people == "2" || $people == "3" || $people == "4" || $people == "5" || $people == "6" || $people == "7" || $people == "8" || $people == "9" || $people == "10") {
            $people_validation = "valid";
        }
        else{
            $people_validation = "invalid";
        }
        if ($adult == "0" || $adult == "1" || $adult == "2" || $adult == "3" || $adult == "4" || $adult == "5" || $adult == "6" || $adult == "7" || $adult == "8" || $adult == "9" || $adult == "10") {
            $adult_validation = "valid";
        }
        else{
            $adult_validation = "invalid";
        }
        if ($kid == "0" || $kid == "1" || $kid == "2" || $kid == "3" || $kid == "4" || $kid == "5" || $kid == "6" || $kid == "7" || $kid == "8" || $kid == "9" || $kid == "10") {
            $kid_validation = "valid";
        }
        else{
            $kid_validation = "invalid";
        }
        if ($senior == "0" || $senior == "1" || $senior == "2" || $senior == "3" || $senior == "4" || $senior == "5" || $senior == "6" || $senior == "7" || $senior == "8" || $senior == "9" || $senior == "10") {
            $senior_validation = "valid";
        }
        else{
            $senior_validation = "invalid";
        }
        $tally = $adult + $kid + $senior;
        if ($people == $tally) {
            $tally_validation = "valid";
        }
        else{
            $tally_validation = "invalid";
        }

        $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
            while($rows = mysqli_fetch_assoc($select)){
                $price_day = $rows['day'];
				$price_night = $rows['night'];
                $price_whole = $rows['whole_day'];
                $price_day_kid = $price_day - 10;
                $price_night_kid = $price_night - 10;
                $price_whole_kid = $price_whole - 10;
                $price_day_senior =$price_day - (.20 * $price_day);
                $price_night_senior =$price_night - (.20 * $price_night);
                $price_whole_senior =$price_whole - (.20 * $price_whole);
                $sm_cottage = $rows['cottage1'];
                $md_cottage = $rows['cottage2'];
                $lg_cottage = $rows['cottage3'];
                $acroom1 = $rows['acroom1'];
                $acroom2 = $rows['acroom2'];
                $acroom3 = $rows['acroom3'];
                $drivein1 = $rows['drivein1'];
                $drivein2 = $rows['drivein2'];
                $drivein3 = $rows['drivein3'];
                $none = $rows['none'];
            } 
        
            if ($date_validation == "valid" && $entrance_validation == "valid" && $room_validation == "valid" && $people_validation == "valid" && $adult_validation == "valid" && $kid_validation == "valid" && $senior_validation == "valid" && $tally_validation =="valid" && $email_validation =="valid"){
                $reservation = "pending_unpaid";
                $insert_into_db = mysqli_query($con, "INSERT INTO tbl_reservation (date, entrance_type, room_type, people, adult, kid, senior, email, payment) VALUES ('$date', '$entrance_type', '$room_type', '$people', '$adult', '$kid', '$senior', '$email', '$reservation')");

               
                if (!$insert_into_db) {
                    die("unable to save!");
                }
                else{
                    // $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = '$_SESSION[email]'");
                    // while($rows = mysqli_fetch_assoc($select)){
                    //     $reservation_id = $rows['id'];
                    //     $reservation_insert = mysqli_query($con, "UPDATE tbl_user SET reservation_id = ('$reservation_id') WHERE email = '$_SESSION[email]'");
                    // }
                    echo "<script>window.location.href='adminreservation.php'</script>";
                }
            }
            else{
                echo "<script>alert('Error has occurred, Please check your input fields');window.location.href='adminreservation.php'</script>";
            
            }
    }
    
  
?>




<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
<script type="text/javascript" src="dist/js/pignose.calendar.full.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $(function () {
        $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);

        function onSelectHandler(date, context) {
            /**
             * @date is an array which be included dates(clicked date at first index)
             * @context is an object which stored calendar interal data.
             * @context.calendar is a root element reference.
             * @context.calendar is a calendar element reference.
             * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
             * @context.storage.events is all events associated to this date
             */

            var $element = context.element;
            var $calendar = context.calendar;
            var $box = $element.siblings('.box').show();
            var text = "";


            if (date[0] !== null) {
                text += date[0].format('YYYY-MM-DD');
            }

            if (date[0] !== null && date[1] !== null) {
                text += ' ~ ';
            }
            else if (date[0] === null && date[1] == null) {
                text += '';
            }

            if (date[1] !== null) {
                text += date[1].format('YYYY-MM-DD');
            }
            
            $box.val(text);
            
            
        }

        function onApplyHandler(date, context) {
            /**
             * @date is an array which be included dates(clicked date at first index)
             * @context is an object which stored calendar interal data.
             * @context.calendar is a root element reference.
             * @context.calendar is a calendar element reference.
             * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
             * @context.storage.events is all events associated to this date
             */

            var $element = context.element;
            var $calendar = context.calendar;
            var $box = $element.siblings('.box').show();
            var text = 'You applied date ';

            if (date[0] !== null) {
                text += date[0].format('YYYY-MM-DD');
            }

            if (date[0] !== null && date[1] !== null) {
                text += ' ~ ';
            }
            else if (date[0] === null && date[1] == null) {
                text += 'nothing';
            }

            if (date[1] !== null) {
                text += date[1].format('YYYY-MM-DD');
            }

            $box.text(text);
        }

       
        // Disabled Ranges Calendar.
        $('.disabled-ranges-calendar').pignoseCalendar({
            minDate: moment(),
            select: onSelectHandler,
            disabledRanges: [
                ['2016-10-05', '2016-10-21'],
                ['2016-11-01', '2016-11-07'],
                ['2016-11-19', '2016-11-21'],
                ['2016-12-05', '2016-12-08'],
                ['2016-12-17', '2016-12-18'],
                ['2016-12-29', '2016-12-30'],
                ['2017-01-10', '2017-01-20'],
                ['2017-02-10', '2017-04-11'],
                ['2017-07-04', '2017-07-09'],
                ['2017-12-01', '2017-12-25'],
                ['2018-02-10', '2018-02-26'],
                <?php 
                
                // $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = 'barcelogreison@gmail.com'");
                // while($rows = mysqli_fetch_assoc($select)){
                //     $date = $rows['date'];
                //     echo "['" . $date . "'".  ", '". $date ."'". "]";
                //     //echo "['2021-12-25', '2021-12-25']";
                // }
                //$test = mysqli_query($con, "SELECT COUNT(date) FROM tbl_reservation WHERE date='2021-12-25'");
                
                $reserved_db = mysqli_query($con, "SELECT date, COUNT(date) FROM tbl_reservation GROUP BY date HAVING COUNT(date) > 0 ");
                        while ($row = mysqli_fetch_assoc($reserved_db)) {
                            $date = $row['date'];
                            $count = $row['COUNT(date)'];
                            if ($count >= 10) {
                                echo "['" . $date . "'".  ", '". $date ."'". "],";
                            }
                        }
                ?>
            ]
        });


        // This use for DEMO page tab component.
        $('.menu .item').tab();
    });
    //]]>
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/prism.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/components/prism-javascript.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/components/prism-typescript.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/components/prism-json.min.js"></script>
<script type="text/javascript" src="https://twemoji.maxcdn.com/2/twemoji.min.js?2.5"></script>

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