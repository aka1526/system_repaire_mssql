<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "id,username, email, first_name, last_name, gender, birthdate, phone_number, profile, permission, status, updated_at";
  $table = "users";
  $req = array(
    "user_id" => $_GET["user_id"]
  );
  $value = " WHERE id = :user_id ";
  $user = fetch_all($fields,$table,$value,$req);
  if(!empty($user)){
    $user = $user[0];
  }else{
    header("location:./?page=users");
    exit();
  }
  $permission = fetch_all("per_id, per_name","permission");
  $permission_txt = array();
  foreach($permission as $per){
    $permission_txt[$per["per_id"]] = $per["per_name"];
  }
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
            <li class="breadcrumb-item active"><?php echo $user["first_name"] ." ". $user["last_name"];?></li>
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
                <?php if($user["profile"]){ ?>
                <?php if(file_exists("uploads/users/".$user["profile"])){ ?>
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail"
                  src="uploads/users/<?php echo $user["profile"];?>" alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php }else{ ?>
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail" src="dist/img/avatar04.png"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php } ?>
                <?php }else{ ?>
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail" src="dist/img/avatar04.png"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php } ?>
              </div>

              <h3 class="profile-username text-center">
                <?php echo $user["first_name"] ." ". $user["last_name"];?></h3>
              <form id="upload-profile" action="apps/users/do_users.php?action=upload_profile&user_id=<?php echo $user["id"];?>" method="POST"
                enctype="multipart/form-data">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="photo" name="photo" onChange="readURL(this);">
                  <input type="hidden" id="old_profile" name="old_profile" value="<?php echo $user["profile"];?>">
                  <label id="name-photo-main" class="custom-file-label text-truncate" for="photo"
                    data-browse="Browse">Choose file</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-upload" disabled><b>Upload
                    Profile</b></button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab"><i
                      class="fas fa-info-circle"></i> Info</a></li>
                <?php if ($_SESSION["PERMISSION"] == "1"){?>
                <li class="nav-item"><a class="nav-link" href="#changepassword" data-toggle="tab"><i
                      class="fas fa-key"></i> Change Password</a></li>
                <?php } ?>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="info">
                  <form id="forminfo" class="form-horizontal" action="apps/users/do_users.php?action=update_users"
                    method="POST" autocomplete="off">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user["id"];?>">
                    <?php if ($_SESSION["PERMISSION"] == "1"){?>
                    <div class="form-group row">
                      <label for="username" class="col-sm-2 col-form-label">Status</label>
                      <div class="col-6 col-lg-2">
                        <div class="custom-control custom-radio my-2">
                          <input type="radio" id="enabled" name="status"
                            <?php if ($user["status"] == "Y") echo "checked"; ?> class="custom-control-input" value="Y">
                          <label class="custom-control-label" for="enabled">Enabled</label>
                        </div>
                      </div>
                      <div class="col-6 col-lg-2">
                        <div class="custom-control custom-radio my-2">
                          <input type="radio" id="disabled" name="status"
                            <?php if ($user["status"] == "N") echo "checked"; ?> class="custom-control-input" value="N">
                          <label class="custom-control-label" for="disabled">Disabled</label>
                        </div>
                      </div>
                    </div>
                    <?php }else{ ?>
                    <div class="form-group row">
                      <label for="username" class="col-sm-2">Status</label>
                      <div class="col-sm-10">
                        <?php
                    if($user["status"] == "Y"){
                      $status = "Enabled";
                      $bg = "success";
                    }else{
                      $status = "Disabled";
                      $bg = "danger";
                    }
                    echo "<span class='badge badge-$bg'>".$status."</span>";
                    ?>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                      <label for="username" class="col-sm-2 col-form-label">Username <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username"
                          value="<?php echo $user["username"];?>" placeholder="Username" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email"
                          value="<?php echo $user["email"];?>" placeholder="example@hotmail.com" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="firstname" class="col-sm-2 col-form-label">First Name <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                          value="<?php echo $user["first_name"];?>" placeholder="First Name" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="lastname" class="col-sm-2 col-form-label">Last Name <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="last_name" name="last_name"
                          value="<?php echo $user["last_name"];?>" placeholder="Last Name" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="lastname" class="col-sm-2 col-form-label">Gender</label>
                      <div class="col-sm-10">
                        <select name="gender" id="gender" class="form-control">
                          <option value="M" <?php if ($user["gender"] == "M") echo "selected"; ?>>Male</option>
                          <option value="F" <?php if ($user["gender"] == "F") echo "selected"; ?>>Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="birthdate" class="col-sm-2 col-form-label">BirthDate</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="birthdate" name="birthdate"
                          value="<?php echo $user["birthdate"];?>" placeholder="BirthDate">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                      <div class="col-sm-10">
                        <input type="tel" class="form-control" id="phone_number" name="phone_number"
                          value="<?php echo $user["phone_number"];?>" placeholder="Phone Number">
                      </div>
                    </div>
                    <?php if ($_SESSION["PERMISSION"] == "1"){?>
                    <div class="form-group row">
                      <label for="permission" class="col-sm-2 col-form-label">Permission</label>
                      <div class="col-sm-10">
                        <select name="permission" id="permission" class="form-control">
                          <?php
                          foreach($permission as $p_value){
                            $selected = "";
                            if($p_value["per_id"] == $user["permission"]){ $selected = "selected"; }
                            echo '<option value="'.$p_value["per_id"].'" '.$selected.'>'.$p_value["per_name"].'</option>';
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                    <?php }else{ ?>
                    <div class="form-group row">
                      <label for="phone_number" class="col-sm-2 col-form-label">Permission</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control"
                          value="<?php echo $permission_txt[$user["permission"]];?>" placeholder="Phone Number"
                          disabled>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Save</button>
                      </div>
                    </div>
                  </form>
                </div>
                <?php if ($_SESSION["PERMISSION"] == "1"){?>
                <div class="tab-pane" id="changepassword">
                  <form id="formpassword" class="form-horizontal"
                    action="apps/profile/do_profile.php?action=change_password" method="POST" autocomplete="off">
                    <div class="form-group row">
                      <label for="current_password" class="col-sm-2 col-form-label">Current Password <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="current_password" name="current_password"
                          placeholder="Current Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_password" class="col-sm-2 col-form-label">New Password <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="new_password" name="new_password"
                          placeholder="New Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="confirm_password" name="confirm_password"
                          placeholder="Confirm Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Save</button>
                      </div>
                    </div>
                  </form>
                </div>
                <?php } ?>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
            <div class="card-footer">
              <?php echo $user["updated_at"];?>
            </div>
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


<script type="text/javascript">
var msg = "<?php echo $_SESSION["MSG"] ?>";
var status = "<?php echo $_SESSION["STATUS"] ?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>