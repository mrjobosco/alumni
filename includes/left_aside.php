<?php
    $u = new User();
?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="images/avatar/male.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?= $u->activeRecord()->data()->first_name.' '.$u->activeRecord()->data()->last_name;?></p>
              </div>
          </div>
          <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
          <li>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Home</span>
              </a>
            </li>
            <?php
            if($user->isAdmin()){
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Manage Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usermanagement.php"><i class="fa fa-calendar-o"></i> Manage Users</a></li>
                <li><a href="usermasterlist.php"><i class="fa fa-hourglass-half"></i> Users Masterlist</a></li>

                </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-diamond"></i>
                <span>Manage Forum</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="managecategory.php"><i class="fa fa-book"></i> Manage Categories</a></li>
                </ul>
            </li>
           
            <?php
          }
            ?>          
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
