<?php
include('security.php');
$connection=mysqli_connect("localhost","root","","adminpanel");
//register's php code

if(isset($_POST['check_submit_btn']))
{
     $email=$_POST['email_id'];
     $email_query = "SELECT * FROM users WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
       echo "Email Already Exists. Please try another";
    }
    else
    {
        echo "It's Available";
    }
}
if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
  //  $user_type = $_POST['user_type'];

    $email_query = "SELECT * FROM users WHERE email='$email' ";
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
            $query = "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')";
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
if(isset($_POST['register_update_btn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $fname=$_POST['edit_fname'];
    $lname=$_POST['edit_lname'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $role_as=$_POST['role_as'];
   // $usertypeupdate=$_POST['update_usertype']; usertype='$usertypeupdate'

    $query = "UPDATE users SET username='$username', fname='$fname', lname='$lname', email='$email', password='$password', role_as='$role_as' WHERE id='$id' ";
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

    $query = "DELETE FROM users WHERE id='$id' ";
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
if(isset($_POST['login_btn']))
{
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run)>0)
    {
      foreach($query_run as $data)
       {
          $user_id=$data['id'];
          $user_name=$data['fname'].' '.$data['lname'];
          $user_email=$data['email'];
          $role_as=$data['role_as'];
        }
      $_SESSION['auth']=true;
      $_SESSION['auth_role']="$role_as";  //1=admin, 0=user
      $_SESSION['auth_user']=[
          'user_id'=>$user_id,
          'user_name'=>$user_name,
          'user_email'=>$user_email,
        ];
       if($_SESSION['auth_role']=='1')
       {
           $_SESSION['status']="Welcome to dashboard";
           $_SESSION['status_code']="success";
           header('Location:blogpage/index.php');
       }
       elseif($_SESSION['auth_role']=='0')
       {
        $_SESSION['status']="Logging Successful";
        $_SESSION['status_code']="success";
        header('Location:index.php');
       }
       else
       {
        $_SESSION['status'] = "Email / Password is Invalid";
        $_SESSION['status_code'] = "warning";
        header('Location: login.php');
       }
    }
   else
   {
    $_SESSION['status']="You are not allowed to access this file";
    $_SESSION['status_code']="warning";
    header('Location:login.php');
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
        $_SESSION['success']="About Data is Deleted ";
        header('Location:aboutus.php');
    }
    else{
        $_SESSION['status']="About Data isn't Deleted";
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

    $img_types=array('image/jpg','image/png','image/jpeg','image/webp');
    $validate_img_extension=in_array($_FILES["faculty_image"]['type'], $img_types);
    if($validate_img_extension){
       if(file_exists("upload/" .$_FILES["faculty_image"]["name"]))
           {
             $store=$_FILES['faculty_image']['name'];
             $_SESSION['status']="Image Already Exists. '.$store.' ";
             header('Location:faculty.php');
           }
       else{
       $query="INSERT INTO faculty(name,design,description,images) VALUES('$name','$design','$description','$images')";
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
    else{
        $_SESSION['status']="Only PNG,JPG,JPEG,WEBP Images are allowed";
        header('Location:faculty.php');
    }
}
//faculty update php code
if(isset($_POST['update_btn']))
{
  $edit_id=$_POST['edit_id'];
  $edit_name=$_POST['edit_name'];
  $edit_designation=$_POST['edit_designation'];
  $edit_description=$_POST['edit_description'];
  $edit_faculty_image=$_FILES['faculty_image']['name'];

  $img_types=array('image/jpg','image/png','image/jpeg','image/webp');
  $validate_img_extension=in_array($_FILES["faculty_image"]['type'], $img_types);

  if($validate_img_extension){
        $faculty_query="SELECT * FROM faculty WHERE id='$edit_id' ";
         $faculty_query_run=mysqli_query($connection,$faculty_query);
        foreach($faculty_query_run as $fa_row)
        {
             // echo $fa_row['images'];
           if($edit_faculty_image==NULL)
          {
              //update with existing image
             $image_data=$fa_row['images'];
          }
         else
          {
            //update with new image and delete with old image
            if($img_path="upload/".$fa_row['images'])
            {
               unlink($img_path);
               $image_data=$edit_faculty_image;
            }
          }
       }

  $query="UPDATE faculty SET name='$edit_name', design='$edit_designation', description='$edit_description', images='$image_data' WHERE id='$edit_id' ";
  $query_run=mysqli_query($connection,$query);

  if($query_run)
  {
        if($edit_faculty_image==NULL)
        {
           //update with existing image
            $_SESSION['success']="Faculty Updated with existing image";
           header('Location:faculty.php');
         }
      else
      {
          //update with new image and delete with old image
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success']="Faculty Updated";
         header('Location:faculty.php');
       }
    }
  else
     {
      $_SESSION['status']="Faculty Not Updated";
      header('Location:faculty.php');
     }
  }
  else{
    $_SESSION['status']="Only PNG,JPG,JPEG,WEBP Images are allowed";
    header('Location:faculty.php');
    }
}
//faculty delete php code
if(isset($_POST['faculty_delete_btn']))
{
    $id=$_POST['delete_id'];
    $query="DELETE FROM faculty WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success']="Faculty Data is Deleted ";
        header('Location:faculty.php');
    }
    else{
        $_SESSION['status']="Faculty Data isn't Deleted";
        header('Location:faculty.php');
    }
}
//department's php code
if(isset($_POST['dept_save']))
{
    $name=$_POST['name'];
    $description=$_POST['description'];
    $images=$_FILES['dept_image']['name'];

    $img_types=array('image/jpg','image/png','image/jpeg','image/webp');
    $validate_img_extension=in_array($_FILES["dept_image"]['type'], $img_types);
    if($validate_img_extension)
    {
       if(file_exists("upload/departments/" .$_FILES["dept_image"]["name"]))
           {
             $store=$_FILES['dept_image']['name'];
             $_SESSION['status']="Image Already Exists. '.$store.' ";
             header('Location:departments.php');
           }
       else{
       $query="INSERT INTO dept_category(dept_name,description,images) VALUES('$name','$description','$images')";
       $query_run=mysqli_query($connection,$query);

       if($query_run){
          move_uploaded_file($_FILES["dept_image"]["tmp_name"], "upload/departments/".$_FILES["dept_image"]["name"]);
          $_SESSION['success']="Department Added";
          header('Location:departments.php');
        }
        else{
        $_SESSION['status']="Department Not Added";
        header('Location:departments.php');
        }
      }
    }
    else{
        $_SESSION['status']="Only PNG,JPG,JPEG,WEBP Images are allowed";
        header('Location:departments.php');
    }
}
//department's update php code
if(isset($_POST['departments_update_btn']))
{
  $edit_id=$_POST['edit_id'];
  $edit_name=$_POST['edit_name'];
  $edit_description=$_POST['edit_description'];
  $edit_departments_image=$_FILES['department_image']['name'];

  $img_types=array('image/jpg','image/png','image/jpeg','image/webp');
  $validate_img_extension=in_array($_FILES["department_image"]['type'], $img_types);

  if($validate_img_extension){
        $departments_query="SELECT * FROM dept_category WHERE id='$edit_id' ";
         $departments_query_run=mysqli_query($connection,$departments_query);
        foreach($departments_query_run as $fa_row)
        {
             // echo $fa_row['images'];
           if($edit_departments_image==NULL)
          {
              //update with existing image
             $image_data=$fa_row['images'];
          }
         else
          {
            //update with new image and delete with old image
            if($img_path="upload/departments/".$fa_row['images'])
            {
               unlink($img_path);
               $image_data=$edit_departments_image;
            }
          }
       }

  $query="UPDATE dept_category SET dept_name='$edit_name', description='$edit_description', images='$image_data' WHERE id='$edit_id' ";
  $query_run=mysqli_query($connection,$query);

  if($query_run)
  {
        if($edit_departments_image==NULL)
        {
           //update with existing image
            $_SESSION['success']="Departments updated with existing image";
           header('Location:departments.php');
         }
      else
      {
          //update with new image and delete with old image
        move_uploaded_file($_FILES["department_image"]["tmp_name"], "upload/departments/".$_FILES["department_image"]["name"]);
        $_SESSION['success']="Departments Updated";
         header('Location:departments.php');
       }
    }
  else
     {
      $_SESSION['status']="Departments Not Updated";
      header('Location:departments.php');
     }
  }
  else{
    $_SESSION['status']="Only PNG,JPG,JPEG,WEBP Images are allowed";
    header('Location:departments.php');
    }
}
//department's delete php code
if(isset($_POST['department_delete_btn']))
{
    $id=$_POST['delete_id'];
    $query="DELETE FROM dept_category WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success']="Department Data is Deleted ";
        header('Location:departments.php');
    }
    else{
        $_SESSION['status']="Department Data isn't Deleted";
        header('Location:departments.php');
    }
}
//department category list php code
if(isset($_POST['dept_list_save']))
{
    $dept_cate_id=$_POST['dept_cate_id'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $section=$_POST['section'];

    $query="INSERT INTO dept_category_list(dept_cate_id,name,description,section) VALUES('$dept_cate_id','$name','$description','$section') ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success']="Dept Category List is inserted";
      header('Location:departments-list.php');
    }
    else
    {
       $_SESSION['status']="Dept Category List is not inserted";
       header('Location:departments-list.php');
    }
}
//department category list update php code
if(isset($_POST['departments_list_update_btn']))
{
    $edit_id=$_POST['edit_id'];
    $dept_cate_id=$_POST['dept_cate_id'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $section=$_POST['section'];

    $query="UPDATE dept_category_list SET dept_cate_id='$dept_cate_id', name='$name', description='$description', section='$section' WHERE id='$edit_id' ";
    $query_run=mysqli_query($connection,$query);
    if($query_run)
    {
        $_SESSION['success']="Dept Category List Updated";
        header('Location:departments-list.php');
    }
    else
    {
        $_SESSION['status']="Dept Category List isn't Updated";
        header('Location:departments-list.php');
    }
}
//department category list delete php code
if(isset($_POST['department_list_delete_btn']))
{
    $id=$_POST['delete_id'];
    $query="DELETE FROM dept_category_list WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success']="Department Category Data is Deleted ";
        header('Location:departments-list.php');
    }
    else{
        $_SESSION['status']="Department Category Data isn't Deleted";
        header('Location:departments-list.php');
    }
}
?>