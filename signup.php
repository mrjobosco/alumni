<?php
include_once 'core/init.php';

$errors = [];
$user = new User();
if($user->isLoggedIn()){
  Redirect::to('index.php');
}
if(Input::exists()){
  if(Token::check(Input::get('token')))
  {
    $validate = new Validation();

    $validation = $validate->check($_POST,[
      'username'=>[
      'required'=> true,
      'min'  => 3,
      'max'  => 20,
      'unique' => 'users',

      ],
      'password'=>[
      'required'=> true,
      'min' => 6,
      'max' => 20,

      ],
      'password_again'=>[
      'required' => true,
      'matches' => 'password'
      ],
      'first_name'=>[
      'required'  => true,
      'min' => 3,
      'max' => 20,
      ],
      'last_name'=>[
      'required' => true,
      'min' => 3,
      'max' => 20,
      ]
      ]);
    if($validation->passed()){
      $user = new User();

      $record = $user->activeRecord();
      try{
      $record->create([
        'username'      => Input::get('username'),
        'password'      => Input::get('password'),
        'first_name'    => Input::get('first_name'),
        'last_name'     => Input::get('last_name'),
        'email'         => Input::get('email'),
          'year_of_graduation'    =>  'nil',
          'phone_number'          =>  'nil',
          'place_of_work'         =>  'nil',
          'department'            =>  'nil',
          'address'               =>  'nil',
           'user_type'     => 4
        ]);


   
      Session::flash('Login','You have Successfully registered!');
      Redirect::to('index.php');
    }catch(Exception $e){
      die($e->getMessage());
    }


    }
    else{
      foreach ($validation->errors() as $error) {
        $errors[] = $error;
      }
        print_r($errors);
    }
  }


}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Forum | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
      <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page"> 
  <?php
if(Session::exists('signup')){
echo'<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Error</h4>
                  '.Session::flash('signup').'
                  </div>';
                }


?>
    <div class="register-box">
      
      <div class="register-box-body">
        <p class="signup-box-msg">Register a new membership</p>
        <form action="" method="post">
          <div class="form-group has-feedback" id="first">
            <input type="text" class="form-control" name="first_name" id="first_name" required placeholder="First Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <div style="color:red;" id="first_text"></div>
          </div>
          <div class="form-group has-feedback" id="last">
            <input type="text" class="form-control" name="last_name" id="last_name" required placeholder="Last Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
              <div style="color:red;" id="last_text"></div>
          </div>
          <div class="form-group has-feedback" id="user">
            <input type="text" class="form-control" name="username" id="username" required placeholder="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <div style="color:red;" id="username_text"></div>
          <div style="color:green;" id="username_text2"></div>
          </div>
          <div class="form-group has-feedback" id="mail">
            <input type="email" class="form-control" name="email" required placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <div style="color:red;" id="email_text"></div>
          </div>
          <div id="pass" class="form-group has-feedback">
            <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <div style="color:red;" id="password_text"></div>
          </div>
              <input type="hidden" name="token" value="<?= Token::generate();?>">
          <div class="form-group id="pass_again" has-feedback">
            <input type="password" class="form-control" id="pass_again" name="password_again" required placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          <div style="color:red;" id="password_again_text"></div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>

   
        <a href="login.php" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="signup.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '60%' // optional
        });
      });
    </script>
  </body>
</html>
