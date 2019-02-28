<?php


$css = "layout/css/";
$js  = "layout/js/";




//===== include header ========

include "includes/header.php" ;




//==== connect to database ======

$conn = mysqli_connect("localhost" , "root" , "" , "nah_news");

if(! $conn ){
    die ("couldn't connect ". mysql_error());
}

mysqli_query($conn , "set names 'utf8'");

?>