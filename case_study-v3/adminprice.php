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
<style>
    .table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
    min-width: 100%;
}
.table-title h2 {
    margin: 8px 0 0;
    font-size: 22px;
}
.search-box {
    position: relative;        
    float: right;
}
.search-box input {
    height: 34px;
    border-radius: 20px;
    padding-left: 35px;
    border-color: #ddd;
    box-shadow: none;
}
.search-box input:focus {
    border-color: #3FBAE4;
}
.search-box i {
    color: #a0a5b1;
    position: absolute;
    font-size: 19px;
    top: 8px;
    left: 10px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child {
    width: 130px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}    
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 95%;
    width: 30px;
    height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 30px !important;
    text-align: center;
    padding: 0;
}
.pagination li a:hover {
    color: #666;
}	
.pagination li.active a {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 6px;
    font-size: 95%;
}    
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
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
			<a href="adminreservation.php" class="nav-item nav-link">Reservations</a>
			<a href="adminpayment.php" class="nav-item nav-link ">Payment</a>
            <a href="adminprice.php" class="nav-item nav-link  active">Price</a>
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

<section class="hero">
<div class="container-xl" data-aos="fade-up">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8 col-lg-9"><h1>Pricing </h1></div>
                    <div class="col-sm-4 col-lg-3">
    
                    </div>        
	</div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Day Swimming</th>
                        <th>Night Swimming</th>
                        <th>Whole Day</th>
                        <th>SM Cottage</th>
                        <th>MD Cottage</th>
                        <th>LG Cottage</th>
                        <th>AC Room 1</th>
                        <th>AC Room 2</th>
                        <th>AC Room 3</th>
                        <th>Drive In 1</th>
                        <th>Drive In 2</th>
                        <th>Drive In 3</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <form class="form" method="GET" enctype="multipart/form-data">
                <?php 
                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                    while ($row = mysqli_fetch_assoc($select)) {
                            echo "<tr>";
                            echo "<td class='td'>". $row['day'] . '</td>';
                            echo "<td class='td'>". $row['night'] .'</td>';
                            echo "<td class='td'>" . $row['whole_day']."</td>";
                            echo "<td class='td'>" . $row['cottage1']."</td>";
                            echo "<td class='td'>". $row['cottage2'] . '</td>';
                            echo "<td class='td'>". $row['cottage3'] . '</td>';
                            echo "<td class='td'>". $row['acroom1'] . '</td>';
                            echo "<td class='td'>". $row['acroom2'] . '</td>';
                            echo "<td class='td'>". $row['acroom3'] . '</td>';
                            echo "<td class='td'>". $row['drivein1'] . '</td>';
                            echo "<td class='td'>". $row['drivein2'] . '</td>';
                            echo "<td class='td'>". $row['drivein3'] . '</td>';
                            
                            echo " 
                            <td>
                                <a href='adminprice.php?edit=$row[id]' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                            </td>
                            ";
                            echo "</tr>";
                    }
                ?>
                </form>
                </tbody>
            </table>
    <?php
        
        if (($_GET['edit'])) {
            $edit = $_GET['edit'];
            $select = mysqli_query($con, "SELECT * FROM tbl_pricing WHERE id = '$edit'");
            while ($row = mysqli_fetch_assoc($select)) {
                $day = $row['day'];
                $night = $row['night'];
                $whole_day = $row['whole_day'];
                $cottage1 = $row['cottage1'];
                $cottage2 = $row['cottage2'];
                $cottage3 = $row['cottage3'];
                $acroom1 = ['acroom1'];
                $acroom2 = $row['acroom2'];
                $acroom3 = $row['acroom3'];
                $drivein1 = ['drivein1'];
                $drivein2 = $row['drivein2'];
                $drivein3 = $row['drivein3'];

                $select = mysqli_query($con, "SELECT * FROM tbl_pricing");
                        while($rows = mysqli_fetch_assoc($select)){
                            $day = $rows['day'];
                            $night = $rows['night'];
                            $whole_day = $rows['whole_day'];
                            $cottage1 = $rows['cottage1'];
                            $cottage2 = $rows['cottage2'];
                            $cottage3 = $rows['cottage3'];
                            $acroom1 = $rows['acroom1'];
                            $acroom2 = $rows['acroom2'];
                            $acroom3 = $rows['acroom3'];
                            $drivein1 = $rows['drivein1'];
                            $drivein2 = $rows['drivein2'];
                            $drivein3 = $rows['drivein3'];
                            $none = $rows['none'];

                            
    ?>
     <!-- EDIT Modal -->
     
     <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-login">
			<div class="modal-content">
				<div class="modal-header">
					<div class="avatar">
					<span class="material-icons md-light md-48">calendar_today</span>
					</div>				
					<h4 class="modal-title">Edit Pricing</h4>	
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
                <div class="modal-body">
                <form class="form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Day</label> <br>
                        <input type="number" name="day" value="
                        <?php
                            echo $day;
                        ?>		
                        ">
                        
                    </div>

                    <div class="form-group">
                    <label>Night</label><br>
                        <input type="number" name="night" value="
                        <?php
                            echo $night;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>Whole Day</label>
                        <input type="number" name="whole_day" value="
                        <?php
                            echo $whole_day;
                        ?>		
                        ">	
                    </div>
                    <div class="form-group">
                        <label>Small Cottage</label>
                        <input type="number" name="cottage1" value="
                        <?php
                            echo $cottage1;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>Medium Cottage</label>
                        <input type="number" name="cottage2" value="
                        <?php
                            echo $cottage2;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>Large Cottage</label>
                        <input type="number" name="cottage3" value="
                        <?php
                            echo $cottage3;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>AC Room 1</label>
                        <input type="number" name="acroom1" value="
                        <?php
                            echo $acroom1;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>AC Room 2</label>
                        <input type="number" name="acroom2" value="
                        <?php
                            echo $acroom2;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>AC Room 3</label>
                        <input type="number" name="acroom3" value="
                        <?php
                            echo $acroom3;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>Drive in 1</label>
                        <input type="number" name="drivein1" value="
                        <?php
                            echo $drivein1;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>Drive in 2</label>
                        <input type="number" name="drivein2" value="
                        <?php
                            echo $drivein2;
                        ?>		
                        ">		
                    </div>
                    <div class="form-group">
                        <label>Drive in 3</label>
                        <input type="number" name="drivein3" value="
                        <?php
                            echo $drivein3;
                        ?>		
                        ">		
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="update">Update</button>		
                    </div>
                    </form>
            </div>	
			</div>
		</div>
        <?php
                        }
            if (isset($_POST['update'])) {
                $day = $_POST['day'];
                $night = $_POST['night'];
                $whole_day = $_POST['whole_day'];
                $cottage1 = $_POST['cottage1'];
                $cottage2 = $_POST['cottage2'];
                $cottage3 = $_POST['cottage3'];
                $acroom1 = $_POST['acroom1'];
                $acroom2 = $row['acroom2'];
                $acroom3 = $row['acroom3'];
                $drivein1 = $_POST['drivein1'];
                $drivein2 = $_POST['drivein2'];
                $drivein3 = $_POST['drivein3'];

                    $select = mysqli_query($con, "SELECT * FROM tbl_pricing WHERE id = '$edit'");
                    while($rows = mysqli_fetch_assoc($select)){
                        $update = mysqli_query($con, "UPDATE tbl_pricing SET day='$day', night='$night', whole_day='$whole_day', cottage1='$cottage1', cottage2='$cottage2', cottage3='$cottage3', acroom1='$acroom1', acroom2='$acroom2', acroom3='$acroom3', drivein1='$drivein1', drivein2='$drivein2', drivein3='$drivein3'  WHERE id = '$edit'");
                        if (!$update) {
                            die("unable to save!");
                        }
                        else{
                            echo "<script>alert('Successfully Updated Prices.');window.location.href='adminprice.php'</script>";
                        }
                    }
                    
            }
        ?>
       
	</div>
    </div>

    <?php } ?>
    <script type="text/javascript"> $('#editModal').modal('show'); </script>
    <?php 
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $bday = $_POST['bday'];
        $gender = $_POST['gender'];
        $number = $_POST['number'];
       
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
        if ($image == NULL) {
            $image_validation = "invalid";
        }
        else{
            $image_validation = "valid";
        }

        
        //Inserting data onto databasee :)
        if ($fname_validation == "valid" && $lname_validation == "valid" && $gender_validation == "valid" && $email_validation == "valid" && $password_validation == "valid" && $image_validation =="valid") {

            $hashed_password = md5($password); //hashing method md5 and same in login page

            $update = mysqli_query($con, "UPDATE tbl_admin SET email='$email', password='$hashed_password', fname='$fname', lname='$lname', bday='$bday', gender='$gender', number='$number', image='$image' WHERE id = '$edit'");

            //parameters of mysqli_query();
            //connection - $con
            //database query - ......
            if (!$update) {
                die("unable to save!");
            }
            else{
                echo "<script>alert('Successfully Updated an Account.');window.location.href='adminreservation.php'</script>";

            }
        }
        else{
            echo "<script>alert('There's Something Wrong with the input.');window.location.href='adminreservation.php'</script>";
        }
}} ?>
    </div>
    </div>
        </div>
    </div>  
</div>   
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


    