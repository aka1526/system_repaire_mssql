<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "repair";
  $req = array(
    "repair_id" => $_GET["repair_id"]
  );
  $value = " WHERE id = :repair_id ";
  $repair = fetch_all($fields,$table,$value,$req);
  if(!empty($repair)){
    $repair = $repair[0];
  }else{
    header("location:./?page=repair");
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
  $table = "status";
  $status = fetch_all($fields, $table);
  $status_name = array();
  foreach($status as $v){
    $status_name[$v["id"]] = $v["name"];  
  }

  $inventory = fetch_all("*","inventory");
  $inventory_cate = array();
  $inventory_type = array();
  $inventory_brand = array();
  $inventory_id = array();
  foreach($inventory as $v){
    $inventory_cate[$v["id"]] = $v["category"];
    $inventory_type[$v["id"]] = $v["type"];
    $inventory_brand[$v["id"]] = $v["brand"];
    $inventory_id[$v["id"]] = $v["id"];
  }

  $fields = "*";
  $table = "repair_detail";
  $conditions = " WHERE repair_id = '".$repair["id"]."' order by updated_at desc ";
  $repair_details = fetch_all($fields, $table, $conditions);

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Repair</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=repair">Repair</a></li>
            <li class="breadcrumb-item active"><?php echo $repair["id"];?></li>
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
  
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="info">
                  <form id="forminfo" class="form-horizontal" action="apps/repair/do_repair.php?action=update_repair"
                    method="POST" autocomplete="off">
                    <input type="hidden" id="repair_id" name="repair_id" value="<?php echo $repair["id"];?>">
                   
                <div class="form-group row">
                  <label for="inven" class="col-sm-2 col-form-label">Inventory <span class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <select name="inven" id="inven" class="form-control" disabled>
                        <option value="">-- Please Select Inventory --</option>
                      </select>
                  </div>
                </div>

                
                
                <div class="form-group row">
                  <label for="repairer" class="col-sm-2 col-form-label">Repairer/ผู้แจ้งซ่อม <span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="repairer" name="repairer" value="<?php echo $repair["repairer"];?>"
                      placeholder="Repairer/ผู้แจ้งซ่อม" readonly>
                  </div>
                </div>

 
                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label">Description <span
                      class="text-danger"></span></label>
                  <div class="col-sm-10">
                    <textarea readonly name="description" id="Description"rows="5" class="form-control"><?php echo $repair["description"];?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label">Update Document </label>
                  <div class="col-sm-10 text-left">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">Update Repair</button>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Doc Status</th>
                          <th>Note</th>
                          <th>Amount</th>
                          <th>Break Down</th>
                          <th>technician</th>
                         	<th>Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($repair_details as $v){?>
                        <tr>
                          <td><?php echo $status_name[$v["status_id"]];?></td>
                          <td><?php echo $v["note"];?></td>
                          <td><?php echo $v["amount"];?></td>
                          <td><?php echo $v["breakdown"];?></td>
                          <td><?php echo $v["user_name"];?></td>
						              <td><?php echo $v["updated_at"];?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Save</button>
                      </div>
                    </div>
                  </form>
                </div>
             
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
            <div class="card-footer">
              <?php echo $repair["updated_at"];?>
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


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="apps/repair/do_repair.php?action=created_detail" method="POST">
      <?
      $btndisable= $repair["doc_status"];
     
      $btn_status="";
      $readonly="";
      if($btndisable==6){
        $btn_status="disabled";
        $readonly="readonly";
      }
      ?>
      <div class="modal-body">
           <input type="hidden" name="repair_id" value="<?php echo $repair["id"];?>">
           <input type="hidden" name="inventory_id" value="<?php echo $repair["inventory_id"];?>">
           <input type="hidden" name="problem" value="<?php echo $repair["problem"];?>">

          <div class="form-group">
            <label for="status" class="col-form-label">Status:</label>
           
            <select name="status" id="status" class="form-control" <?=$btn_status ; ?>>
            <option value="">-- Please Select Status --</option>
            </select>
          </div>

          <div class="form-group">
            <label for="status" class="col-form-label">Amount:</label>
            <input type="number" class="form-control "
                     id="amount" name="amount" value="0" placeholder="Amount"  
                      aria-invalid="false" <?=$readonly ; ?>>
          </div>

          <div class="form-group">
            <label for="breakdown" class="col-form-label">Breakdown(Minute):</label>
            <input type="number" class="form-control "
                     id="breakdown" name="breakdown" value="0" placeholder="Breakdown Minute "  
                      aria-invalid="false" <?=$readonly ; ?> >
          </div>

           
          <div class="form-group">
            <label for="note" name="note" class="col-form-label">Action to DO:</label>
            <textarea class="form-control" id="note" name="note" <?=$readonly ; ?>></textarea>
          </div>
        
      </div>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" <?=$btn_status;?>>Add</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
var arr_cate = <?php echo json_encode($categorys);?>;
var arr_type = <?php echo json_encode($types);?>;
var arr_status = <?php echo json_encode($status);?>;
var arr_brand = <?php echo json_encode($brand);?>;
var arr_inven = <?php echo json_encode($inventory);?>;
</script>


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var doc_status = "<?php echo  $repair["doc_status"];?>";
  var category = "<?php echo $inventory_cate[$repair["inventory_id"]];?>";
  var type = "<?php echo $inventory_type[$repair["inventory_id"]];?>";
  var brand = "<?php echo $inventory_brand[$repair["inventory_id"]];?>";
  var inven = "<?php echo $inventory_id[$repair["inventory_id"]];?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>