<?php
error_reporting(0);
include "connect.php";
ob_start();
include "../../session.php";
sessionStart();

if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true || !isset($_SESSION['role'])) {
  header('location: ../index.php');
  exit();
}

// check for specified roles
$allowedroles = ['student']; 
if (!in_array($_SESSION['role'], $allowedroles)) {
  // if user does not have the required role
  header('location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Attendance Management System</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../main.css">

</head>
<!-- head ended -->

<!-- body started -->
<body>

<!-- Menus started-->
<header>
  <?php include "stud_navbar.php"; ?>
<!-- <div class="navbar">
  <a href="index.php" style="text-decoration:none;">Home</a>
  <a href="students.php" style="text-decoration:none;">Students</a>
  <a href="report.php" style="text-decoration:none;">Report Section</a>
 <a href="account.php" style="text-decoration:none;">My Account</a> 
  <a href="../logout.php" style="text-decoration:none;">Logout</a>

</div> -->
  <h1>Attendance Management System</h1>
  

</header>
<!-- Menus ended -->

<center>

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="row">
    <div class="content">
    
    <img src="../img/att.png" width="400px" />

  </div>

</div>
<!-- Contents, Tables, Forms, Images ended -->

</center>

</body>
<!-- Body ended  -->

</html>
