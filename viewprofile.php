<?php
include_once 'core/init.php';

Html::start("Alumni System | Profile");
$user = new User();
if(!$user->isLoggedIn()){

    Redirect::to('index.php');
}

$user->activeRecord()->relate(['id' =>  Input::get('id')]);

?>
<body>
<?php include_once "chatBox.php";?>
<?php
Template::start();
?>
<div class="row">
    <div class="container">





        <div class="tabs"></div>



        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <div class="loading" style=" width: 100px; height: 150px;  position: absolute; z-index: 150">
                        </div>
                        <div class="pic">

                            <img src="<?=$user->activeRecord()->data()->profile_picture ?>" class="img-thumbnail" width="250px" height="300px" />
                        </div>
                        <div class="col-sm-12">

                        </div>



                    </div>
                    <div class="col-md-9 col-md-offset-1">
                        <div class="box-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">First Name:</label>
                                    <?= $user->activeRecord()->data()->first_name?>

                                </div>
                                <div class="form-group">
                                    <label for="">Last Name:</label>
                                    <?= $user->activeRecord()->data()->last_name ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Username:</label> <?= $user->activeRecord()->data()->username ?>
                                </div>
                            </form>
                        </div>

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


