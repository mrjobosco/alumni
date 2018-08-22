<?php
include_once 'core/init.php';

Html::start("Alumni System | View Questions");
$user  = new User();

$views = new Views();

$views->activeRecord()->relate(['question_id'  =>  Input::get('id')]);

$count = $views->activeRecord()->data()->count;
$views->activeRecord()->update([
    'count'    =>   $count + 1
]);


$questions = new Questions();

$questions->activeRecord()->relate(['id'    =>  Input::get('id')]);

            $all_post = $questions->getPost();

    if (Input::exists()) {
        if ($user->isLoggedIn()) {


            $post = new Post();
        $post->activeRecord()->create([

            'question_id' => Input::get('id'),
            'creator_id' => $user->activeRecord()->getId(),
            'post' => Input::get('post'),
            'create_time' => time(),
            'votes_down'         =>  0,
            'votes_up'          =>  0


        ]);

        Session::flash('Post', "You have successfully Posted an answer");
        Redirect::to('viewquestions.php?id=' . Input::get('id'));


    }else{
            Session::flash('login', "Login to participate");
            Redirect::to('login.php');

        }
}
?>
<body>

<?php
Template::start();
?>
<div class="row">
    <div class="container">

        <div class="question">
            <div class="col-md-12">


                    <div class="question">
                        <div class="col-md-12">


                            <?php


                            if(Session::exists('Post')){
                                echo'<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-thumbs-up"></i> Success</h4>
              '.Session::flash('Post').'
            </div>
            
            ';
                            }
                            ?>

                            <div class="col-md-8">
                            <hr>
                            <div class="view-question">
                                <?php
                                $creator = new User($questions->activeRecord()->data()->author_id);

                                echo '<strong>Q: '.$questions->activeRecord()->data()->question.'</strong>';

                                ?>

                                <div>
                                    Threads:   <?= $questions->getPostCount($questions->activeRecord()->getId())?>
                                    View:   <?= $count?>
                                    <br> Posted By:    <strong style="color: red;"><span onmouseleave="name_out()" onmouseover="names_hover(this.id)" id="<?= $creator->activeRecord()->data()->id ?>"><?php
                                            echo $creator->activeRecord()->data()->first_name.' '.$creator->activeRecord()->data()->last_name

                                            ?></span></strong>

                                </div>
                                </div>
                                <hr>
                                <div class="description">
                                    <?= $questions->activeRecord()->data()->description?>
                                </div>

                                <div class="feedback">
                                <div class="col-md-12">
                                 <hr>
                                    <strong>Answers</strong>
                                    <hr>
                                </div>
                                    <?php
                                    foreach($all_post as $post) {
                                    $u = new User();

                                    $u->activeRecord()->relate(['id' => $post->creator_id]);

                                    $reply = new Reply();

                                    $all_replies = $reply->getReplies($post->id);
                                    ?>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="arrow-up" id="<?= $post->id ?>" onclick="vote_up(this.id)">
                                               <span id="votes_up_<?= $post->id ?>"><?= $post->votes_up?></span><i class="fa fa-thumbs-o-up fa-fw"></i>
                                            </div>
                                            <div class="votes" id="votes_<?= $post->id ?>">

                                            </div>

                                            <div class="arrow-down" id="<?= $post->id ?>" onclick="vote_down(this.id)">
                                                <span id="votes_down_<?= $post->id ?>"><?= $post->votes_down?></span><i class="fa fa-thumbs-down fa-fw"></i>
                                            </div>

                                        </div>
                                        <div class=" col-md-10">
                                            <div class="answer">
                                                <div>
                                                    Replies:   <?= $reply->getRepliesCount($post->id)?>

                                                </div>
                                                <hr>
                                                <?= $post->post ?>


                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <span
                                                class="pull-left"><strong>Posted By:</strong> <span style="color: red;" onmouseleave="name_out()" onmouseover="names_hover(this.id)" id="<?= $u->activeRecord()->data()->id ?>"><?= $u->activeRecord()->data()->username ?></span>
                                                <strong>on:  </strong><?= Date('d/m/Y', $post->create_time) ?></span>
                                            <button onclick="set_id(<?= $post->id ?>)" data-toggle="modal"
                                                    data-target="#exampleModal" class="btn btn-link pull-right">Reply
                                            </button>
                                        </div>

                                        <div class="col-md-10 col-md-offset-2">
                                            <div class="reply">
                                                <hr>
                                                <strong>Replies</strong>
                                                <?php
                                                foreach ($all_replies as $r){
                                                    $ru = new User();
                                                    $ru->activeRecord()->relate(['id'   =>  $r->creator_id]);
                                                ?>

                                                <div class=" col-md-11">
                                                    <hr>
                                                    <div class="answer">
                                                        <?= $r->reply ?>


                                                    </div>

                                                </div>
                                                <div class="col-md-12">

                                                    <span
                                                        class="pull-left"><strong>Posted By:<span style="color: red;" onmouseleave="name_out()" onmouseover="names_hover(this.id)" id="<?= $ru->activeRecord()->data()->id ?>"><?= $ru->activeRecord()->data()->username ?></span>
                                                        <strong>on:  </strong><?= Date('d/m/Y', $r->create_time) ?></span>
                                                </div>
                                                <?php

                                                }


                                                    ?>
                                                </div>

                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        <?php

                                    }

                                ?>

                                </div>
                                <div class="answer-the-question">

                                    <form action="" method="post">
                                        <div class="form-group">
                                    <label>Post the answer if you've go it:</label>
                                    <textarea class="form-control" placeholder="The Answer Please" name="post" rows="10"></textarea>
                                            </div>
                                        <div>
                                    <input type="submit" class="btn bg-teal-gradient" value="Post">
                                            </div>

                                    </form>
                                </div>
                            </div>
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


