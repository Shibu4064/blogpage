<?php
include('security.php');
$connection=mysqli_connect("localhost","root","","adminpanel");
//register's php code
if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
            $query_run = mysqli_query($connection, $query);
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');
            }
        }
        else
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');
        }
    }

}
//Update's php code
if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertypeupdate=$_POST['update_usertype'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$usertypeupdate' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}
//delete's php code
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}
//login's php code
if(isset($_POST['login_btn']))
{
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if($usertypes['usertype'] == "admin")
    {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
    }
    else if($usertypes['usertype'] == "user")
    {
        $_SESSION['username'] = $email_login;
        header('Location: ../index.php');
    }
    else
    {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
    }
}
//logout's php code
if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('Location: login.php');
}
//about us php code
if(isset($_POST['about_save']))
{
   $title=$_POST['title'];
   $subtitle=$_POST['subtitle'];
   $description=$_POST['description'];
   $links=$_POST['links'];

   $query="INSERT INTO abouts(title,subtitle,description,links) VALUES('$title','$subtitle','$description','$links')";
   $query_run=mysqli_query($connection,$query);
   if($query_run){
       $_SESSION['success']="About Us Added";
      header('Location:aboutus.php');
   }
   else{
    $_SESSION['status']="About Us Not Added";
    header('Location:aboutus.php');
   }
}
//about us update php code
if(isset($_POST['updatebtn']))
{
  $id=$_POST['edit_id'];
  $title=$_POST['edit_title'];
  $subtitle=$_POST['edit_subtitle'];
  $description=$_POST['edit_description'];
  $links=$_POST['edit_links'];

  $query="UPDATE abouts SET title='$title', subtitle='$subtitle', description='$description', links='$links' WHERE id='$id' ";
  $query_run=mysqli_query($connection,$query);

  if($query_run){
      $_SESSION['success']="Your Data is Updated ";
      header('Location:aboutus.php');
  }
  else{
      $_SESSION['status']="Your Data isn't Updated";
      header('Location:aboutus.php');
  }
}
//about us delete php code
if(isset($_POST['about_delete_btn']))
{
    $id=$_POST['delete_id'];
    $query="DELETE FROM abouts WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);
    if($query_run){
        $_SESSION['success']="Your Data is Deleted ";
        header('Location:aboutus.php');
    }
    else{
        $_SESSION['status']="Your Data isn't Deleted";
        header('Location:aboutus.php');
    }
}
//faculty php code
if(isset($_POST['save_faculty']))
{
    $name=$_POST['faculty_name'];
    $design=$_POST['faculty_designation'];
    $description=$_POST['faculty_description'];
    $images=$_FILES['faculty_image']['name'];

    if(file_exists("upload/" .$_FILES["faculty_image"]["name"]))
    {
       $store=$_FILES['faculty_image']['name'];
       $_SESSION['status']="Image Already Exists. '.$store.' ";
       header('Location:faculty.php');
    }
  else{
       $query="INSERT INTO faculty('name','design','descrip','images') VALUES('$name','$design','$description','$images')";
       $query_run=mysqli_query($connection,$query);

       if($query_run){
          move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
          $_SESSION['success']="Faculty Added";
          header('Location:faculty.php');
        }
        else{
        $_SESSION['status']="Faculty Not Added";
        header('Location:faculty.php');
        }
     }
}
?>