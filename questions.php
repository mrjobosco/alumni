<?php
include_once 'core/init.php';

Html::start("Alumni System | Questions");

$questions = new Questions();



$all_questions = $questions->allQuestions();

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

            <div class="tab-item tab-active" id="index-1">
                <a href="#">All Questions</a>
            </div>
            <div class="tab-item tab-inactive" id="index-2">
                <a href="#">My Questions</a>
            </div>
            <div class="tab-line">

            </div>
        </div>

    </div>

</div>

<div class="row">
    <div class="container">

        <div id="index-1-tab">
        <div class="col-md-12">
            <div class="col-md-7"><strong>Questions</strong></div>
            <div class="col-md-1"><strong>Threads</strong></div>


            <?php
            foreach ($all_questions as $question) {
                $q = new Questions();
                $tags = $q->activeRecord()->hasMany(QuestionTag::tableName(),['question_id'   =>  $question->id]);
                                ?>

                <div class="question">
                    <div class="col-md-12">
                    <hr>

                    </div>

                    <div class="col-md-7">
                        <a href="viewquestions.php?id=<?= $question->id?>"><?= $question->question?></a>

                        <div>
                            <?php
                            foreach ($tags as $t) {
                                $data  = new Tags();
                                $data->activeRecord()->relate(['id' =>  $t->tag_id]);
                                $tag = $data->activeRecord()->data();

                                ?>
                                <div class="">
                    <span class="ini-tags"><a href="viewTags.php?id=<?=$tag->id ?>">

                    <?php $char = ['_', '-'];
                    $str = str_replace($char," ", $tag->name);
                    echo $str;

                    ?>
                        </a></span>

                                </div>

                                <?php
                            }
                            ?>

                        </div>

                    </div>


                    <div class="col-md-1">
                        <?= $q->getPostCount($question->id)

                        ?>
                    </div>


                </div>

                <?php
            }

            ?>

        </div>

            </div>
            <div id="index-2-tab" style="display: none;">

                <div class="col-md-7"><strong>Questions</strong></div>
                <div class="col-md-1"><strong>Threads</strong></div>


                <?php
                $user = new User();
                if($user->isLoggedIn()) {

                    $my_questions = $questions->myQuestions($user);
                    foreach ($all_questions as $question) {
                        $q = new Questions();
                        $tags = $q->activeRecord()->hasMany(QuestionTag::tableName(), ['question_id' => $question->id]);
                        ?>

                        <div class="question">
                            <div class="col-md-12">
                                <hr>

                            </div>

                            <div class="col-md-7">
                                <a href="viewquestions.php?id=<?= $question->id ?>"><?= $question->question ?></a>

                                <div>
                                    <?php
                                    foreach ($tags as $t) {
                                        $data = new Tags();
                                        $data->activeRecord()->relate(['id' => $t->tag_id]);
                                        $tag = $data->activeRecord()->data();

                                        ?>
                                        <div class="">
                    <span class="ini-tags"><a href="viewTags.php?id=<?= $tag->id ?>">

                    <?php $char = ['_', '-'];
                    $str = str_replace($char, " ", $tag->name);
                    echo $str;

                    ?>
                        </a></span>

                                        </div>

                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>


                            <div class="col-md-1">
                                <?= $q->getPostCount($question->id)

                                ?>
                            </div>


                        </div>

                        <?php

                    }
                }else{
                    echo '<div class="clearfix"></div><br>You have to be logged in to view this';
                }

                ?>


            </div>



    </div>
</div>


</body>
<?php
Html::end();
?>

