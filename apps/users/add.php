<?php
  defined('APPS') OR exit('No direct script access allowed');
  $permission = fetch_all("per_id, per_name","permission");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=users">Users</a></li>
            <li class="breadcrumb-item active">New User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail" src="dist/img/avatar04.png"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <form id="forminfo" class="form-horizontal" enctype="multipart/form-data" action="apps/users/do_users.php?action=create_users"
                method="POST" autocomplete="off">
                <?php if ($_SESSION["PERMISSION"] == "1"){?>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-6 col-lg-2">
                    <div class="custom-control custom-radio my-2">
                      <input type="radio" id="enabled" name="status" checked class="custom-control-input" value="Y">
                      <label class="custom-control-label" for="enabled">Enabled</label>
                    </div>
                  </div>
                  <div class="col-6 col-lg-2">
                    <div class="custom-control custom-radio my-2">
                      <input type="radio" id="disabled" name="status" class="custom-control-input" value="N">
                      <label class="custom-control-label" for="disabled">Disabled</label>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Profile</label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo" onChange="readURL(this);">
                      <label id="name-photo-main" class="custom-file-label text-truncate" for="photo"
                        data-browse="Browse">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Username <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" value=""
                      placeholder="Username" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Password <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value=""
                      placeholder="Password" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value=""
                      placeholder="example@hotmail.com" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="firstname" class="col-sm-2 col-form-label">First Name <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" value=""
                      placeholder="First Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lastname" class="col-sm-2 col-form-label">Last Name <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" value=""
                      placeholder="Last Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lastname" class="col-sm-2 col-form-label">Gender</label>
                  <div class="col-sm-10">
                    <select name="gender" id="gender" class="form-control">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="birthdate" class="col-sm-2 col-form-label">BirthDate</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value=""
                      placeholder="BirthDate">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value=""
                      placeholder="Phone Number">
                  </div>
                </div>
                <?php if ($_SESSION["PERMISSION"] == "1"){?>
                <div class="form-group row">
                  <label for="permission" class="col-sm-2 col-form-label">Permission</label>
                  <div class="col-sm-10">
                    <select name="permission" id="permission" class="form-control">
                      <?php
                          foreach($permission as $p_value){
                            echo '<option value="'.$p_value["per_id"].'">'.$p_value["per_name"].'</option>';
                          }
                        ?>
                    </select>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-upload"><i class="fas fa-check-circle"></i>
                      Save</button>
                  </div>
                </div>
              </form>
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
