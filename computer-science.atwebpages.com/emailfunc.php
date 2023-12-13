<?php 

function email_exists($email,$conn){
    $e=mysqli_real_escape_string($conn,$email);
    $row = mysqli_query($conn,"select email from users_login where email='$e'");
//    echo print_r($row);
    {
        if(mysqli_num_rows($row)==1)
        {
            return true;
        }
        else {
            return false;
        }
    }
}
?>
