<?php
include_once 'core/init.php';

        $tags = new Tags();

        $all_tags = $tags->allTags();




Html::start("Student Hub | Homepage");

?>
<body>

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

            <div class="col-md-12">

            <legend>Tags</legend>
            <?php
            foreach ($all_tags as $tag) {

                ?>
                <div class="">
                    <span class="ini-tags"><a href="viewTags.php?id=<?=$tag->id?>">

                    <?php $char = ['_', '-'];
                        $str = str_replace($char," ", $tag->name);
                        echo $str;

                    ?>
                        </a></span>

                </div>

                <?php
                 }
            ?>
                <div class="clearfix"></div>


                </div>

        </div>

    </div>


</div>



</body>
<?php
Html::end();
?>

