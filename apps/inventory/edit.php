<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "inventory";
  $req = array(
    "inventory_id" => $_GET["inventory_id"]
  );
  $value = " WHERE id = :inventory_id ";
  $inventory = fetch_all($fields,$table,$value,$req);
  if(!empty($inventory)){
    $inventory = $inventory[0];
  }else{
    header("location:./?page=inventory");
    exit();
  }

  $fields = "*";
  $table = "type";
  $conditions = " WHERE status = 'Y' ";
  $types = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "brand";
  $conditions = " WHERE status = 'Y' ";
  $brand = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "category";
  $conditions = " WHERE status = 'Y' ";
  $categorys = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "section";
  $conditions = " WHERE status = 'Y' ";
  $sections = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "status";
  //$conditions = " WHERE status = 'Y' ";
  $conditions = "   ";
  $statuss = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "osname";
  $conditions = " WHERE status = 'Y' ";
  $osnames = fetch_all($fields, $table, $conditions);


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Inventory</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=inventory">Inventory</a></li>
            <li class="breadcrumb-item active"><?php echo $inventory["name"];?></li>
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
              <form id="forminfo" class="form-horizontal" enctype="multipart/form-data"
                action="apps/inventory/do_inventory.php?action=update_inventory&inventory_id=<?php echo $inventory["id"];?>" method="POST" autocomplete="off">
                <!--<div class="form-group row">
                  <label for="username" class="col-3 col-sm-2 col-form-label">Status</label>
                  <div class="col-9 col-lg-2">
                    <div class="custom-control custom-switch custom-switch-on-success my-2">
                      <input type="checkbox" class="custom-control-input" id="status" name="status" value="Y" <?php if($inventory["status"] == "Y"){ echo "checked";}?>>
                      <label class="custom-control-label" for="status">Enabled/Disabled</label>
                    </div>
                  </div>
                </div>
                -->
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                  <?php if($inventory["photo"]){ ?>
                <?php if(file_exists("uploads/inventory/".$inventory["photo"])){ ?>
                <img id="photo_profile" class="img-fluid img-thumbnail"
                  src="uploads/inventory/<?php echo $inventory["photo"];?>" alt="picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php }else{ ?>
                <img id="photo_profile" class="img-fluid img-thumbnail" src="dist/img/pic_empty.jpg"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php } ?>
                <?php }else{ ?>
                <img id="photo_profile" class="img-fluid img-thumbnail" src="dist/img/pic_empty.jpg"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php } ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Picture</label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo" onChange="readURL(this);">
                      <label id="name-photo-main" class="custom-file-label text-truncate" for="photo"
                        data-browse="Browse">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $inventory["name"];?>" placeholder="Name"
                      required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="owner_name" class="col-sm-2 col-form-label">Owner Name
                   </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="owner_name" name="owner_name" value="<?php echo $inventory["owner_name"];?>"
                      placeholder="ชื่อผู้ใช้งาน" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="serial_number" class="col-sm-2 col-form-label">Serial Number 
                   </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="serial_number" name="serial_number" value="<?php echo $inventory["serial_number"];?>"
                      placeholder="Serial Number" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="category" class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="category" id="category" class="form-control">
                      <option value="">-- Please Select Category --</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="section" class="col-sm-2 col-form-label">Section <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="section" id="section" class="form-control">
                      <option value="">-- Please Select Section --</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="firstname" class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="type" id="type" class="form-control">
                      <option value="">-- Please Select Type --</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="brand" class="col-sm-2 col-form-label">Brand <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="brand" id="brand" class="form-control">
                      <option value="">-- Please Select Brand --</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="os_name" class="col-sm-2 col-form-label">Operating system <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="os_name" id="os_name" class="form-control">
                      <option value="">-- Please Select OS --</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cpu_model" class="col-sm-2 col-form-label">CPU Speed<span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cpu_model" name="cpu_model" value=""
                      placeholder="cpu"  >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="ram_model" class="col-sm-2 col-form-label">Ram  <span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="ram_model" name="ram_model" value=""
                      placeholder="Ram Capacity"  >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="hdd_model" class="col-sm-2 col-form-label">Hard disk<span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="hdd_model" name="hdd_model" value=""
                      placeholder="Hard disk Capacity"  >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="monitor_model" class="col-sm-2 col-form-label">Monitor<span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="monitor_model" name="monitor_model" value=""
                      placeholder="Monitor"  >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="expire_date" class="col-sm-2 col-form-label">Expire Date<span class="text-danger"></span></label>
                  <div class="col-sm-10">
                  <input class="form-control" type="date" name="expire_date" id="expire_date">
                  </div>
                </div>
 



                
                <div class="form-group row">
                  <label for="inven_status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="inven_status" id="inven_status" class="form-control">
                      <option value="">-- Please Select Status --</option>
                    </select>
                  </div>
                </div>
 

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


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var category = "<?php echo $inventory["category"];?>";
  var section = "<?php echo $inventory["section"];?>";
  var inven_status = "<?php echo $inventory["inven_status"];?>";
  var type = "<?php echo $inventory["type"];?>";
  var owner_name = "<?php echo $inventory["owner_name"];?>";
  var expire_date = "<?php echo $inventory["expire_date"];?>";
  
  var brand = "<?php echo $inventory["brand"];?>";
  var os_name = "<?php echo $inventory["os_name"];?>";
  var cpu_model = "<?php echo $inventory["cpu_model"];?>";
  var ram_model = "<?php echo $inventory["ram_model"];?>";
  var hdd_model = "<?php echo $inventory["hdd_model"];?>";
  var monitor_model = "<?php echo    escapetohtml($inventory["monitor_model"])  ;?>";

</script>

<script>
var arr_type = <?php echo json_encode($types);?>;
var arr_brand = <?php echo json_encode($brand);?>;
var arr_cate = <?php echo json_encode($categorys);?>;
var arr_sec = <?php echo json_encode($sections);?>;
var arr_stat = <?php echo json_encode($statuss);?>;
var arr_os = <?php echo json_encode($osnames);?>;
</script>

<?php 

unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
