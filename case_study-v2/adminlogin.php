<?php 
    //Site key 6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG
    //Server/secret key 6LcT3tUaAAAAAELJ9s7fbxkED1ncR7FUJtSQPgxK
    include("database.php");
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
</head>
<body>

    <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a href="adminlogin.php" class="navbar-brand mb-0 h1"><img class="d-inline-block align-top" src="pics/logo1.png" width="230" height="35"></a>
 
        <form class="d-flex">
            
            <span class="material-icons md-36">admin_panel_settings</span>
        </form>
    </div>
    </nav> <br><br><br><br>

    <div class="container">
        <form method="POST">
                <center>
                    <h1 class="w3-animate-opacity">Admin Log in</h1>

                <table  class="w3-animate-opacity">
                    <tr>
                        <td><label>Username</label> </td>
                        <td><input type="text" name="admin_id" required="" maxlength="10"></td>
                    </tr>
                    <tr>
                        <td><label>Password</label> </td>
                        <td><input type="password" name="admin_password" required="" maxlength="10"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="g-recaptcha brochure__form__captcha" data-sitekey="6LcT3tUaAAAAAEmfoTwwAkZdJ5eWZTCOKPsJs7IG"></div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Login"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a class="signz" href="signup.php">Don't have an Account? Sign up here</a></td>
                    </tr>
                </table>
                
            </form>
                </center>
            </div>
        </form>
        
        
    <?php 
        include ("logfunc.php");
        session_start(); //beginning of session

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
        
        if (isset($_POST['submit'])) {
            $admin_id = $_POST['admin_id'];
            $admin_password = $_POST['admin_password'];
            $recaptcha = $_POST['g-recaptcha-response'];
            $res = reCaptcha($recaptcha);
            if(!$res['success']){
              $captcha_validation = "invalid";
            }
            else{
                $captcha_validation = "valid";
            }

            $username_pattern = "/^.{5,10}$/";
            if (preg_match($username_pattern, $admin_id) == 0) {
                $log1 = "User entered invalid username";
                
                $username_validation = "invalid";
            }
            else{
                $log1 = "User entered valid username";
                $username_validation = "valid";
            }
            $password_pattern = "/^.{5,10}$/";
            if (preg_match($password_pattern, $admin_password) == 0) {
                $log2 = "User entered invalid password";
                $password_validation = "invalid";
            }
            else{
                $log2 = "User entered valid password";
                $password_validation = "valid";
            }
            //adds all logs and combines them into logs.txt same with signup.php to keep track of user activities :))
            $log = "Log in: " . $log1 . " and " . $log2;
            logger($log);

            $hashed_password = md5($admin_password); //hashing method md5 and same in signup page

            if ($username_validation == "valid" && $password_validation == "valid" && $captcha_validation == "valid") {
                $select = mysqli_query($con, "SELECT * FROM tbl_admin WHERE admin_id ='$admin_id'");
                $select2 = mysqli_query($con, "SELECT * FROM tbl_admin WHERE admin_password ='$hashed_password'");
                $select3 = mysqli_query($con, "SELECT * FROM tbl_admin WHERE admin_id ='$admin_id' AND admin_password ='$hashed_password'");

                while ($result = mysqli_fetch_array($select3)) { //for pulling out the information before starting session
                    $_SESSION['admin_fname'] = $result['admin_fname'];
                    $_SESSION['admin_lname'] = $result['admin_lname'];
                    $_SESSION['admin_age'] = $result['admin_age'];
                    $_SESSION['admin_gender'] = $result['admin_gender'];
                    $_SESSION['admin_email'] = $result['admin_email'];
                    $_SESSION['admin_id'] = $result['admin_id'];
                    $_SESSION['admin_password'] = $result['admin_password'];
                    $_SESSION['admin_number'] = $result['admin_number'];

                } 

                $count = mysqli_num_rows($select); //parameters: mysqli_query,
                $count2 = mysqli_num_rows($select2); //parameters: mysqli_query, 

                if ($count == 1) {
                    if ($count2 == 1) {
                        header("location:admindashboard.php");
                    }
                    else{
                        echo "<div class='alert alert-warning alert-dismissible fade show fixed-top'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <center>
                            <strong>Password Incorrect.</strong>
                            <div class='spinner-border'></div>
                            </center>
                          </div>";
                    }
                }
                else{
                    echo "<div class='alert alert-danger alert-dismissible fade show fixed-top'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <center>
                            <strong>Account does not exist.</strong>
                            <div class='spinner-border'></div>
                            </center>
                          </div>";
            }
                
        }
    }
    }
     ?>
































    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

 
</body>
</html>