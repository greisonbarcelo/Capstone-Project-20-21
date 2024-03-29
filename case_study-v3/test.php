<?php
include 'database.php';
    session_start();
    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
    $count = mysqli_num_rows($select);
 $select = mysqli_query($con, "SELECT * FROM tbl_reservation WHERE email = 'barcelogreison@gmail.com'");
 $reserved_db = mysqli_query($con, "SELECT date, COUNT(date) FROM tbl_reservation GROUP BY date HAVING COUNT(date) > 0 ");
 while ($rows = mysqli_fetch_assoc($reserved_db)) {
     $date = $rows['date'];
     $count = $rows['COUNT(date)'];
     //echo $count . "<br>";
     if ($count >= 2) {
         echo $date;
     }
 }
?>