<?php
  defined('APPS') OR exit('No direct script access allowed');
 
  $fields = "*";
  $table = "inventory";
 
  $search= isset($_REQUEST["search"]) ? "%".$_REQUEST["search"]."%" : "%";
  $req = array(
    "id" => $search,
    "name" => $search,
  );
  $w = " WHERE (id like :id or name like :name )";
  $inventory = fetch_all($fields,$table,$w, $req  );

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
  $table = "osname";
  $value = " WHERE status = 'Y' ";
  $osnames = fetch_all($fields, $table, $value);
  $os_txt = array();
  foreach($osnames as $os){
    $os_txt[$os["os_id"]] = $os["os_name"];
  }


?>
<style>
ion-icon {
  font-size: 32px;
}
#ion {
  font-size: 32px;
}
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
         
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      
<!-- =========================================================== -->


<div class="row">

<?
$img="uploads/inventory/";
foreach($inventory as $v){
  $st=$v["inven_status"];
  
  if( $st=="1"){
    $bg="bg-info" ;
  } else  if( $st=="2"){
    $bg="bg-secondary" ;
  } else  if( $st=="3"){
    $bg="bg-warning" ;
  } else  if( $st=="4"){
    $bg="bg-danger" ;
  }



  
   
?>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box <?=$bg;?>">
              <span class="info-box-icon">
                <img id="photo_profile" class="img-fluid img-thumbnail" src="<?echo $img.$v["photo"];?>" width="200" height="200"   alt="Profile-img">
              </span>
              <div class="info-box-content">
                <span class="info-box-text"> <? echo $cate_txt[$v["category"]];?> : <strong><? echo $v["name"];?></strong></span>
                <span class="info-box-text">ผู้ใช้งาน :<strong><? echo $v["owner_name"];?></strong></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="info-box-text">OS :<? echo $os_txt[$v["os_name"]];?></span>
                <span class="info-box-text"> 
                <i onclick="myFunction('<?=$v['id'];?>')" class="fa fa-question-circle fa-lg" style="color:blueviolet;cursor:pointer;"></i>&nbsp;
                <i onclick="myRepaire('<?=$v['id'];?>')" class="fa fa-ambulance fa-lg" aria-hidden="true" style="color:blue;cursor:pointer;"></i>&nbsp;
                <i onclick="myHistory('<?=$v['id'];?>')" class="fa fa-history fa-lg" aria-hidden="true"  style="color:greenyellow;cursor:pointer;"></i>
              </span>

               

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

 <?
  } 
 ?>
          
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content -->
</div>
<script type="text/javascript">
   
  var search = "<?php echo  isset($_REQUEST["search"]) ? $_REQUEST["search"] :"" ;?>";
 
</script>