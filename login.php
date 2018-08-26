<?php
include_once 'core/init.php';

Html::start('Alumni System | Login Page');

$user = new User();


if($user->isLoggedIn()){
  Redirect::to('index.php');
}

if(Input::exists()){
  if(Input::get('signup')){
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
        $salt = Hash::salt(64);
        $record->create([
            'username'      => Input::get('username'),
            'password'      => Hash::make(Input::get('password'), $salt),
            'salt'          =>  $salt,
            'first_name'    => Input::get('first_name'),
            'last_name'     => Input::get('last_name'),
            'email'         => Input::get('email'),
            'user_type'     => 4,
            'online'        =>  0,
            'year_of_graduation'    =>  Input::get('year_of_graduation'),
            'phone_number'          =>  Input::get('phone_number'),
            'place_of_work'         =>  Input::get('place_of_work'),
            'department'            =>  Input::get('department'),
            'address'               =>  Input::get('address'),
            'profile_picture' =>  'images/male.jpg'

        ]);

        $new_user = new User(Input::get('username'));
        $allusers = new User();
        $all = $allusers->activeRecord()->read()->results();

        $chat_event = new ChatEvent();
        foreach ($all as $key ) {
          if($new_user->activeRecord()->getId() != $key->id)
          {$chat_event->activeRecord()->create([
              'user1'			  => $new_user->activeRecord()->getId(),
              'user2'			  => $key->id,
              'currentChatTime' => 0,
              'lastCheckedTime' => 0

          ]);
          }
        }


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
  else if(Input::get('login')){


    $validate = new Validation();

    $validation = $validate->check($_POST, [
        'username' => [
            'required' => true
        ],
        'password' => [
            'required'  => true
        ],
    ]);

    if($validation->passed()){
      $user = new User();
      $remember = (Input::get('remember') === 'on')? true : false;
      $login = $user->login(Input::get('username'), Input::get('password'), $remember);

      if($login){
        Redirect::to('index.php');
      }else{
        Session::flash('login',$user->errors());
      }
    }
    else print_r($validation->errors());

  }

}




?>

<body>
<?php

    Template::start();

?>

<div class="row">
  <div class="container">
    <?php

    Template::tabs();

    ?>
    <div  class="col-md-12">
      <div class="login-header">
      </div>


      <?php


      if(Session::exists('login')){
        echo'<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Error</h4>
              '.Session::flash('login').'
            </div>
            
            ';
      }
      ?>


      <?php


      if(Session::exists('signup')){
        echo'<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Error</h4>
              '.Session::flash('signup').'
            </div>
            
            ';
      }
      ?>


      <div class="col-md-12 ">
        <div style="margin-top: 50px">
          <div class="login">


            <div class="clearfix"></div>
            <div class="login-lines">
            </div>

            <div class="clearfix"></div>

            <div class="main-login-form">
              <form method="post" action="">
                <div class="form-group has-feedback" >
                  <label class="">
                    Username:
                  </label>
                  <input class="form-control" type="text" name="username">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>

                </div>
                <div class="form-group has-feedback">
                  <label>Password:</label>
                  <input class="form-control" type="password" name="password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                  <input type="hidden" name="login" value="true">
                </div>
                <div>
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </form>
            </div>

            <div class="main-signup-form">
              <form method="post" action="">
                <div class="form-group has-feedback" id="first">
                  <label>First Name:</label>
                  <input type="text" class="form-control" name="first_name" id="first_name" required placeholder="First Name">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <div style="color:red;" id="first_text"></div>
                </div>
                <div class="form-group  has-feedback" id="last">
                  <label>Last Name:</label>
                  <input type="text" class="form-control" name="last_name" id="last_name" required placeholder="Last Name">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <div style="color:red;" id="last_text"></div>

                </div>
                <div class="form-group has-feedback" id="user">
                  <label>Username:</label>
                  <input type="text" class="form-control" name="username" id="username" required placeholder="username">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <div style="color:red;" id="username_text"></div>
                  <div style="color:green;" id="username_text2"></div>

                </div>
                <div class="form-group has-feedback" id="mail">
                  <label>Email:</label>
                  <input type="text" id="email" class="form-control" name="email" required placeholder="Email">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  <div style="color:red;" id="email_text"></div>

                </div>
                <label>Password:</label>

                <div id="pass" class="form-group has-feedback">
                  <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  <div style="color:red;" id="password_text"></div>
                </div>
                <input type="hidden" name="signup" value="True">
                <div class="form-group has-feedback" id="pass_again">
                  <label>Retype Password:</label>
                  <input type="hidden" name="signup" value="true">

                  <input type="password" class="form-control" id="password_again" name="password_again" required placeholder="Retype password">
                  <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  <div style="color:red;" id="password_again_text"></div>
                </div>
                <div class="form-group">
                  <label for="">Phone Number</label>
                  <input type="text" class="form-control" id="" name="phone_number" required placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <label for="">Year of Graduation</label>
                  <input type="number" class="form-control" id="" name="year_of_graduation" required placeholder="Year Of Graduation">
                </div>
                <div class="form-group">
                  <label for="">Place Of Work</label>
                  <input type="text" class="form-control" id="" name="place_of_work" required placeholder="Place Of Work">
                </div>
                <div class="form-group">
                  <label for="">Department</label>
                  <input type="text" class="form-control" id="" name="department" required placeholder="department">
                </div>
                <div class="form-group">
                  <label for="">Address</label>
                  <input type="text" class="form-control" id="" name="address" required placeholder="address">
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Sign Up</button>
              </form>
            </div>

          </div>
        </div>
        <div class="login">
          <div class="login-talk">
            <p align="center" style="margin-top: 20px">You don't have an account? <a href="#sign-up">Sign Up</a> </p>
          </div>
          <div class="signup-talk">
            <p align="center" style="margin-top: 20px">Already have an account? <a href="#sign-up">Sign In</a> </p>
          </div>
        </div>



      </div>
    </div>
  </div>
</div>

</div>



</div>

</body>

<?php
Html::end();

?>
