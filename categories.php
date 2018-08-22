<?php
include_once 'core/init.php';

Html::start("Alumni System | Category");

$user = new User();

if(!$user->isLoggedIn()){
    Session::get('Home', 'Please login ');
    Redirect::to('index.php');
}

if(Input::exists()){

    $category = new Category();
    $category->activeRecord()->create([

        'name'  =>  Input::get('title'),
        'description'   =>  Input::get('description'),
        'create_time'   =>  time()
    ]);

    Session::flash('Home', "You have successfully added a category");

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
                <a href="#">All Categories</a>
            </div>
            <div class="tab-item tab-inactive" id="index-2">
                <a href="#">Add Category</a>
            </div>

            <div class="tab-line">

            </div>
            <div id="index-2-tab">

                <div class="col-md-12">

                    <form action="" method="post">
                        <div class="form-group">
                        <label for="">Category Title:</label>
                        <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea rows="10" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn btn-primary">
                        </div>

                    </form>

                </div>

            </div>

            <div id="index-1-tab">

                <div class="col-md-12">

                    <table class="table table-bordered">
                        <thead>
                        <th>Sn.</th>
                        <th>Name.</th>
                        <th>Create Time</th>
                        </thead>
                        <tbody>

                            <?php
                            $all_category = new Category();
                            $all  = $all_category->activeRecord()->read()->results();
                            foreach ($all as $c) {
                                ?>
                                <tr>
                                <td><?= $c->id?></td>
                                <td><a href="editCategory?id=<?= $c->id ?>"><?= $c->name?></a></td>

                                    <td><?= Date('d/m/Y', $c->create_time)?></td>
                                    </tr>




                                <?php
                            }
                            ?>

                        </tbody>
                    </table>


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
