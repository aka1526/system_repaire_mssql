<?php
  defined('APPS') OR exit('No direct script access allowed');
  
  

  if($_svhost=="mysql"){ 
  $query=" select cal.id, CONCAT( cal.type , ':' , cal.title ,' ' ,inven.name) AS title, 
      start,end,color ,CONCAT( './?page=calendar&evenid=',cal.id) AS url ";
  } else {
    $query = " select cal.id, CONCAT( cal.[type] , ':' , cal.title ,' '  ,inven.name) AS title,
    [start],[end],color ,CONCAT( './?page=calendar&evenid=',cal.id) AS url  ";
    }
  $query .= " from calendar AS cal   left outer join inventory inven on inven.id =cal.inventory ";
  $calendars = fetch_query($query);

  $fields = "*";
  $table = "inventory";
  $conditions = " WHERE inven_status != '6' ";
  $inventorys = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "preventive";
  $conditions = " WHERE status = 'Y' ";
  $pmitem = fetch_all($fields, $table, $conditions);




?>
<style>
  .fc-event-time{
    display : none;
 }
 .fc-time{
   display : none;
}
  </style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Calendar Plan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Calendar</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
     
      <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Plan</h3>
                </div>
                <div class="card-body">
                   
  <form action="apps/calendar/do_calendar.php?action=save_section" 
  enctype="multipart/form-data" method="POST" autocomplete="off" >
    <input type="hidden" id="type" name="type" value="PM">

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inventory">Inventory</label>
              <select id="inventory" name="inventory" class="form-control">
                <option selected> Select inventory</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="pmitem">Preventive Maintenance</label>
              <select id="pmitem" name="pmitem" class="form-control">
                <option selected> Select Item</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="pmdate"> Plan Date</label>
              <input type="date" id="pmdate" name="pmdate" class="form-control" id="inputZip">
            </div>
            <div class="form-group col-md-3">
              <label for="set_color">Color</label>
              <select id="set_color" name="set_color" class="form-control">
                  <option>Select an Color</option>
                  
                  <option value="#8A2BE2" style='background-color:#8A2BE2' selected >BlueViolet</option>
                  <option value="#A52A2A" style='background-color:#A52A2A'>Brown</option>
                  <option value="#5F9EA0" style='background-color:#5F9EA0'>CadetBlue</option>
                  <option value="#7FFF00" style='background-color:#7FFF00'>Chartreuse</option>
                  <option value="#00FFFF" style='background-color:#00FFFF'>Cyan</option>
                  <option value="#DC143C" style='background-color:#DC143C'>Crimson</option>
                  <option value="#00008B" style='background-color:#00008B'>DarkBlue</option>
                  <option value="#FF8C00" style='background-color:#FF8C00'>DarkOrange</option>
                  <option value="#00BFFF" style='background-color:#00BFFF'>DeepSkyBlue</option>
                  <option value="#FF1493" style='background-color:#FF1493'>DeepPink</option>
                  <option value="#FF00FF" style='background-color:#FF00FF'>Fuchsia</option>
                  <option value="#20B2AA" style='background-color:#20B2AA'>LightSeaGreen</option>
                  <option value="#FF4500" style='background-color:#FF4500'>OrangeRed</option>
                  
            </select>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary">Save Plan</button>
        </form>
    
                  <!-- /input-group -->
                </div>
              </div>
              </div>
        <div class="row">
        
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar" style="width: 100%; display: inline-block;"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

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


<script>
 
var arr_cal = <?php echo json_encode($calendars );?>;
var arr_inven = <?php echo json_encode($inventorys );?>;
var arr_pm = <?php echo json_encode($pmitem);?>;

</script>


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var permission = "<?php echo $_SESSION["PERMISSION"] ?>";
   
</script>
<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
 


 