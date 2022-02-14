<?php

include('security.php');
$connection=mysqli_connect("localhost","root","","adminpanel");
if(!isset($_SESSION['auth']))
{
 $_SESSION['status']="Login to access Dashboard";
 header('Location:../login.php');
}
else
{
    if($_SESSION['auth_role']!='1')
    {
        $_SESSION['status']="You are not authorized as ADMIN";
        header('Location:../login.php');
    }
}


?>