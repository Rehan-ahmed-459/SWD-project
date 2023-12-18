  <?php
  error_reporting(0);
include "connect.php";
  ob_start();
  include "../../session.php";
  sessionStart();

  //checking if the session is valid
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

  <?php include('connect.php');?>


<?php 
try{

         //checking form data and empty fields
          if(isset($_POST['done'])){

          if (empty($_POST['name'])) {
            throw new Exception("Name cannot be empty");
            
          }
              if (empty($_POST['dept'])) {
               
                throw new Exception("Department cannot be empty");
                
              }
                  if(empty($_POST['batch']))
                  {
                    throw new Exception("Batch cannot be empty");
                    
                  }
                      if(empty($_POST['email']))
                      {
                        throw new Exception("Email cannot be empty");
                        
                      }


  $sid = mysqli_real_escape_string($con,$_POST['id']);

  $stmt = mysqli_prepare($con, "UPDATE students SET st_name=?, st_dept=?, st_batch=?, st_sem=?, st_email=? WHERE st_id=?");
  if ($stmt) {  
      mysqli_stmt_bind_param($stmt, "sssssi", $_POST['name'], $_POST['dept'], $_POST['batch'], $_POST['semester'], $_POST['email'], $sid);
      $result = mysqli_stmt_execute($stmt);
      if ($result) {
          $success_msg = 'Updated successfully';
      } else {
          $error_msg = 'Error updating student information: ' . mysqli_stmt_error($stmt);
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
  
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  


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
   <a href="account.php" style="text-decoration:none;">My Account</a> -->
  <!-- <a href="../logout.php" style="text-decoration:none;">Logout</a> -->


  <center>

    <h1>Attendance Management System</h1>
  </center>

</header>
<!-- Menus ended -->

<!-- Content, Tables, Forms, Texts, Images started -->
<center>

<div class="row">
    <div class="content">

          <h3>Update Account</h3>
          <br>
          
          <!-- Error or Success Message printint started --><p>
      <?php

          if(isset($success_msg))
          {
            echo '<b>'.$success_msg.'</b>';
          }
          if(isset($error_msg))
          {
            echo $error_msg;
          }

        ?>
          </p><!-- Error or Success Message printint ended -->

          <br>
   
          <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Registration No.</label>
                <div class="col-sm-7">
                  <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="Your Register No" />
                </div>
            </div>
            <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7 my-3 md-3" value="Go!" name="sr_btn" />
          </form>
          <div class="content"></div>


      <?php

      if(isset($_POST['sr_btn'])){

      //initializing student ID from form data
       $sr_id = mysqli_real_escape_string($con,$_POST['sr_id']);

       $i=0;

       //searching students information respected to the particular ID
       $all_query = mysqli_query($con,"select * from students where students.st_id='$sr_id'");
       while ($data = mysqli_fetch_array($all_query)) {
         $i++;
       
       ?>
<form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">
   <table class="table table-striped">
  
          <tr>
            <td>Registration No.:</td>
            <td><?php echo htmlspecialchars($data['st_id']); ?></td>
          </tr>

          <tr>
              <td>Student's Name:</td>
              <td><input type="text" name="name" value="<?php echo htmlspecialchars($data['st_name']); ?>"></input></td>
          </tr>

          <tr>
              <td>Department:</td>
              <td><input type="text" name="dept" value="<?php echo htmlspecialchars($data['st_dept']); ?>"></input></td>
          </tr>

          <tr>
              <td>Batch:</td>
              <td><input type="text" name="batch" value="<?php echo htmlspecialchars($data['st_batch']); ?>"></input></td>
          </tr>
          
          <tr>
              <td>Semester:</td>
              <td><input type="text" name="semester" value="<?php echo htmlspecialchars($data['st_sem']); ?>"></input></td>
          </tr>

          <tr>
              <td>Email:</td>
              <td><input type="text" name="email" value="<?php echo htmlspecialchars($data['st_email']); ?>"></input></td>
          </tr>
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($sr_id); ?>">
          
          <tr><td></td></tr>
          <tr>
           <td></td>
            <center><td><input type="submit" class="btn btn-primary col-md-3 col-md-offset-7 text-align-center" value="Update" name="done" /></td></center>
          </tr>
                
          

    </table>
</form>
     <?php 
   } 
     }  
     ?>


      </div>

  </div>

  </center>
<!-- Contents, Tables, Forms, Images ended -->

</body>
<!-- Menus ended -->

</html>
