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
                      Add Admin Profile
                </button>
                </div>
                <div class="card-body mt-3">
                    <?php
                    if(isset($_SESSION['success']) && $_SESSION['success']!=''){
                        echo '<h2>' .$_SESSION['success'].'</h2>';
                        unset($_SESSION['success']);
                    }
                    if(isset($_SESSION['status']) && $_SESSION['status']!=''){
                        echo '<h2 class="bg-info text-white">' .$_SESSION['status'].'</h2>';
                        unset($_SESSION['status']);
                    }

                ?>
         <div class="table-responsive">
             <table class="table table bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Position</th>
                     <th>Office</th>
                     <th>Age</th>
                     <th>Start Date</th>
                     <th>Salary</th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                    </tr>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
          <div class="modal-body">
            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                <small class="error_email" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

