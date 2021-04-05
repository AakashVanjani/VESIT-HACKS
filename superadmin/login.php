<?php
// this page is of admin-login

require('connec.inc.php');
require('functions.inc.php');
$msg='';


// if user had pressed submit button, retrieve his username&pass, check with DB.
if (isset($_POST['submit'])){
    $username = get_safe_value($con, $_POST['username']);
    $pass = get_safe_value($con, $_POST['password']);
    echo $username."<br>";    #retrieve krke dekhre !
    echo $pass."<br>";

    $sql = "select * from superadmin where username='$username' and password='$pass'";
    #echo $sql;
    $res = mysqli_query($con, $sql);
    $count=mysqli_num_rows($res);
    echo $count;
    if ($count>0){
      $row = mysqli_fetch_assoc($res);
      $_SESSION['superadmin_login'] = 'yes';
      $_SESSION['superadmin_id'] = $row['id'];
      $_SESSION['superadmin_name'] = $row['username'];
      #echo $_SESSION['superadmin_name'];
      header('location:departments.php');     
      die();
    }
    else{
        $msg = "please enter correct login details";
    }

}

?>

<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>


   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method="post">
                     <div class="form-group">

                     <label>Welcome to Super-Admin Login !!</label><br><br>

                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
					</form>
                    <div class="field_error"><?php echo $msg ?></div>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>