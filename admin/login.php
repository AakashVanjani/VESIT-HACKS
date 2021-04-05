<?php
// this page is of admin-login

require('connec.inc.php');
require('functions.inc.php');
$msg='';

// if user had pressed submit button, retrieve his username&pass, check with DB.
if (isset($_POST['submit'])){
    $username = get_safe_value($con, $_POST['username']);
    $committee = get_safe_value($con, $_POST['committee']);
    $pass = get_safe_value($con, $_POST['password']);

    $sql1 = "select * from admin where username='$username' and password='$pass' and council_name='$committee'";
    $res1 = mysqli_query($con, $sql1);
    $count=mysqli_num_rows($res1);
    echo $count;
    if ($count>0){
        $row1 = mysqli_fetch_assoc($res1);
        $_SESSION['admin_login'] = 'yes';
        $_SESSION['admin_id'] = $row1['id'];
        $_SESSION['admin_name'] = $row1['username'];
        $_SESSION['admin_comm'] = $row1['council_name'];
        header('location:proposal.php?key=pending');      
        die();
      
      /*
      # to display council name on top of page.
        $show_sql = "select committee.com_name from committee,admin where committee.abbrv=admin.council_name";
        $res2 = mysqli_query($con, $shoq_sql);
        $row = mysqli_fetch_assoc($res2);
        #$_SESSION['CURRENT_COM'] = $row['com_name'];
      */
        #header('location:proposal.php?comm=' . $committee . '?key=pending');      
        #die();
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
                     
                     <label>Welcome to Admin Login !!</label><br><br>

                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="username" required>
                     </div>
                     <div class="form-group">
                        <label>Committee</label>
                        <input type="text" name="committee" class="form-control" placeholder="committee" required>
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