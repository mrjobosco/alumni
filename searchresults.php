<?php
include_once 'core/init.php';

Html::start("Alumni System | Search Results");

$questions = new Questions();
$search = new Search();

$topics = new Topic();

$all_id = $search->getResultsQuestions(Input::get('question'));
$all_ids = $search->getResultsTopics(Input::get('question'));


$all_questions = $questions->allQuestions();
$all_topics = $topics->activeRecord()->read()->results();


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
            <legend>
                Search Results for the query "<?= Input::get('question')?>".
            </legend>

            <div class="tab-item tab-active" id="log-in">
                <a href="#">Questions</a>
            </div>
            <div class="tab-item tab-inactive" id="sign-up">
                <a href="#">Topics</a>
            </div>
            <div class="tab-line">

            </div>
        </div>

    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">

        <div class="tab-2" style="display: none">


            <?php
            if($all_ids) {
            ?>
            <div class="col-md-12">

                <div class="col-md-7"><strong>Topics</strong></div>
                <div class="col-md-1"><strong>Threads</strong></div>


                <?php

                foreach ($all_ids as $id) {
                    $q = new Topic();
                    $q->activeRecord()->relate(['id' => $id]);
                    $question = $q->activeRecord()->data();
                    $tags = $q->activeRecord()->hasMany(TopicTag::tableName(), ['topic_id' => $question->id]);

                    ?>

                    <div class="question">
                        <div class="col-md-12">
                            <hr>

                        </div>

                        <div class="col-md-7">
                            <a href="viewTopic.php?id=<?= $question->id ?>"><?= $question->name ?></a>

                            <div>
                                <?php
                                foreach ($tags as $t) {
                                    $data = new Tags();
                                    $data->activeRecord()->relate(['id' => $t->tags_id]);
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
                            <?= $q->getThreadCount($question->id)

                            ?>
                        </div>


                    </div>

                    <?php
                }
                }else{
                    echo '<div class="col-md-offset-1" style="margin-top: 20px">Sorry there are no results for this query</div>';
                }

                ?>

            </div>




        </div>

        <div class="tab-1">
            <?php
            if($all_id) {
            ?>
            <div class="col-md-12">
                <div class="col-md-7"><strong>Questions</strong></div>
                <div class="col-md-1"><strong>Posts</strong></div>


                <?php

                    foreach ($all_id as $id) {
                        $q = new Questions();
                        $q->activeRecord()->relate(['id' => $id]);
                        $question = $q->activeRecord()->data();
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
                    echo '<div class="col-md-offset-1" style="margin-top: 20px">Sorry there are no results for this query</div>';
                }

                ?>

            </div>


        </div>
    </div>
        </div>
</div>


</body>
<?php
Html::end();
?>