<div class="user_details">
    <div class="user_img" style="width: 40%; float: left;">
    </div>
    <div style="width: 10%; float: left; "> </div>
    <div class="user_detail" style="width: 60%; float: left; font-size: 10px;"> </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><p>&times;</p></span></button>
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-photo fa-fw"></i> Reply</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Reply</label>
                     <textarea class="form-control" id="reply" name="reply"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="reply()" id="upload" class="btn btn-primary" data-dismiss="modal">Reply</button>
            </div>
        </div>
    </div>
</div>


</body>
<?php
Html::end();
?>


<script type="application/javascript">

    $('.user_details').hide('slow');

    var id = 0;
    function set_id(val) {
        id = val;
        //   alert('cool');
    }

    function get_id() {
        return id;
    }

    function name_out() {
        $('.user_details').hide('slow');
    }

    function names_hover(id) {

//        alert(id);

        $.ajax({

            url: 'getUserDetails.php',
            type:   'POST',
            data:   'id='+id,
            success:  function (data) {
                var response = data.firstChild.getElementsByTagName("child");

                var names = response[0].childNodes[0].childNodes[0].nodeValue;

                var picture = response[0].childNodes[1].childNodes[0].nodeValue;
                var phone = response[0].childNodes[2].childNodes[0].nodeValue;
                var year = response[0].childNodes[3].childNodes[0].nodeValue;
                var department = response[0].childNodes[4].childNodes[0].nodeValue;
                var place_of_work = response[0].childNodes[5].childNodes[0].nodeValue;



                $('.user_img').html('<img src="'+picture+'" height="200px" >');
                $('.user_detail').html('<br><label> Names</label><br>' +
                    names +
                    '<br><label>Phone Number</label><br>' +
                    phone +
                    '<br><label>Year of Graduation</label><br>' +
                    year +
                    '<br><label>Department</label><br>' +
                    department +
                    '<br><label>Current Place of work</label><br>' +
                    place_of_work);

                $('.user_details').show('slow');

            }

        })




    }

    var id = 0;
    function set_id(val) {
        id = val;
     //   alert('cool');
    }

    function get_id() {
        return id;
    }

    function reply(){

        $var = $('#reply').val();

        $.ajax({
            type: 'POST',
            url: 'reply.php',
            data: 'id=' + id + '&reply=' + $var,
            success: function (data) {
                if (data == 'false'){
                    window.location = 'login.php';
                }
                $('.reply').append('<div class=" col-md-11">' +
                    '<hr>' +
                    '<div class="answer">' +
                    $var +
                    '</div>' +
                    '</div><div class="col-md-12">' +
                    '<span class="pull-left"><strong>Posted By:</strong> You' +
                    '<strong> on:  </strong>Now</span>' +
                    '</div>');
            }

        })

    }

    function vote_down(id) {
        $.ajax({
            type: 'POST',
            url: 'votes_down.php',
            data: 'id='+ id+'&value=1',
            success: function(data){
                $('#votes_down_'+id).html(data);
            }
        })

    }


    function vote_up(id) {
        $.ajax({
            type: 'POST',
            url: 'votes.php',
            data: 'id='+ id+'&value=1',
            success: function(data){
                $('#votes_up_'+id).html(data);
            }
        })


    }


</script>

