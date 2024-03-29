<?php 
	$con = mysqli_connect("localhost", "root", "", "reservation_system");

	if (!$con) {
		die("error");
	}
	//else{
	//	echo "established connection!";
	//}
	// parameters of mysqli_connect: 
	// servername - localhost
	// database username - root
	// database password - none
	// database name(optional) - reservation_system

 ?>