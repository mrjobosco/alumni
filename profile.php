<?php
include_once 'core/init.php';

Html::start("Alumni System | Profile");
$user = new User();
if(!$user->isLoggedIn()){

    Redirect::to('index.php');
}

if(Input::exists()){

    $user->activeRecord()->update([
        'first_name'            =>  Input::get('first_name'),
        'last_name'             =>  Input::get('last_name'),
        'profile_picture'       =>  Input::get('picture'),
        'year_of_graduation'    =>  Input::get('year_of_graduation'),
        'phone_number'          =>  Input::get('phone_no'),
        'place_of_work'         =>  Input::get('place_of_work'),
        'department'            =>  Input::get('department'),
        'address'               =>  Input::get('address')
    ]);

    if(Input::get('password')){
        $salt = Hash::salt(64);


        $user->activeRecord()->update([

        'password'      => Hash::make(Input::get('password'), $salt),
        'salt'          =>  $salt

        ]);


    }

    Session::flash('Home','You have Updated your record');
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

                            <div class="form-group">

                                <input type="file" id="image" />

                            </div>


                            <button type="button" id="image_button" class="btn bg bg-teal">Upload Picture</button>
                        </div>



                    </div>
                    <div class="col-md-9 col-md-offset-1">
                        <div class="box-body">
                        <form action="" method="post">
                        <div class="form-group">
                            <label for="">First Name:</label>
                            <input type="text" name="first_name" class="form-control" value="<?= $user->activeRecord()->data()->first_name ?>">
                        </div>
                            <input type="hidden" id="picture" value="<?= $user->activeRecord()->data()->profile_picture ?>" name="picture" />

                            <div class="form-group">
                            <label for="">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" value="<?= $user->activeRecord()->data()->last_name ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Username:</label>
                            <br><?= $user->activeRecord()->data()->username ?>
                        </div>
                        <div class="form-group">
                            <label for="">Password:</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>

                            <div class="form-group">
                                <label for="">Year of Graduation:</label>
                                <input type="number" name="year_of_graduation" class="form-control" placeholder="Year of Graduation" value="<?= $user->activeRecord()->data()->year_of_graduation ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Phone Number:</label>
                                <input type="number" name="phone_no" class="form-control" placeholder="Phone Number" value="<?= $user->activeRecord()->data()->phone_number ?>">
                            </div>


                            <div class="form-group">
                                <label for="">Department:</label>
                                <input type="department" name="department" class="form-control" placeholder="Department" value="<?= $user->activeRecord()->data()->department ?>">
                            </div>


                            <div class="form-group">
                                <label for="">Place of work:</label>
                                <textarea rows="10" cols="15" name="place_of_work" class="form-control" placeholder="Place Of Work" value=""><?= $user->activeRecord()->data()->place_of_work ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Current Address:</label>
                                <textarea rows="10" cols="15" name="address" class="form-control" placeholder="address" value=""><?= $user->activeRecord()->data()->address ?></textarea>
                            </div>






                            <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Profile">
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


<script type="application/javascript">
    $('.msg_header').click(function (event) {

        $('.chat_wrap').toggle();

    });
    $('#close').click(function (event) {

        $('.msg_box').hide();


    })
    $('.chat_wrap').hide();

    $("#image_button").on('click',function (event) {
        $(".loading").html('<img src="images/loading.gif" style="margin:120px 120px;" />');
        var file = document.getElementById('image').files;

        if(file[0]) {
            var fd = new FormData();

            fd.append('image[]', file[0]);
            $.ajax({

                type:         'POST',
                url:          'imageupload.php',
                data:         fd,
                contentType : false,
                processData : false,
                success: function(data){
                    $(".loading").html('');
                    $(".pic").html('<img src="'+data+'"  class="img-thumbnail" width="250px" height="300px" />');
                    $("#picture").val(data);

                }



            });

        }
    })

</script>