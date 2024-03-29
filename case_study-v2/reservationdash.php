<?php 
    //Site key 6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG
    //Server/secret key 6LcT3tUaAAAAAELJ9s7fbxkED1ncR7FUJtSQPgxK
    include("database.php");

    session_start();
    $select = mysqli_query($con, "SELECT * FROM tbl_admin WHERE admin_id = '$_SESSION[admin_id]' AND admin_password = '$_SESSION[admin_password]'");
    $count = mysqli_num_rows($select);
    if ($count == 0) {
        header("location:adminlogin.php");
        //echo "<td>" . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . "</td>"; 
    }
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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Almon Waterpark</title>
    <style>
        body {
          margin: 0;
          font-family: "Lato", sans-serif;
        }

        .sidebar {
          margin-right: 0;
          padding: 0;
          width: 200px;
          background-color: #f1f1f1;
          position: fixed;
          height: 100%;
          overflow: auto;
        }

        .sidebar a {
          display: block;
          color: black;
          padding: 16px;
          text-decoration: none;
        }
         
        .sidebar a.active {
          background-color: #555;
          color: white;
        }

        .sidebar a:hover:not(.active) {
          background-color: #555;
          color: white;
        }

        div.content {
          margin-left: 200px;
          padding: 1px 16px;
          
        }

        @media screen and (max-width: 700px) {
          .sidebar {
            width: 100%;
            height: auto;
            position: relative;
          }
          .sidebar a {float: left;}
          div.content {margin-left: 0;}
        }

        @media screen and (max-width: 400px) {
          .sidebar a {
            text-align: center;
            float: none;
          }
        }
        table,
         th,
         td {
           padding: 10px;
           border: 1px solid black;
           border-collapse: collapse;
         }
        

    </style>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
         <div class="container">
             <a href="admindashboard.php" class="navbar-brand mb-0 h1"><img class="d-inline-block align-top" src="pics/logo1.png" width="230" height="35"></a>
             
             <center>
             <form class="d-flex">
                
                 <span class="material-icons md-36">admin_panel_settings</span>
                   <div class="dropdown">
                     <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                       <?php 
                            echo "<td>" . $_SESSION['admin_fname'] . " " . $_SESSION['admin_lname'] . "</td>"; 
                         ?>
                     </button>
                     <div class="dropdown-menu">
                       <a class="dropdown-item" href="myaccount.php">View Account</a>
                       <a class="dropdown-item" href="reservationstatus.php">View Dashboard</a>
                       <h5 class="dropdown-header">Sign out</h5>
                       <a class="dropdown-item material-icons md-36" href="adminlogout.php">logout</a>
                     </div>
                   </div>
             </form>
             </center>
         </div>
         </nav> <br><br><br><br>

         <div class="sidebar mr-5">
           <a href="admindashboard.php" href="#home">Admin Dashboard</a>
           <a href="userdash.php">Users Dashboard</a>
           <a href="reservationdash.php" class="active" >Reservations</a>
           <a href="paymentdash.php">Payments</a>
         </div>

         <div class="content container">
            <center>
                <span><h1>List of Reservations<h1></span>
                <table>
                    <tr>
                       <th>Reservation ID</th>
                       <th>Reservation Date</th>
                       <th>Type</th>
                       <th>Room/Cottage</th>
                       <th>People</th>
                       <th>Adult</th>
                       <th>Kid</th>
                       <th>Senior Citizen</th>
                       <th>User ID</th>
                       <th>Payment ID</th> 
                    </tr>
                    <tr>
                        <?php 
                            $select = mysqli_query($con, "SELECT * FROM tbl_reservations");
                            while ($row = mysqli_fetch_assoc($select)) {
                                    echo "<tr>";
                                    echo "<td class='td'>". $row['reservation_id'] . '</td>';
                                    echo "<td class='td'>". $row['reservation_date'] . '</td>';
                                    echo "<td class='td'>". $row['reservation_type'] . '</td>';
                                    echo "<td class='td'>". $row['reservation_roomcottage'] . '</td>';
                                    echo "<td class='td'>". $row['reservation_people'] . '</td>';
                                    echo "<td class='td'>". $row['reservation_adult'] . '</td>';
                                    echo "<td class='td'>". $row['reservation_kid'] . '</td>';
                                    echo "<td class='td'>". $row['reservation_seniorcitizen'] . '</td>';
                                    echo "<td class='td'>". $row['user_id'] . '</td>';
                                    echo "<td class='td'>". $row['payment_id'] . '</td>';

                                    echo "<td class='td'>". "<a href = 'userdash.php?view=$row[user_id]'><button class = 'btn btn-success'>View</button>" . '</td>';
                                    echo "<td class='td'>". "<a href = 'userdash.php?id=$row[user_id]'><button class = 'btn btn-primary'>Edit</button>" . '</td>';
                                    echo "<td class='td'>". "<a href = 'userdash.php?del=$row[user_id]'><button class = 'btn btn-danger'>Delete</button>" . '</td>';
                                    echo "</tr>";
                            }
                         ?>
                                    </tr>
                                </table>
                            </center>
                         </div>

                             <?php 
                        if (isset($_GET['id'])) {
                            $editid = $_GET['id'];
                            $select = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id = '$editid'");
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?><br>
                                <h1 class="w3-animate-bottom" style="font-weight: bolder;">Edit User Details</h1>
                                <form method="POST" enctype="multipart/form-data">
                                        <center>

                                        <table  class="w3-animate-opacity">
                                            <tr>
                                                <td><label>Username</label> </td>
                                                <td><input type="text" name="user_id" required="" maxlength="10"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Password</label> </td>
                                                <td><input type="password" name="user_password" required="" maxlength="10"></td>
                                            </tr>
                                            <tr>
                                                <td><label>First Name</label> </td>
                                                <td><input type="text" name="user_fname" required="" maxlength="20"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Last Name</label> </td>
                                                <td><input type="text" name="user_lname" required="" maxlength="20"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Age</label> </td>
                                                <td><input type="text" name="user_age" required="" maxlength="2"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                    <label>Gender</label>
                                                </td>
                                                <td>
                                                    <select name="user_gender" required="">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                    </div>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td><label>Email</label> </td>
                                                <td><input type="text" name="user_email" required="" maxlength="255"></td>
                                            </tr>
                                             <tr>
                                                <td><label>Number</label> </td>
                                                <td><input type="text" name="user_number" required="" maxlength="11"></td>
                                            </tr>
                                            <tr>
                                                <td><label>User I.D.</label> </td>
                                                <td><input type="file" name="image" id="image" required=""></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="g-recaptcha brochure__form__captcha" data-sitekey="6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" name="submit" value="Update"></td>
                                            </tr>
                                        </table>
                                        
                                    </form>
                                        </center>
                                    </div>
                        <?php  
                        include ("logfunc.php");

                        if (isset($_POST['submit'])) {
                            $user_fname = $_POST['user_fname'];
                            $user_lname = $_POST['user_lname'];
                            $user_age = $_POST['user_age'];
                            $user_email = $_POST['user_email'];
                            $user_number = $_POST['user_number'];
                            $user_gender = $_POST['user_gender'];
                            $user_id = $_POST['user_id'];
                            $user_password = $_POST['user_password'];

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
                            if (preg_match($names_pattern, $user_fname) == 1) {  
                                $log1 = "User entered invalid first name";
                                $fname_validation = "invalid";
                            }
                            elseif(strlen($user_fname) > 20 || strlen($user_fname) < 2){
                                $log1 = "User entered invalid first name";
                                $fname_validation = "invalid";
                            }
                            else{
                                $log1 = "User entered valid first name";
                                $fname_validation = "valid";
                            }
                            if (preg_match($names_pattern, $user_lname) == 1) {  
                                $log2 = "User entered invalid last name";
                                $lname_validation = "invalid";
                            }
                            elseif(strlen($user_lname) > 20 || strlen($user_lname) < 2){
                                $log2 = "User entered invalid last name";
                                $lname_validation = "invalid";
                            }
                            else{
                                $log2 = "User entered valid last name";
                                $lname_validation = "valid";
                            }

                            $age_pattern = "/^[a-zA-Z]|\s+$/";
                            if (preg_match($age_pattern, $user_age) == 1) {
                                $log3 = "User entered invalid age";
                                $age_validation = "invalid";
                            }
                            elseif(strlen($user_age) > 2 || strlen($user_age) < 1){
                                $log3 = "User entered invalid age";
                                $age_validation = "invalid";
                            }
                            else{
                                $log3 = "User entered valid age";
                                $age_validation = "valid";
                            }

                            $num_pattern = "/^09[0-9]+]$/";
                            if (preg_match($num_pattern, $user_number) == 1) {
                                $log4 = "User entered invalid number";
                                $number_validation = "invalid" ;
                            }
                            elseif ($user_number != 11) {
                                $log4 = "User entered invalid number";
                                $number_validation = "invalid" ;
                            }
                            else{
                                $log4 = "User entered valid number";
                                $number_validation = "valid" ;
                            } 

                            if ($user_gender == "male" || $user_gender == "female" || $user_gender == "other") {
                                $log5 = "Sign up: User entered valid gender";
                                $gender_validation = "valid";
                            }
                            else{
                                $log5 = "User entered invalid gender";
                                $gender_validation = "invalid";
                            }

                            $email_pattern = "/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z\d]+\.[a-zA-Z\.]+$/";
                            if (preg_match($email_pattern, $user_email)) {
                                $log6 = "User entered valid email";
                                $email_validation = "valid";
                            }
                            else{
                                $log6 = "User entered invalid email";
                                $email_validation = "invalid";
                            }

                            $username_pattern = "/^.{5,10}$/";
                            if (preg_match($username_pattern, $user_id) == 0) {
                                $log7 = "User entered invalid username";
                                $username_validation = "invalid";
                            }
                            else{
                                $log7 = "User entered valid username";
                                $username_validation = "valid";
                            }
                            
                            $password_pattern = "/^.{5,10}$/";
                            if (preg_match($password_pattern, $user_password) == 0) {
                                $log8 = "User entered invalid password";
                                $password_validation = "invalid";
                            }
                            else{
                                $log8 = "User entered valid password";
                                $password_validation = "valid";
                            }

                           $user_image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

                               


                            

                            $log = "Sign up: " . $log1 . " and " . $log2 . " and " . $log3 . " and " . $log4 . " and " . $log5 . " and " . $log6 . " and " . $log7 . " and " . $log8;
                            logger($log);

                            //Inserting data onto databasee :)
                            if ($fname_validation == "valid" && $lname_validation == "valid" && $age_validation == "valid" && $gender_validation == "valid" && $email_validation == "valid" && $username_validation == "valid" && $password_validation == "valid" && $captcha_validation =="valid") {

                                $hashed_password = md5($user_password); //hashing method md5 and same in login page
                                
                                $update = mysqli_query($con, "UPDATE tbl_users SET user_id='$user_id', user_password='$hashed_password', user_email='$user_email', user_fname='$user_fname', user_lname='$user_lname', user_age='$user_age', user_gender='$user_gender', user_number='$user_number', user_image='$user_image' WHERE user_id = '$_GET[id]'");
                                
                                //parameters of mysqli_query();
                                //connection - $con
                                //database query - ......
                                if (!$update) {
                                    die("unable to save!");
                                }
                                else{
                                   echo "<script>alert('Successfully Updated');window.location.href='userdash.php'</script>";

                                }
                            }
                            else{
                                echo "<script>alert('There's something wrong with your input);window.location.href='userdash.php'</script>";
                            }

                        }
                        } 

            ?>

                            
        <?php 
                }
            
        ?>
            <?php // if admin deletes an account
                if (isset($_GET['del'])) {
                    $deleteuser = $_GET['del'];
                    $delete = mysqli_query($con, "DELETE FROM tbl_users WHERE user_id = '$deleteuser'");
                                
                    echo "<script>alert('User Deleted');window.location.href='userdash.php'</script>";
                }
            ?>
                    
    

    
































    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

 
</body>
</html>