<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "repair_detail";
  $req = array(
    "inventory_id" => $_GET["inventory_id"]
  );
  
  $value = " WHERE inventory_id = :inventory_id  order by id desc ";
  $repair  = fetch_all($fields,$table,$value,$req);
   $arr_repair_id = array();
  foreach($repair as $v){
    $arr_repair_id[] = $v["id"];
  }

  //$r_id = implode(",", $arr_repair_id);

  $inventory = fetch_all("*","inventory");
  $inventory_txt = array();
  foreach($inventory as $inven){
    $inventory_txt[$inven["id"]] = $inven["name"];
  }

  $users = fetch_all("*","users");
  $users_txt = array();
  foreach($users as $user){
    $users_txt[$user["id"]] = $user["first_name"]." ".$user["last_name"];
  }

  $r_status = fetch_all("*","status");
  $status_txt = array();
  foreach($r_status as $status){
    $status_txt[$status["id"]] = $status["name"];
  }

  $problem = fetch_all("*","problem");
  $pro_txt = array();
  foreach($problem as $pro){
    $pro_txt[$pro["id"]] = $pro["name"];
  }

 

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">History Repair </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">History</li>
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
<?php

// echo "<pre>";
// print_r($arr_repair_detail);
// echo "</pre>";

?>
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card">
             
            <div class="card-body">
           
              <form action="apps/repair/do_repair.php?action=delete_all" id="frm" method="POST">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        
                        <th>Date</th>
                        <th>inventory</th>
                        <th>Problem</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Break Down</th>
                        <th>Repairer</th>
                        <th>Date Time</th>
                        <th>Status</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                 $i = 1;
    
                  foreach($repair as $repair){
                    
                    if($repair["status_id"] == 1){
                      $bg = "warning";
                    }elseif($repair["status_id"] == 2){
                      $bg = "success";
                    
                  }elseif($repair["status_id"] == 3){
                    $bg = "warning";
                  }
                  else{
                      $bg = "danger";
                    }
                   
                  
                   
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                       
                        <td><?php echo  showDate($repair["doc_date"]) ;?></td>
                        <td><?php echo $inventory_txt[$repair["inventory_id"]];?></td>
                        <td><?php echo $pro_txt[$repair["problem_id"]];?></td>
                        <td><?php echo $repair["note"];?></td>
                        <td><?php echo $repair["amount"];?></td>
                        <td><?php echo $repair["breakdown"];?></td>
                        
                        <td><?php echo  $repair["user_name"] ;?></td>
                        <td><?php echo  $repair["updated_at"] ;?></td>
                        <td><span class="badge badge-<?php echo $bg;?> badge-pill"><?php echo $status_txt[$repair["status_id"]];;?></span></td>
                      
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATU"] : ""  ?>";
  var permission = "<?php echo $_SESSION["PERMISSION"] ?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
