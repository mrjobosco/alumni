<?php
include_once 'core/init.php';

Html::start('Alumni System | Homepage');

$user = new User();


if($user->isLoggedIn()){
    Redirect::to('index.php');
}

$news = new News();

$news->activeRecord()->relate(['id' =>  Input::get('id')]);



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

            <li><a href="index_i.php" class="navbar-link">Home</a></li>

            <li><a href="login.php" class="navbar-link">News</a></li>
            <li><a href="login.php" class="navbar-link">Events</a></li>




        </ul>


    </div>
</nav>

<div class="background">
    <div class="welcome-note">

        <div class="note" style="height: 357px; width: 100%">

            <div class="container">
                <div class="row">
                    <div class=" col-md-offset-1 col-md-9">
                        <div class="box box-primary">

                            <div class="box-header">
                                <div class="h4"><?= $news->activeRecord()->data()->title?></div>
                            </div>
                            <hr>

                            <div class="box-body">
                                <?= $news->activeRecord()->data()->date?>
                                <hr>
                                <?= $news->activeRecord()->data()->content?>

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





