<?php
require('connec.inc.php');
require('functions.inc.php');
#print_r($_SERVER);

# header of admin-page.


# done to make sure that the only way to get in this page is by login & not by typing proposal.php in urls bar. 
#if user is loggedin, do nothing, else send him to login first.
if (isset($_SESSION['admin_login']) && $_SESSION['admin_login']!=''){
      
      // jis insan ne abhi login kia hai, uska username chahiye.
      $cur_user = $_SESSION['admin_name'];
      $curr_admin_com = $_SESSION['admin_comm'];
      

      #header('location:proposal.php');


}
else{
    header('location:login.php');
    die();
}


?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Portal</title>
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
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="manage_proposal.php" > Add a Proposal</a>
                  </li>

                  <?php
                  //(START) MEMBER SHOULD BE ADDED ONLY BY FACULTY HEAD 
                  # he can be faculty head if design==faculty head & i have cur user with me.

                  $sql = "select * from admin where username = '$cur_user' and designation='faculty head'";
                  #echo $sql;
                  $res = mysqli_query($con, $sql);
                  if (mysqli_num_rows($res)>0){
                     echo '<li class="menu-item-has-children dropdown">
                     <a href="add_member.php" > Add a Member</a>
                  </li>';
                  }
                  //(END) MEMBER SHOULD BE ADDED ONLY BY FACULTY HEAD 
                  ?>
                  

                  <li class="menu-item-has-children dropdown">
                     <a href="proposal.php?key=pending" > Pending Proposals</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="proposal.php?key=accepted" > Accepted Proposals</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="proposal.php?key=rejected" > Rejected Proposals</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="events.php?key=upcoming" > Upcoming Events</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="events.php?key=completed" > Completed Events</a>
                  </li>
              
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="Logo"></a>
                  <a class="navbar-brand hidden" href="index.html"><img src="images/logo2.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            
            
            <div class="top-centre">
                  <div>
                  <?php #echo "Hi, Admin" ?>
                  </div>
            </div>

            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?php echo $cur_user ?> </a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>