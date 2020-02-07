<?php
  $fields = "*";
  $table = "events";
  $events_info = fetch_all($fields, $table);
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Events</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Events</li>
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
              <a href="?page=events/add" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i> New Event</a>
            </div>
            <div class="card-body">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Banner</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  foreach($events_info as $v){
                ?>
                  <tr>
                    <td>1</td>
                    <td><img src="uploads/events/Cover.jpg" alt="" class="img-fluid img-thumbnail" width="160" height="160"></td>
                    <td><?php echo $v["name"];?></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <small><a class="dropdown-item" href="?page=events/view&id=<?php echo $v["event_id"];?>"><i class="fas fa-search"></i> View</a></small>
                          <small><a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Edit</a></small>
                          <small><a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a></small>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
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
