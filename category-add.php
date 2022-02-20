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
                <h1 class="h4 text-gray-900 mb-4">Add Category Here!</h1>
                <hr>
              </div>
                <form action="code.php" method="POST">

                <div class="row">
                   <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control form-control-user" placeholder="Name..." required>
                    </div>
                    <div class="form-group col-md-6">
                    <input type="text" name="slug" class="form-control form-control-user" placeholder="Slug(URL)" required>
                    </div>
                    <div class="form-group col-md-6 mt-3">
                    <input type="text" name="description" class="form-control form-control-user" placeholder="Description" required>
                    </div>
                    <div class="form-group mt-3 col-md-6">
                    <input type="text" name="meta_title" class="form-control form-control-user" placeholder="Meta Title" required>
                    </div>
                    <div class="form-group mt-3 col-md-6">
                    <input type="text" name="meta_description" class="form-control form-control-user" placeholder="Meta Description" required>
                    </div>
                    <div class="form-group mt-3 col-md-6">
                    <input type="text" name="meta_keyword" class="form-control form-control-user" placeholder="Meta Keyword" required>
                    </div>
                    <div class="form-group mt-3 col-md-6">
                        <label for="">Navbar Status</label>
                        <input type="checkbox" name="navbar_status" width="70px" height="70px">
                    </div>
                    <div class="form-group mt-3 col-md-6">
                        <label for=""> Status</label>
                        <input type="checkbox" name="status" width="70px" height="70px">
                    </div>
                </div>

                    <button type="submit" name="category_add" class="btn btn-primary btn-user btn-block mt-5"> ADD </button>

                </form>
                <div class="text-center mt-2">
                        <a class="small" href="category-view.php" style="text-decoration: none;" >View Category</a>
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