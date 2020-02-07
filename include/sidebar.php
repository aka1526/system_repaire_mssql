<?php
$arr_users = array("users","users/add","users/edit");
$arr_repair = array("repair","repair/add","repair/edit");
$arr_dashboard = array("dashboard");
$arr_system = array("system");

$arr_settings = array("category","section","types","brand","osname","status","inventory", "inventory/add","inventory/edit");
$arr_category = array("category");
$arr_section = array("section");
$arr_types = array("types");
$arr_status = array("status");

$arr_osname = array("osname");

$arr_brand = array("brand");

$arr_inventory = array("inventory","inventory/add","inventory/edit");

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="./" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo $system["name"];?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if(!empty($_SESSION["PROFILE"])){ ?>
        <?php if(file_exists("uploads/users/".$_SESSION["PROFILE"])){ ?>
        <img src="uploads/users/<?php echo $_SESSION["PROFILE"];?>" class="img-circle elevation-2" alt="Profile-img"
          style="max-width:34px; max-height:34px; min-width:34px; min-height:34px;">
        <?php }else{ ?>
        <img src="dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
        <?php } ?>
        <?php }else{ ?>
        <img src="dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
        <?php } ?>


      </div>
      <div class="info">
        <a href="?page=profile" class="d-block"><?php echo $_SESSION["FIRST_NAME"] ." ". $_SESSION["LAST_NAME"];?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="?page=dashboard" class="nav-link <?php if(in_array($page, $arr_dashboard)){echo "active"; }?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=repair" class="nav-link <?php if(in_array($page, $arr_repair)){echo "active"; }?>">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Repair
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=users" class="nav-link <?php if(in_array($page, $arr_users)){echo "active"; }?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=system" class="nav-link <?php if(in_array($page, $arr_system)){echo "active"; }?>">
            <i class="nav-icon fas fa-sliders-h"></i>
            <p>
              System
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview <?php if(in_array($page, $arr_settings)){echo "menu-open"; }?>">
          <a href="#" class="nav-link <?php if(in_array($page, $arr_settings)){echo "active"; }?>">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?page=category" class="nav-link <?php if(in_array($page, $arr_category)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=section" class="nav-link <?php if(in_array($page, $arr_section)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Section</p>
              </a>
            </li>
			  <li class="nav-item">
              <a href="?page=types" class="nav-link <?php if(in_array($page, $arr_types)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=osname" class="nav-link <?php if(in_array($page, $arr_osname)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Operating System</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="?page=brand" class="nav-link <?php if(in_array($page, $arr_brand)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=status" class="nav-link <?php if(in_array($page, $arr_status)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Status</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="?page=inventory" class="nav-link <?php if(in_array($page, $arr_inventory)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Inventory</p>
              </a>
            </li>

          </ul>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0);" class="nav-link" data-toggle="modal" data-target="#logoutModal">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
