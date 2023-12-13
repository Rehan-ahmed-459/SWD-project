<?php 

function username_exists($username,$conn){
    $u=mysqli_real_escape_string($conn,$username);
    $row = mysqli_query($conn,"select id,email from users_login where username='$u'");
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
