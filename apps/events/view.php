<?php
  $stmt = $conn->prepare("SELECT * FROM events WHERE event_id = :id");
  $stmt->bindValue(":id", $_GET["id"]);
  $result = $stmt->execute();
  $profile_info = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"></h1>
        </div> <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=events">Events</a></li>
            <li class="breadcrumb-item active">View Events</li>
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
            <div class="card-header">
              <h5 class="m-0"><?php echo $profile_info["name"];?></h5>
            </div>
            <div class="card-body">
              <?php echo $profile_info["description"];?>
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
