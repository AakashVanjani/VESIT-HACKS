<?php

// connecting to database
$server = "localhost";
$username = "root";
$pass = "";
$database = "vesit_hacks";

session_start();
$con = mysqli_connect($server,$username,$pass,$database);

if(!$con){
    die("connection failed due to error: ". $con->connect_error);
}

define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecommerce_website/');
define('SITE_PATH','http://127.0.0.1/ecommerce_website/');

# isliye error ara hai kyuki mere folder ka naam php/ecom nai hai !!

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

?>