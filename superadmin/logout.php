<?php

# remove the currently-logged in user.
session_start();
unset($_SESSION['CURRENT_SUPERADMIN']);
unset($_SESSION['SUPERADMIN_LOGIN']);
unset($_SESSION['SUPERADMIN_USERNAME']); 
header('location:login.php');
die();