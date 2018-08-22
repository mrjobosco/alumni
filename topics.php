<?php
include_once 'core/init.php';

Html::start("Student Hub | Topics");

$user = new User();

$categories = new Category();
$all_categories = $categories->activeRecord()->read()->results();

    if(Input::exists()){

        if (!$user->isLoggedIn()){
            Session::flash('error','You can create a discussion without logging in');
            Redirect::to('topics.php?id='.Input::get('id'));
        }
        $topic = new Topic();
        $topic->activeRecord()->create([

            'name'  =>  Input::get('title'),
            'description'   => Input::get('description'),
            'creator_id'    =>  $user->activeRecord()->getId(),
            'create_time'   =>  time(),
            'category_id'   =>  Input::get('category_id')


        ]);



        $topic->activeRecord()->relate(['name'  =>  Input::get('title')]);
        $tags = new Tags();

        $topicViews = new TopicViews();
        $topicViews->activeRecord()->create([
            'topic_id'  =>  $topic->activeRecord()->getId(),
            'count'     =>  0

        ]);

        $tags->extractAndInsertTopics(Input::get('tags'), $topic->activeRecord()->getId());

        Session::flash('Home', "You have successfully started a discussion");
        Redirect::to('index.php');


    }


?>
<body id="page-wrapper">
<div >


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

            <?php


            if(Session::exists('error')){
                echo'<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-ban"></i> Sorry...</h4>
              '.Session::flash('error').'
            </div>
            
            ';
            }
            ?>

            <div class="tab-item tab-active" id="index-1">
                <a href="#">New Topics</a>
            </div>
            <div class="tab-item tab-inactive" id="index-3">
                <a href="#">Create a Discussion</a>
            </div>
            <div class="tab-line">

            </div>


            <div id="index-1-tab">


                <div class="container">

                    <div class="tab-1" style="margin-top: 30px">
                        <div class="col-md-12">
                            <div class="col-md-7"><strong>Topics</strong></div>
                            <div class="col-md-1"><strong>Threads</strong></div>



                            <?php
                            $topic = new Topic();

                            $all_topics = $topic->activeRecord()->read()->results();


                            foreach ($all_topics as $question) {
                                $q = new Topic();
                                $tags = $q->activeRecord()->hasMany(TopicTag::tableName(),['topic_id'   =>  $question->id]);
                                ?>

                                <div class="question">
                                    <div class="col-md-12">
                                        <hr>

                                    </div>
                                    <div class="col-md-7">
                                        <a href="viewtopic.php?id=<?= $question->id?>"><?= $question->name?></a>
                                        <div>
                                            <?php
                                            foreach ($tags as $t) {
                                                $data  = new Tags();
                                                $data->activeRecord()->relate(['id' =>  $t->tags_id]);
                                                $tag = $data->activeRecord()->data();

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

                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $q->getThreadCount($question->id)

                                        ?>
                                    </div>

                                </div>

                                <?php
                            }

                            ?>

                        </div>


                    </div>
                </div>





            </div>





            <div id="index-2-tab"></div>



            <div id="index-3-tab">

                    <div class="row">
                        <div class="container">

                        <div class="col-md-8">

                            <form action="" method="post">

                    <div class="form-group">
                        <label class="col-md-2">Topic Title:</label>
                        <div class="col-md-10">
                            <input class="form-control" required name="title" placeholder="What's the topic? Please be Specific">
                        </div>
                        <div class="clearfix"></div>
                    </div>

                                <div class="form-group">
                                    <label class="col-md-2">Category:</label>
                                    <div class="col-md-10">
                                        <select name="category_id" class="form-control" id="">
                                            <?php
                                            foreach ($all_categories as $category) {
                                                ?>
                                                <option value="<?= $category->id?>"><?= $category->name?></option>
                                                <?php

                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                    <div class="form-group">
                        <div class="col-md-12">

                            <textarea class="form-control" required name="description" rows="10"></textarea>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input class="form-control" required name="tags" type="text" placeholder="At least one tag such as ( Admission, screening exercise), max 5 tags">
                        </div>
                        <div class="clearfix"></div>


                    </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input class="btn bg-purple-gradient" type="submit" value="Create Topic">
                                </div>
                            </div>
                </div>
                        </form>

                        <div class="col-md-4">
                            <div class="how_to_tag">

                                <h4>How to Tag</h4>

                                <p> A tag is a keyword or label that categorizes your question with other, similar questions.</p>

                                <p><i class="fa fa-arrow-right fa-fw"></i> favor existing popular tags; avoid creating new tags  </p>
                                <p><i class="fa fa-arrow-right fa-fw"></i> use common abbreviations  </p>
                                <p><i class="fa fa-arrow-right fa-fw"></i> don't include synonyms  </p>
                                <p><i class="fa fa-arrow-right fa-fw"></i> combine multiple words into single-words with dashes  </p>
                                <p><i class="fa fa-arrow-right fa-fw"></i> maximum of 5 tags, 25 chars per tag  </p>
                                <p><i class="fa fa-arrow-right fa-fw"></i> tag characters: [a-z 0-9 + # - .]  </p>
                                <p><i class="fa fa-arrow-right fa-fw"></i> delimit tags by comma  </p>
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
<?php
        //include_once 'chatbox.php';
?>
