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
 


  
  $fields = "SUM(case when category !='' then 1 else 0 end) as total";
  $table = "inventory";
  $value = "";
  $sumtotal = 0;
  $categorysum = fetch_all($fields, $table, $value);
  foreach($categorysum as $_sumtotal){
    $sumtotal= $_sumtotal["total"];
  }

  $fields = "SUM(case when inven_status in(1,6) then 1 else 0 end) as total";
  $table = "inventory";
  $value = "  ";
  $ready = 0;
  $category_total = fetch_all($fields, $table, $value);
  foreach($category_total as $_total){
    $ready= $_total["total"];
  }
 
  
  $fields = "SUM(case when inven_status in(2,4) then 1 else 0 end) as total";
  $table = "inventory";
  $value = "";
  $broken = 0;
  $category_broken= fetch_all($fields, $table, $value);
  foreach($category_broken as $bk){
    $broken= $bk["total"];
  }
 
  $fields = "SUM(case when inven_status =3 then 1 else 0 end) as total";
  $table = "inventory";
  $value = "";
  $repaire = 0;
  $category_repaire= fetch_all($fields, $table, $value);
  foreach($category_repaire as $re){
    $repaire= $re["total"];
  }
 
 
  $fields = "name";
  $table = "category";
  $value = " order by id";
 
  $category_lable= fetch_all($fields, $table, $value);
   $lbl_txt = array();
  foreach($category_lable as $lbl){
     $lbl_txt[]= $lbl["name"];
  
  }

  
 

  $fields = " count(inve.id)total   ";
  $table = " category cat left outer join inventory inve on inve.category=cat.id";
  $value = " group by cat.id  order by cat.id";
 
  $category_lable_val= fetch_all($fields, $table, $value);
 
  $lbl_txt_val = array();
  foreach($category_lable_val as $lbl_val){
     $lbl_txt_val[]= $lbl_val["total"];
  
  }


if($db_config['DB_type'] =="mysql"){
    
  $query = "  select ifnull(total,0)m_total from( select '1' AS'month'
	UNION ALL  select '02' AS 'month' 
	UNION ALL select '03'AS 'month' 
	UNION ALL select '04' AS 'month'
	UNION ALL select '05' AS 'month' 
	UNION ALL select '06' AS 'month' 
	UNION ALL select '07' AS 'month'
	UNION ALL select '08' AS 'month' 
	UNION ALL select '09' AS 'month' 
	UNION ALL select '10' AS 'month'
	UNION ALL select '11'AS  'month'  
	UNION ALL select '12' AS 'month' ) allm
	left outer join 
		(
						SELECT DATE_FORMAT(doc_date, '%m') AS months , COUNT(*)as total
						FROM repair 
						WHERE DATE_FORMAT(doc_date, '%Y')= DATE_FORMAT(CURRENT_DATE, '%Y') 
						GROUP BY DATE_FORMAT(doc_date, '%Y'), DATE_FORMAT(doc_date, '%m')
		 ) re on re.months=allm.month ; ";
} else {

  $query = " select isnull(total,0)m_total from( select '1' 'month'
	UNION ALL  select '2' 'month' UNION ALL select '3' 'month' UNION ALL select '4' 'month'
	UNION ALL select '5' 'month' UNION ALL select '6' 'month' UNION ALL select '7' 'month'
	UNION ALL select '8' 'month' UNION ALL select '9' 'month' UNION ALL select '10' 'month'
	UNION ALL select '11' 'month'  UNION ALL select '12' 'month' ) allm
	left outer join (
	SELECT    DATEPART(MONTH, doc_date)as months, COUNT(*)as total
    FROM  repair 
	where   DATEPART(YEAR,doc_date) =DATEPART(YEAR, GETDATE())
		group by DATEPART(YEAR, doc_date), DATEPART(MONTH, doc_date)
   ) re on re.months=allm.month ";
}

  $repaire_month_val= fetch_query($query);
 
  $m_txt_val = array();
  foreach($repaire_month_val as $m_val){
     $m_txt_val[]= $m_val["m_total"];
  
  }
 
 $query="select inventory.section,min(sec.name)name ,count(*)as 'asset' 
		from inventory 
		left outer join section sec on sec.id = inventory.section
		where category in(1,2)
		group by inventory.section";
$sec_asset= fetch_query($query);
 
   $total_asset = array();
  foreach($sec_asset as $asset){
     $total_asset[]= $asset["asset"];
  
  }
		
 $asset_lbl = array();
  foreach($sec_asset as $_name){
     $asset_lbl[]= $_name["name"];
  
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
          <h1 class="m-0 text-dark">Charts of Inventory</h1>
         
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Charts</li>
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
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ทั้งหมดรวม</span>
                <span class="info-box-number"><?=$sumtotal ;?> Unit</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
              <span class="info-box-text">ใช้งาน</span>
                <span class="info-box-number"><?=$ready ;?> Unit</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">อยู่ระหว่างซ่อม</span>
                <span class="info-box-number"><?=$repaire;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
              <span class="info-box-text">เสีย/จำหน่าย 
                <span class="info-box-number"><?= $broken;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-6">
            
          

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">InventoryChart</h3>

                <div class="card-tools">
                  <button type="button" disabled class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" disabled class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="inventoryChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
 

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Repaire this Year <? echo date("Y"); ?></h3>

                <div class="card-tools">
                  <button type="button" disabled class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" disabled class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
               <div class="col-md-12">
            
            <!-- BAR CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Summary Computer Year <? echo date("Y"); ?></h3>

                <div class="card-tools">
                  <button type="button" disabled class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" disabled class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChartasset" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         

          </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
 
  
 var arr_lable = <?php echo json_encode($lbl_txt);?>;
 var arr_lable_val   = <?php echo json_encode($lbl_txt_val);?>;
 var arr_repaire_month   = <?php echo json_encode( $m_txt_val);?>;
 var arr_sec_total_asset  = <?php echo json_encode($total_asset);?>;
 var arr_asset_lbl   = <?php echo json_encode( $asset_lbl);?>;

</script>

 

<script type="text/javascript">
   
  var search = "<?php echo  isset($_REQUEST["search"]) ? $_REQUEST["search"] :"" ;?>";
 
</script>