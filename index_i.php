<?php
include_once 'core/init.php';

Html::start('Alumni System | Homepage');

$user = new User();


if($user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Input::get('signup'))
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
<div class="container">
<div class="row">
    <div style="margin: 5px"></div>

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

    <div class="col-md-6"><img src="img/logo.png"></div>

    <div class="col-md-6">
        <div style="color: #009241; padding-top:45px; font-size: 1.3em" class="pull-right">Contact us on:
            <a href="mailto:ifo@cjinnovators.com"><i class="fa fa-fw fa-envelope"></i></a>
            <a href="tel:07037350494"><i class="fa fa-fw fa-phone"></i> </a>
        </div>
    </div>
</div>
</div>
<div style="margin: 5px"></div>
<nav class="navbar top-link" style="background-color:#009241; padding-bottom: 0; margin-bottom: 0 ">
    <div class="container" style="padding-bottom: 0; margin-bottom: 0" >
        <ul class="navbar-nav navbar-left top-link-links">




        </ul>


    </div>
    </nav>

<div class="background">
    <div class="welcome-note">

        <div class="note" style="height: 357px; width: 100%">

        </div>



        <div class="container" style="padding-bottom: 0; margin-bottom: 0 ">
        <div class="row" style="padding-bottom: 0; margin-bottom: 0 ">
            <div class="col-md-4" style="padding-bottom: 0; margin-bottom: 0 ">
                <div class="box box-danger" style="padding-bottom: 0; margin-bottom: 0 ">
                    <div class="box-header" style="background-color: red; color: white">
                        News and Announcement
                    </div>
                </div>



            </div>



            <div class="col-md-4">
                <div class="box box-danger" style="padding-bottom: 0; margin-bottom: 0 ">
                <div class="box-header" style="background-color: red; color: white">
                        Events
                    </div>
                </div>



            </div>


            <div class="col-md-4" style="padding-bottom: 0; margin-bottom: 0 ">
                <div class="box box-danger" style="padding-bottom: 0; margin-bottom: 0 ">
                <div class="box-header" style="background-color: red; color: white">
                        Login / Register
                    </div>


                </div>



            </div>





        </div>
            </div>


    </div>
</div>


<div class="container" style="padding-top: 0; margin-top: 0 ">
    <div class="row" style="padding-top: 0; margin-top: 0 ">
        <div class="col-md-4" style="padding-top: 0; margin-top: 0 ">
            <div class="box" style="padding-top: 0; margin-top: 0 ">
                             <div class="box-body" style="padding-top: 0; margin-top: 0 ">

                                 <?php
                                 $news = new News();

                                 $all_news = $news->activeRecord()->read()->results();

                                 foreach ($all_news as $new) {
                                     ?>
                                     <hr>
                                     <h4 class="heading-three text-info"><?= $new->title?></h4>
                    <div style="font-style: italic" class="text-muted">
                        <?= $new->date?>
                    </div>
                    <hr>

                                     <?= substr($new->content, 0, 100). ' ...'.'<a href="viewnews.php?id='.$new->id.'">Read More</a>';?>
                                     <?php
                                 }

                                 ?>
                </div>


            </div>



        </div>



        <div class="col-md-4">
            <div class="box" style="padding-top: 0; margin-top: 0 ">
                <div class="box-body" style="padding-top: 0; margin-top: 0 ">
                    <br>
                    <?php
                    $news = new Event();

                    $all_news = $news->activeRecord()->read()->results();

                    foreach ($all_news as $new) {
                        ?>
                        <div style="font-style: italic" class="text-muted">
                            <?= $new->date?>
                        </div>


                        <?= $new->event;?>
                        <hr>
                        <?php
                    }

                    ?>
                </div>


            </div>



        </div>


        <div class="col-md-4">
            <div class="box" style="padding-top: 0; margin-top: 0 ">
            <div class="box-body">
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
                            <button type="submit" id="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    </div>

                </div>
                <div class="login">
                    <div class="login-talk">
                        <p align="center" style="margin-top: 20px">You don't have an account? <button id="sign-up" class="btn btn-link" >Sign Up</button> </p>
                    </div>
                    <div class="signup-talk">
                        <p align="center" style="margin-top: 20px">Already have an account? <button id="log-in" class="btn btn-link ">Sign In</button> </p>
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





