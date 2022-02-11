<?php
 session_start();
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="container-fluid mt-3">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Departments Data </h6>
        </div>
        <div class="card-body">
        <?php
            $connection=mysqli_connect("localhost","root","","adminpanel");
            if(isset($_POST['edit_btn']))
            {
                $id = $_POST['edit_id'];
                $query = "SELECT * FROM dept_category_list WHERE id='$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach($query_run as $rowediting)
                {
                    ?>

               <form action="code.php" method="POST" enctype="multipart/form-data">

                   <input type="hidden" name="edit_id" value="<?php echo $rowediting['id'] ?>">

                            <?php
                               $department="SELECT * FROM dept_category";
                               $dept_run=mysqli_query($connection,$department);
                               if(mysqli_num_rows($dept_run)>0)
                                 {
                             ?>
                                <div class="form-group">
                                    <label> Dept List/ID </label>
                                        <select name="dept_cate_id" class="form-control" required>
                                        <option value="">Choose your Department Category</option>
                             <?php
                                  foreach($dept_run as $row)
                                    {
                              ?>
                                   <option value="<?php  echo $row['id'];  ?>"><?php  echo $row['dept_name'];  ?></option>
                             <?php
                                    }
                              ?>
                                  </select>
                            </div>
                        <?php
                         }
                    else
                     {
                        echo "No Data Available";
                     }
              ?>
            <div class="form-group">
                <label> Dept List Name </label>
                <input type="text" name="name" class="form-control" value=" <?php  echo $rowediting['name']  ?> " required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value=" <?php  echo $rowediting['description']  ?> " required>
            </div>
            <div class="form-group">
                <label>Section</label>
                <input type="text" name="section" class="form-control" value=" <?php  echo $rowediting['section']  ?> " required>
            </div>

            <a href="departments-list.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="departments_list_update_btn" class="btn btn-primary"> Update </button>

            </form>
        <?php
                }
            }
        ?>
        </div>
    </div>
<?php
include('includes/script.php');
include('includes/footer.php');
?>
</div>



