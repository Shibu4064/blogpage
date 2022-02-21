<?php
session_start();
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="container mt-5">
<!-- Outer Row -->
<div class="row justify-content-center">
  <div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">

            <div class="p-5">
            <?php  // include('message.php');   ?>
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">View Category Here!</h1>
                <hr>
              </div>

              <div class="table-responsive">
                  <table class="table table-bordered table-stripped">
                      <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                    </thead>
                    <tbody>
                    <?php
                $connection=mysqli_connect("localhost","root","","adminpanel");
                $category="SELECT * FROM categories WHERE status!='2' ";
                $category_run=mysqli_query($connection,$category);

                if(mysqli_num_rows($category_run)>0)
                {
                    foreach($category_run as $item)
                    {
                         ?>
                        <tr>
                            <td><?php echo $item['id'];  ?></td>
                            <td><?php echo $item['name'];  ?></td>
                            <td>
                                <?php
                                    echo  $item['status']=='1'? 'Hidden':'Visible'
                                ?>
                            </td>
                            <td>
                              <a href="category-edit.php?id=<?php echo $item['id'] ?>" class="btn btn-info">Edit</a>
                            </td>
                            <td>
                              <form action="code.php" method="POST">
                              <button type="submit" name="category_delete" value="<?php echo $item['id'];  ?>" class="btn btn-danger">Delete</a>
                              </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    ?>
                       <tr>
                           <td colspan="5">No record found</td>
                       </tr>
                    <?php
                }
              ?>
                    </tbody>
                  </table>
              </div>
                <div class="text-center mt-2">
                        <a class="small" href="category-add.php" style="text-decoration: none;" >Add Category</a>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php

include('includes/script.php');

?>