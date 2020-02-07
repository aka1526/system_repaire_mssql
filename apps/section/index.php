<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "section";
  $type = fetch_all($fields, $table);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Section</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Section</li>
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
            <div class="card-body">

            <div class="border border-secondary p-3 mb-4 ">
              <form id="forminfo" action="apps/section/do_section.php?action=save_section" method="POST">
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
                      <input type="text" name="section_name" id="section_name" class="form-control form-control-sm" placeholder="Section Name *">
                      <input type="hidden" name="section_id" id="section_id">
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

              <form action="apps/section/do_section.php?action=delete_all" id="frm" method="POST">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th></th>
                       
                        <th>Type Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                $i = 1;
                  foreach($type as $value){
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
                              <small><a class="dropdown-item section-edit"
                                  href="javascript:void(0);" 
                                    data-section-id="<?php echo $value["id"];?>" 
                                    data-section-status="<?php echo $value["status"];?>" 
                                    data-section-name="<?php echo $value["name"];?>">
                                  <i class="fas fa-edit"></i>
                                  Edit</a></small>
                              <small><a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#modalDelete" 
                                    data-section-id="<?php echo $value["id"];?>" 
                                    data-section-name="<?php echo $value["name"];?>">
                                  <i class="fas fa-trash"></i>
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


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var permission = "<?php echo $_SESSION["PERMISSION"] ?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
