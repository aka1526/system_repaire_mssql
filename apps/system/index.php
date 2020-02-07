<?php
defined('APPS') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">System</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">System</li>
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

        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form id="forminfo" class="form-horizontal" action="apps/system/do_system.php?action=update_system"
                method="POST" autocomplete="  off">
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Title Name <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title"
                      value="<?php echo $system["title"];?>" placeholder="Title Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">System Name <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                      value="<?php echo $system["name"];?>" placeholder="System Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-check-circle"></i> Submit</button>
                  </div>
                </div>
              </form>
            </div><!-- /.card-body -->
            <div class="card-footer">
              <?php echo $system["updated_at"];?>
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
var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>