<?php
include_once 'core/init.php';

Html::start("Alumni System | Moderator");

$user = new User();

if(!$user->isLoggedIn()){
    Session::get('Home', 'Please login ');
    Redirect::to('index.php');
}

if(!$user->isAdmin()){
    Session::get('Home', 'Please login as an Administrator');
    Redirect::to('index.php');
}


?>
<body>
<?php include_once "chatBox.php";?>
<?php
Template::start();
?>
<div class="row">
    <div class="container">





        <div class="tabs">

            <?php


            if(Session::exists('Home')){
                echo'<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-thumbs-up"></i> Success</h4>
              '.Session::flash('Home').'
            </div>
            
            ';
            }
            ?>

            <div class="tab-item tab-active" id="index-1">
                <a href="#">All Moderators</a>
            </div>
            <div class="tab-item tab-inactive" id="index-2">
                <a href="#">Add a new Moderator</a>
            </div>

            <div class="tab-line">

            </div>
            <div id="index-1-tab">

                <div class="col-md-12">
                    <?php
                    $all_users = $user->activeRecord()->hasMany(User::tableName(),['user_type'  =>  2]);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                        <th>SN.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>
                        </thead>

                        <?php
                        $i = 1;
                        foreach ($all_users as $u){
                            ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $u->first_name.' '.$u->last_name?></td>
                                <td><?= $u->username?></td>
                                <td><button onclick="removeModerator(<?= $u->id?>)" class="btn bg-teal-gradient">Remove Moderator</button></td>
                            </tr>



                            <?php
                            $i++;
                        }
                        ?>

                    </table>

                </div>

            </div>

            <div id="index-2-tab">

                <div class="col-md-12">
                    <?php
                    $all_users = $user->activeRecord()->hasMany(User::tableName(),['user_type'  =>  4]);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                        <th>SN.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>
                        </thead>

                    <?php
                    $i = 1;
                    foreach ($all_users as $u){
                     ?>
                        <tr>
                            <td><?= $i?></td>
                            <td><?= $u->first_name.' '.$u->last_name?></td>
                            <td><?= $u->username?></td>
                            <td><button onclick="addModerator(<?= $u->id?>)" class="btn bg-teal-gradient">Add as Moderator</button></td>
                        </tr>



                        <?php
                        $i++;
                    }
                    ?>

                    </table>

                </div>



            </div>


        </div>



        <div class="content">
            <div class="row">
                <div class="col-md-12">




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


<script type="application/javascript">
    $('.msg_header').click(function (event) {

        $('.chat_wrap').toggle();

    });
    $('#close').click(function (event) {

        $('.msg_box').hide();


    })
    $('.chat_wrap').hide();

    function removeModerator(id) {

        $.ajax({

            url: 'removeModerator.php',
            type:   'POST',
            data:   'id='+id,
            success: function (data) {
                alert(data);
                window.location = 'moderator.php';
            }
        })

    }

    function addModerator(id) {

        $.ajax({

            url: 'addModerator.php',
            type:   'POST',
            data:   'id='+id,
            success: function (data) {
                alert(data);
                window.location = 'moderator.php';

            }
        })
    }

</script>