<?php
 session_start();
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                      Academics - Departments
                </button>
                </div>
                <div class="card-body mt-3">
                    <?php
                    if(isset($_SESSION['success']) && $_SESSION['success']!=''){
                        echo '<h2 class="bg-success text-white">' .$_SESSION['success'].'</h2>';
                        unset($_SESSION['success']);
                    }
                    if(isset($_SESSION['status']) && $_SESSION['status']!=''){
                        echo '<h2 class="bg-info text-white">' .$_SESSION['status'].'</h2>';
                        unset($_SESSION['status']);
                    }

                ?>
         <div class="table-responsive">
             <?php
              $connection=mysqli_connect("localhost","root","","adminpanel");
                $query = "SELECT * FROM dept_category";
                $query_run = mysqli_query($connection, $query);
             ?>
             <table class="table table bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Dept Name</th>
                     <th>Description</th>
                     <th>Image</th>
                     <th>Edit</th>
                     <th>Delete</th>
                   </tr>
                </thead>
                <tbody>
                     <?php
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                            <tr>
                                <td><?php  echo $row['id'];   ?></td>
                                <td><?php  echo $row['dept_name'];   ?></td>
                                <td><?php  echo $row['description'];   ?></td>
                                <td> <?php echo '<img src="upload/departments/' .$row['images']. '" width="100px;" height="100px;" alt="Image">' ?> </td>
                                <td>
                                    <form action="departments_edit.php" method="post">
                                         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="department_delete_btn" class="btn btn-danger"> DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
                 </tbody>
               </table>
              </div>
            </div>
         </div>
      </div>
    </div>

<?php

include('includes/script.php');
include('includes/footer.php');

?>

</div>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
                <label> Dept Name </label>
                <input type="text" name="name" class="form-control" placeholder="Enter Department">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description" class="form-control" placeholder="Enter Description"></textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="dept_image" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="dept_save" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>