<?php 
error_reporting(0);
ob_start();
include "dbconnect.php";

include 'session.php';
sessionStart();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: /login/");
    session_regenerate_id(true);
    exit;
}
if(isset($_GET['id']))
{    
	$id= mysqli_real_escape_string($conn,$_GET['id']);
	// $filepath = 'results/' . $filename;
    $q = mysqli_query($conn,"select * from list_files where id=$id");
    $data = mysqli_fetch_array($q);
   $name=test_input($data['file_name']);
   

    $file='results/'.$name;
   
    
	
    if(file_exists($file)) 
    {
  
//Define Headers
		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$file");
		header("Content-Type: application/zip");
		header("Content-Transfer-Encoding: binary");

		readfile($file);
		exit;

	}
	else{
		echo "This File Does not exist.";
	}
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Student-Drive</title>
 </head>
 <body>
     <center>
    <h1>
        Your file Will Start Downloading Soon ,If not click <a href="#">here</a>
    </h1>


     </center>
 </body>
 </html>