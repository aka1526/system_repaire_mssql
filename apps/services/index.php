<?php
  defined('APPS') OR exit('No direct script access allowed');
 
  $sql = "  SELECT  *   FROM services
		where row_index in (SELECT  min(row_index)row_index 
	  FROM  services    group by row_refer having count(*)<2)  ";
  $services = fetch_query($sql);

  $fields = "*";
  $table = "brand";
  // $value = " WHERE status = 'Y' ";
  $value = "";
  $brands = fetch_all($fields, $table, $value);
  $brand_txt = array();
  foreach($brands as $brand){
    $brand_txt[$brand["id"]] = $brand["name"];
  }

  $fields = "*";
  $table = "section";
  // $value = " WHERE 1=1 order by name ";
  $value = "";
  $sections = fetch_all($fields, $table, $value);
  $sec_txt = array();
  foreach($sections as $section){
    $sec_txt[$section["id"]] = $section["name"];
  }

  $fields = "*";
  $table = "category";
  // $value = " WHERE status = 'Y' ";
  $value = "";
  $categorys = fetch_all($fields, $table, $value);
  $cate_txt = array();
  foreach($categorys as $category){
    $cate_txt[$category["id"]] = $category["name"];
  }


 $fields = "*";
  $table = "inventory";
  // $value = " WHERE status = 'Y' ";
  $value = "";
  $inventorys = fetch_all($fields, $table, $value);
  $inven_txt = array();
  foreach($inventorys as $inventory){
    $inven_txt[$inventory["id"]] = $inventory["name"];
  }




  $fields = "*";
  $table = "type";
  // $value = " WHERE status = 'Y' ";
  $value = "";
  $types = fetch_all($fields, $table, $value);
  $type_txt = array();
  foreach($types as $type){
    $type_txt[$type["id"]] = $type["name"];
  }

  
  $fields = "*";
  $table = "status";
  // $value = " WHERE status = 'Y' ";
  $value = "";
  $stats = fetch_all($fields, $table, $value);
  $stat_txt = array();
  foreach($stats as $stat){
    $stat_txt[$stat["id"]] = $stat["name"];
  }

  $fields = "*";
  $table = "osname";
  $w = " WHERE status = 'Y' ";
  $oss = fetch_all($fields, $table, $w);
  $os_txt = array();
  foreach($oss as $os){
    $os_txt[$os["os_id"]] = $os["os_name"];
  }


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
          <h1 class="m-0 text-dark">รายการค้างคืน</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">รายการค้างคืน</li>
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
              <form action="apps/inventory/do_inventory.php?action=delete_all" id="frm" method="POST">
                <input type="hidden" name="line_token" id="line_token" value="<?php echo $line_token;?>"> 

			   <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
						<th class="text-center">Date</th>
						<th>ID.</th>
                        <th>Name</th>
                        <th>SECTION</th>
                        <th>TYPE</th>
                       
                        <th>REMARK</th>
                        <th>DOC REFER</th>
                        <th>TEL.</th>
                        <th>DUE.</th>
						 <th>คืน</th>
                        <th>Date Time</th>
                 
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                $i = 1;
 
                  foreach($services as $v){
					   $type_name="";
					  if(trim($v["type_name"])=="ISSUE"){
						  $type_name="ยืม";
					  }else if(trim($v["type_name"])=="REC"){
						  $type_name="คืน";
					  }
                    
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo showdate($v["docdate"]);?></td>
						<td><?php echo  $inven_txt[$v["inven_id"]];?></td>
                        <td><?php echo $v["borrow_name"];?></td>
                        <td><?php echo $sec_txt[$v["sec_id"]];?></td>
                        <td><?php echo $type_name;?></td>
                        
                        <td><?php echo $v["remark"];?></td>
                        <td><?php echo $v["doc_refer"];?></td>
                        <td><?php echo $v["tel"];?></td>
                        <td><?php echo showdate($v["due_date"]);?></td>
						 <td>  <a class="btn btn-danger btn-sm" href="?page=services/rec&row_index=<?=$v["row_index"];?>" role="button"> <i class="fas fa-angle-double-right"></i> คืน</a></td>
                        <td><?php echo showdatetime($v["create_date_time"]);?></td>
                       
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

            
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

<?php 

unset($_SESSION["STATUS"],$_SESSION["MSG"]); 


?>
