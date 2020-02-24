<?php
  defined('APPS') OR exit('No direct script access allowed');
  
 
  $fields = "*";
  $table = "services";
  $req = array(
    "row_index" => $_GET["row_index"],
  );
  $value = " WHERE row_index = :row_index ";
  $services = fetch_all($fields,$table,$value,$req);
  
 
 if(!empty($services)){
    $services = $services[0];
  }else{
     header("location:./?page=services");
    exit();
  }
  
  
  $fields = "*";
  $table = "inventory";
  $inventorys = fetch_all($fields,$table  );
  
  $inven_txt = array();
  foreach($inventorys as $inventory){
    $inven_txt[$inventory["id"]] = $inventory["name"];
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
 $sec_txt = array();
  foreach($sections as $section){
    $sec_txt[$section["id"]] = $section["name"];
  }
 
 
  $fields = "*";
  $table = "status";
  //$conditions = " WHERE status = 'Y' ";
  $conditions = "   ";
  $statuss = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "osname";
  $conditions = " WHERE status = 'Y' ";
  $osnames = fetch_all($fields, $table, $conditions);


  $fields = "line_token";
  $table = "system";
  $value = " WHERE id = '1' ";
  $_token = fetch_all($fields, $table, $value);
  $line_token = "";
  foreach($_token as $token){
   $line_token=$token["line_token"];
  }
  
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Borrowing system</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=services/add">Borrowing</a></li>
            <li class="breadcrumb-item active"><?php echo isset($inventory["name"]) ? $inventory["name"] :"-";?></li>
			
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
                action="apps/services/do_services.php?action=rec_services" method="POST" autocomplete="off">
                 <input type="hidden" name="line_token" id="line_token" value="<?php echo $line_token;?>"> 
				 <input  type="hidden" name="type_in" 	id="type_in"  	value="0">
				 <input  type="hidden" name="type_out" 	id="type_in"   	value="1">
				 <input  type="hidden" name="type_name" id="type_name" 	value="REC">
				 <input  type="hidden" name="inven_id" 	id="inven_id"  	value="<?php echo $services["inven_id"];?>">
				 <input  type="hidden" name="sec_id" 	id="sec_id"  	value="<?php echo $services["sec_id"];?>">
				 <input  type="hidden" name="row_refer" id="row_refer" value="<?php echo $services["row_index"];?>">
				 
				 
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                  <?php 
				  $photo = isset($inventory["photo"]) ?$inventory["photo"] :"";
				  if($photo !=""){ ?>
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
                  <label for="inventory" class="col-sm-2 col-form-label">inventory<span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control"  id="inventory" name="inventory" value="<?php echo $inven_txt[$services["inven_id"]] ;?>" readonly >
                  </div>
                </div>
               

                <div class="form-group row">
                  <label for="borrow_name" class="col-sm-2 col-form-label">Return Name  /ชื่อผู้คืน
                   </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="borrow_name" name="borrow_name" value="<?php echo $services["borrow_name"];?>" required>
                  </div>
                </div>
              
                <div class="form-group row">
                  <label for="section" class="col-sm-2 col-form-label">Section/แผนก <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="section" name="section"   value="<?php echo $sec_txt[$services["sec_id"]];?>" readonly >
                  </div>
                </div>
 
               
                <div class="form-group row">
                  <label for="remark" class="col-sm-2 col-form-label">Reason/เหตุผล<span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="remark" name="remark" value="<?echo $services["remark"] ;?>"    readonly >
                  </div>
                </div>
 
				
				  <div class="form-group row">
                  <label for="doc_refer" class="col-sm-2 col-form-label"> วันที่ส่งคืน<span
                      class="text-danger"></span>
					</label>
                  <div class="col-sm-10">
                    <input class="form-control"  type="date" name="due_date" id="due_date"  required  >
                  </div>
                </div>
				
				
				
                <div class="form-group row">
                  <label for="doc_refer" class="col-sm-2 col-form-label"> Doc/เอกสารอ้างอิง <span
                      class="text-danger"></span>
					</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="doc_refer" name="doc_refer"   placeholder="Doc/เอกสารอ้างอิง"  >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tel" class="col-sm-2 col-form-label">Tel /เบอร์ติดต่อ<span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="tel" name="tel"placeholder="Tel /เบอร์ติดต่อ"  >
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
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ;?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : "" ; ?>";
  var section = "<?php echo isset($inventory["section"]) ? $inventory["section"] :"";?>";
  var inven_id = "<?php echo  isset($services["inven_id"]);?>";
  

</script>

<script>
var arr_inven = <?php echo json_encode($inventory);?>;
var arr_type = <?php echo json_encode($types);?>;
var arr_brand = <?php echo json_encode($brand);?>;
var arr_cate = <?php echo json_encode($categorys);?>;
var arr_sec = <?php echo json_encode($sections);?>;
var arr_stat = <?php echo json_encode($statuss);?>;
var arr_os = <?php echo json_encode($osnames);?>;
</script>

<?php 

unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
