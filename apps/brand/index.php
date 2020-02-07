<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "brand";
  $brand = fetch_all($fields, $table);
 
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Brand</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Brand</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card">
             
            <div class="card-body">
            <div class="border border-secondary p-3 mb-4 ">
              <form id="forminfo" action="apps/brand/do_brand.php?action=save_brand" method="POST">
                <div class="row d-flex justify-content-center">
                  <div class="col-md-3 text-left text-md-center mt-0 mt-md-1">
                  <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" id="status" name="status" value="Y" checked>
                      <label class="custom-control-label" for="status">Enabled/Disabled</label>
                    </div>
                  </div>
                  </div>
              
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" name="brand_name" id="brand_name" class="form-control form-control-sm" placeholder="Brand Name *">
                      <input type="hidden" name="brand_id" id="brand_id">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-sm font-weight-bold"><i class="fas fa-save mr-1"></i> SAVE</button>
                    </div>
                  </div>
                </div>
            </form>
            </div>

     
              <form action="apps/brand/do_brand.php?action=delete_all" id="frm" method="POST">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th></th>
                        <th>brand Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                $i = 1;
                  foreach($brand as $value){
                    if($value["status"] == "Y"){
                      $status = "Enabled";
                      $bg = "success";
                    }else{
                      $status = "Disabled";
                      $bg = "danger";
                    }
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td class="text-center">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checK_<?php echo $i;?>" name="ch[]"
                              value="<?php echo $value["id"];?>">
                            <label for="checK_<?php echo $i;?>">
                            </label>
                          </div>
                        </td>
                        <td><?php echo $value["name"];?></td>
                        <td><span class="badge badge-<?php echo $bg;?> badge-pill"><?php echo $status;?></span></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <small><a class="dropdown-item brand-edit"
                                  href="javascript:void(0);" data-brand-id="<?php echo $value["id"];?>" data-brand-status="<?php echo $value["status"];?>" data-brand-name="<?php echo $value["name"];?>" ><i class="fas fa-edit" ></i>
                                  Edit</a></small>
                              <small><a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                  data-target="#modalDelete" data-brand-id="<?php echo $value["id"];?>" data-brand-name="<?php echo $value["name"];?>"><i class="fas fa-trash"></i>
                                  Delete</a></small>
                        
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  
                    </tbody>
                  </table>
                </div>

                <!-- <input type="text" id="hdcount" name="hdcount" value="1"> -->


                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-group">
                      <button type="button" class="btn-sm btn">
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkall">
                          <label for="checkall">Check All
                          </label>
                        </div>
                      </button>
                      <button type="button" class="btn-sm btn btn-danger btn-delete-all" disabled data-toggle="modal"
                        data-target="#modalDeleteAll"><i class="fas fa-trash"></i>
                        Delete</button>
                    </div>
                  </div>
                </div>

          
                <form>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content -->
</div>


<div class="modal" id="modalDeleteAll" role="dialog" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <i class="fas fa-exclamation-circle"></i> Are you sure you want to delete all?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary btn-continue">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modalDelete" role="dialog" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <i class="fas fa-exclamation-circle"></i>
        <span></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary btn-continue" onClick="">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal save-info" id="formModal" role="dialog" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="forminfo" action="apps/brand/do_brand.php?action=save_brand" method="POST" autocomplete="off">
        <div class="modal-body">
          <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Status</label>
            <div class="col-6 col-lg-3">
              <div class="custom-control custom-radio my-2">
                <input type="radio" id="enabled" name="status" checked class="custom-control-input" value="Y">
                <label class="custom-control-label" for="enabled">Enabled</label>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="custom-control custom-radio my-2">
                <input type="radio" id="disabled" name="status" class="custom-control-input" value="N">
                <label class="custom-control-label" for="disabled">Disabled</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="brand_name" class="col-form-label">brand Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" required>
            <input type="hidden" class="form-control" id="brand_id">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" onClick="">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var permission = "<?php echo $_SESSION["PERMISSION"] ?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
