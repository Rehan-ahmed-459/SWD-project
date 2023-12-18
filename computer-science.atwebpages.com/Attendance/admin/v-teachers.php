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

        if(empty(mysqli_real_escape_string($con,$_POST['email']))){
          throw new Exception("Email cann't be empty.");
        }

          if(empty(mysqli_real_escape_string($con,$_POST['uname']))){
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

        $stmt = mysqli_prepare($con, "INSERT INTO admininfo (username, password, email, fname, phone, type) VALUES (?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $hashedPassword = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssssss", $_POST['uname'], $hashedPassword, $_POST['email'], $_POST['fname'], $_POST['phone'], $_POST['type']);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $success_msg = 'Signup Successfully!';
            } else {
                $error_msg = 'Error inserting data: ' . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $error_msg = 'Error preparing statement: ' . mysqli_error($con);
        }
  
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
<h1>All Teachers</h1>

<div class="content">

  <div class="row">
   
  <table class="table table=stripped table-hover">
        <thead>  
          <tr>
            <th scope="col">Teacher ID</th>
            <th scope="col">Name</th>
            <th scope="col">Department</th>
            <th scope="col">Email</th>
            <th scope="col">Course</th>
          </tr>
        </thead>

      <?php

        $i=0;
        $tcr_query = mysqli_query($con,"select * from teachers order by tc_id asc");
        while($tcr_data = mysqli_fetch_array($tcr_query)){
          $i++;

        ?>
          <tbody>
              <tr>
                <td><?php echo $tcr_data['tc_id']; ?></td>
                <td><?php echo $tcr_data['tc_name']; ?></td>
                <td><?php echo $tcr_data['tc_dept']; ?></td>
                <td><?php echo $tcr_data['tc_email']; ?></td>
                <td><?php echo $tcr_data['tc_course']; ?></td>
              </tr>
          </tbody>

          <?php } ?>
          
    </table>
    
  </div>
    

</div>

</center>

</body>
<!-- Body ended  -->

</html>
