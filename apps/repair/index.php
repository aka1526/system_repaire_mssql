<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "repair";
  $ord =" order by id desc";
  $repair = fetch_all($fields, $table, $ord);
  $arr_repair_id = array();
  foreach($repair as $v){
    $arr_repair_id[] = $v["id"];
  }

  $r_id = implode(",", $arr_repair_id);

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


if(!empty($repair)){
  $conditions = " WHERE repair_id IN ($r_id) ";
  $repair_details = fetch_all("*","repair_detail", $conditions);
  $arr_repair_detail = array();
  $arr_repair_detail_status = array();
  foreach($repair_details as $repair_detail){
    $arr_repair_detail[] = $repair_detail;
    $arr_repair_detail_status[$repair_detail["repair_id"]] = $repair_detail["status_id"];
  }
}


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
            <li class="breadcrumb-item active">Repair</li>
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
            <div class="card-header">
              <a href="?page=repair/add" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i>
                New Repair</a>
            </div>
            <div class="card-body">
           
              <form action="apps/repair/do_repair.php?action=delete_all" id="frm" method="POST">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th></th>
                        <th>Date</th>
                        <th>inventory</th>
                        <th>Problem</th>
                        <th>Description</th>
                        <th>Repairer</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                 $i = 1;
    
                  foreach($repair as $repair){
                    
                    if($repair["doc_status"] == 1){
                      $bg = "warning";
                    }elseif($repair["doc_status"] == 2){
                      $bg = "success";
                    
                  }elseif($repair["doc_status"] == 3){
                    $bg = "warning";
                  }
                  else{
                      $bg = "danger";
                    }
                   
                  
                   
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td class="text-center">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checK_<?php echo $i;?>" name="ch[]"
                              value="<?php echo $repair["id"];?>">
                            <label for="checK_<?php echo $i;?>">
                            </label>
                          </div>
                        </td>
                        <td><?php echo  showDate($repair["doc_date"]) ;?></td>
                        <td><?php echo $inventory_txt[$repair["inventory_id"]];?></td>
                        <td><?php echo $pro_txt[$repair["problem"]];?></td>
                        <td><?php echo $repair["description"];?></td>
                       
                        <td><?php echo  $repair["repairer"] ;?></td>
                        <td><span class="badge badge-<?php echo $bg;?> badge-pill"><?php echo $status_txt[$repair["doc_status"]];;?></span></td>
                     
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                             
                            <small><a class="dropdown-item"
                                  href="?page=repair/view&inventory_id=<?php echo $repair["inventory_id"];?>"><i
                                    class="fas fa-search"></i> View</a></small>
                          
                              <small><a class="dropdown-item"
                                  href="?page=repair/edit&repair_id=<?php echo $repair["id"];?>"><i class="fas fa-edit"></i>
                                  Edit</a></small>
                             
                                 
                              <small><a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                  data-target="#modalDelete" data-repair-id="<?php echo $repair["id"];?>"
                                  data-repairname="<?php echo $repair["title"];?>"
                                  ><i class="fas fa-trash"></i>
                                  Delete</a></small>
                      
                            </div>
                          </div>
                        </td>
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
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATU"] : ""  ?>";
  var permission = "<?php echo $_SESSION["PERMISSION"] ?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
