<?php 

$conn= mysqli_connect("localhost","root","","attendance");

if(!$conn){

   echo "<script>alert('Sorry Something Went Wrong With the Connection...')</script>";
}

?>