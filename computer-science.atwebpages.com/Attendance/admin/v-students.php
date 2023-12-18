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
$allowedroles = ['admin']; 
if (!in_array($_SESSION['role'], $allowedroles)) {
  // if user does not have the required role
  header('location: ../index.php');
  exit();
}
?>


<?php

//establishing connection
include('connect.php');

  try{

    //validation of empty fields
      if(isset($_POST['signup'])){

        if(empty($_POST['email'])){
          throw new Exception("Email cann't be empty.");
        }

          if(empty($_POST['uname'])){
             throw new Exception("Username cann't be empty.");
          }

            if(empty($_POST['pass'])){
               throw new Exception("Password cann't be empty.");
            }
              
              if(empty($_POST['fname'])){
                 throw new Exception("Username cann't be empty.");
              }
                if(empty($_POST['phone'])){
                   throw new Exception("Username cann't be empty.");
                }
                  if(empty($_POST['type'])){
                     throw new Exception("Username cann't be empty.");
                  }

        //insertion of data to database table admininfo
        $result = mysqli_query($con,"insert into admininfo(username,password,email,fname,phone,type) values('$_POST[uname]','$_POST[pass]','$_POST[email]','$_POST[fname]','$_POST[phone]','$_POST[type]')");
        $success_msg="Signup Successfully!";
  
  
  }
}
  catch(Exception $e){
    $error_msg =$e->getMessage();
  }

?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Attendance Management System</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<!-- head ended -->

<!-- body started -->
<body>

    <!-- Menus started-->
    <header>

      <div class="navbar">
        <a href="signup.php" style="text-decoration:none;">Create Users</a>
        <a href="index.php" style="text-decoration:none;">Add Student/Teacher</a>
        <a href="v-students.php" style="text-decoration:none;">View Students</a>
      <a href="v-teachers.php" style="text-decoration:none;">View Teachers</a>
        <a href="../logout.php" style="text-decoration:none;">Logout</a>
      </div>
      <h1>Attendance Management System</h1>

    </header>
    <!-- Menus ended -->

<center>
<h1>All Students</h1>

<div class="content">

  <div class="row">
   
    <table class="table table-striped table-hover">
      
        <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">Registration No.</th>
          <th scope="col">Name</th>
          <th scope="col">Department</th>
          <th scope="col">Batch</th>
          <th scope="col">Semester</th>
          <th scope="col">Email</th>
        </tr>
        </thead>
     <?php
       
       $i=0;
       
       $all_query = mysqli_query($con,"SELECT * from students ORDER BY st_id asc");
       $sno=0;
       while ($data = mysqli_fetch_array($all_query)) {
         $i++;
         $sno=$sno+1;
       
       ?>
  
       <tr>
         
         <td><?php echo $sno; ?></td>
         <td><?php echo $data['st_id']; ?></td>
         <td><?php echo $data['st_name']; ?></td>
         <td><?php echo $data['st_dept']; ?></td>
         <td><?php echo $data['st_batch']; ?></td>
         <td><?php echo $data['st_sem']; ?></td>
         <td><?php echo $data['st_email']; ?></td>
       </tr>
  
       <?php 
            } 
              
        ?>
      </table>
    
  </div>
    

</div>

</center>

</body>
<!-- Body ended  -->

</html>
