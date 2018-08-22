<?php
include_once 'core/init.php';

Html::start('Alumni System | Login Page');

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
                $record->create([
                    'username'      => Input::get('username'),
                    'password'      => Input::get('password'),
                    'first_name'    => Input::get('first_name'),
                    'last_name'     => Input::get('last_name'),
                    'email'         => Input::get('email'),
                    'user_type'     => 4,
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
<div class="row">


<header>
    <nav class="navbar top-link">
        <div class="container">
        <ul class="navbar-nav navbar-right top-link-links">
            <li><a href="#" class="navbar-link">log in</a></li>
            <li><a href="#" class="navbar-link">sign up</a></li>
            <li><input type="text" class="nav-input" placeholder="Search Q&A"></li>


        </ul>
        </div>
    </nav>
    </header>

</div>

<div class="row">
    <div class="container">
        <div class="logo-tabs">
            <div class="tags">
                <div class="tag">Ask Question</div>
                <div class="tag tag-active">Users</div>
                <div class="tag">Tags</div>
                <div class="tag">Questions</div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="container">
        <div class="tabs">
            <div class="tab-item tab-active" id="log-in">
                <a href="#">log in</a>
            </div>
            <div class="tab-item tab-inactive" id="sign-up">
                <a href="#">sign up</a>
            </div>
            <div class="tab-line">

            </div>
            </div>
            <div  class="col-md-8 col-md-offset-1">
                <div class="login-header">
                <h3>Student Hub; An Unlimited Access to Knowledge </h3>
                    <div class="comments"><i style="color: blue; font-size: 2em" class="fa fa-comment-o fa fw"></i></div>
                </div>


                <div class="col-md-8 col-md-offset-2">
                    <div style="margin-top: 50px">
                    <div class="login">
                        <div class="login-buttons">
                            <button class="btn btn-danger"><i class="fa fa-google-plus fa-fw"></i> Google</button>
                            <button class="btn btn-primary"><i class="fa fa-facebook fa-fw"></i> Facebook</button>
                        </div>



                <div class="clearfix"></div>
                <div class="login-lines">
                <div class="login-line"></div>
                <div class="login-line-or"> OR</div>
                <div class="login-line"></div>
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
