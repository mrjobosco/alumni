<?php include_once 'core/init.php';

$user = new User();
if(!$user->isLoggedIn()){
  Redirect::to('login.php');
}

$student = new User();
$all = $student->getUsers();
Html::start('Student Forum | Registered Users');
?>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S I</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Student Forum</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <?php include_once "includes/nav.php";?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'includes/left_aside.php';?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
            <small>View Registered Users</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <section>
            <?php
if(Session::exists('Home')){
echo'<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    '.Session::flash('Home').'
                  </div>';
                }


?>
        </section>   
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
            <div class="box-header with-border">
                  <div class="">
                  View Registered Users
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
          
              <div class="">
                 <table class="table table-condensed">
                    
                    <thead>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Email</th>
                      <th>User Type</th>
                     <th>Action</th>
                    </thead>
                   <?php 
                   foreach ($all as $key) {
                   
                   ?>
                   <tr>
                      <td class="col-sm-2"><a href=""><?= $key->first_name.' '.$key->last_name ?></a></td>
                      <td><div><?= $key->username ?> </div></td>
                      <td><div><?= $key->password?></div></td>
                      <td><div><?= $key->email?></div></td>
                      <td><?php if($key->user_type == 1 ) echo "Ädministrator";else echo "Student";?></td>
                      <td class="col-sm-2"><a href=""> Modify </a> |<a href=""> Delete</a></td>
                    </tr>
                    <?php 
                  }
                ?>
                  </table> 
               

              </div>

              </div><!-- /.box-body -->
          </div><!-- /.box -->
              </div>
          </div>
           </section>
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
  <?php Html::end();?>