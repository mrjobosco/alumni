<?php
include_once 'core/init.php';

$user = new User();


if(!$user->isLoggedIn()){
    Session::flash('login', "Your have to login to ask a question");
    Redirect::to('login.php');
}
$categories = new Category();
$all_categories = $categories->activeRecord()->read()->results();
if(Input::exists()){

    $questions = new Questions();

    $questions->activeRecord()->create([
        'question'      =>      Input::get('title'),
        'description'   =>      Input::get('description'),
        'author_id'     =>      $user->activeRecord()->getId(),
        'create_time'   =>      time(),
        'category_id'   =>      Input::get('category_id'),
        'status'        =>      0
    ]);

    $question = new Questions();
    $question->activeRecord()->relate(['question'   =>  Input::get('title')]);
    $tags = new Tags();

    $views = new Views();
    $views->activeRecord()->create([
        'question_id'  =>  $question->activeRecord()->getId(),
        'count'     =>  0

    ]);

    $tags->extractAndInsert(Input::get('tags'), $question->activeRecord()->getId());

    Session::flash('Home', "Your have successfully posted a question");
    Redirect::to('index.php');


}



Html::start("Alumni System| Ask a Question");



?>
<body>

<?php
Template::start();
?>
<div class="row">
    <div class="container">


        <div class="main-section" style="margin-top: 150px;">

            <div class="row">
                <div class="container">

                    <form action="" method="post">

                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-2">Title:</label>
                            <div class="col-md-10">
                                <input class="form-control" required name="title" placeholder="What's your Question? Please be Specific">
                            </div>
                        <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2">Category:</label>
                            <div class="col-md-10">
                                <select name="category_id" class="form-control"  id="">
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

                            <textarea class="form-control" placeholder="describe your question in full" required name="description" rows="10"></textarea>

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
                            <div class="col-md-8">

                                <input type="checkbox" name="feedback"> <strong>Send me new responses to my post via email </strong><a href="">(settings)</a>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                            <input class="btn bg-purple-gradient" type="submit" value="Post your Question">
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

</body>
<?php
Html::end();
?>

<div class="msg_box" style="z-index: 20">
    <div class="msg_box">
        <div class="msg_header">
            <div class="name pull-left">Joseph</div> <div id="close" class="close pull-right">&times;</div>
        </div>
        <div class="chat_wrap">
            <div class="msg_body">
                <div class="msg_divider"></div>
                <div class="msg_b">content</div>
                <div class="msg_a">content</div>
            </div>
            <div class="msg_footer">
                <div class="reader"></div>
                <textarea class="chat_field form-control"></textarea>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $('.msg_header').click(function (event) {

        $('.chat_wrap').toggle();

    });
    $('#close').click(function (event) {

        $('.msg_box').hide();


    })
    $('.msg_box').hide();


    <?php
    if ($user->isLoggedIn()){
    ?>
    var ids = [<?= (int)$user->activeRecord()->getId(); ?>];
    var chatArr = [];
    var names = [];
    var chatCount = [];
    var i = 0;


    setInterval(function () {

        $.ajax({
            url: 'onlineAjax.php',
            success: function (data) {
                //  alert(data);

                var response = data.firstChild.getElementsByTagName('child');
                var len = response.length;
                for ($i = 0; $i < len; $i++) {
                    var name = response[$i].childNodes[0].childNodes[0].nodeValue;
                    var id = response[$i].childNodes[1].childNodes[0].nodeValue;
                    var id = parseInt(id);
                    names[id] = name;
                    var val = $.inArray(id, ids);

                    if (val < 0) {
                        $('.chatBoxBody').prepend(
                            '<div style="cursor: pointer;" class="' + id + '" id="' + id + '">\
        <div class="user">\
            <div class="row">\
                <div class="col-md-9 col-sm-9 col-xs-9">\
                    ' + names[id] + '<span id="chat' + id + '"> </span>\
                </div>\
                <div class="col-md-1 col-sm-1 col-xs-1"><div class="online"></div></div>\
            </div>\
        </div>\
    </div>');


                        $('.' + id).on('click', function () {


                            var chat_id = this.id;
                            $('.name').text(names[this.id]);
                            $('.reader').html('<div><input type="hidden" value="' + chat_id + '" name="name"></div>');

                            $('.msg_body').html('');
                            i = 0;
                            $.ajax({
                                type: 'POST',
                                url: 'getChat.php',
                                dataType: 'xml',
                                data: 'id=' + chat_id,
                                success: function (data) {

                                    var response = data.firstChild.getElementsByTagName("child");
                                    for ($i = 0; $i < response.length; $i++) {
                                        var content = response[$i].childNodes[0].childNodes[0].nodeValue;
                                        var postId = response[$i].childNodes[1].childNodes[0].nodeValue;
                                        var time = response[$i].childNodes[2].childNodes[0].nodeValue;
                                        var author = response[$i].childNodes[3].childNodes[0].nodeValue;
                                        var receiver = response[$i].childNodes[4].childNodes[0].nodeValue;

                                        author = parseInt(author);


                                        if (author == <?= (int) $user->activeRecord()->getId();?>) {
                                            $('.msg_body').append('<div class="msg_a">' + content + '</div>');
                                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                                        } else {
                                            $('.msg_body').append('<div class="msg_b">' + content + '</div>');
                                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);

                                        }

                                    }
                                }
                            }).error(function () {
                                console.log('there is a problem');
                            });


                            $.ajax({
                                url: 'updateChatCount.php',
                                type: 'post',
                                data: 'id=' + chat_id,
                                success: function (data) {

                                    $('#chat' + chat_id).html('');
                                }
                            });


                            $('.msg_box').show();

                        });


                        var arr = ids.push(id);

                    }

                }


            }

        });


        $.ajax({
            url: 'offlineAjax.php',
            success: function (data) {
                var response = data.firstChild.getElementsByTagName('child');
                var len = response.length;
                for ($i = 0; $i < len; $i++) {
                    var id = response[$i].childNodes[0].childNodes[0].nodeValue;
                    var id = parseInt(id);

                    var val = $.inArray(id, ids);

                    if (val >= 0) {
                        $('.' + id).remove();
                        ids.splice($.inArray(id, ids), 1);

                    }

                }
            }

        });


    }, 2000);

    $('textarea').keypress(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            var msg = $(this).val();
            if (msg != "") {
                var chat_id = $(document).find("input[name=name]").val();

                $.ajax({
                    type: 'post',
                    url: 'updateChat.php',
                    data: 'msg=' + msg + '&chat_id=' + chat_id,
                    success: function (data) {

                    }
                });
                $('<div class="msg_b">' + msg + '</div>').appendTo('.msg_body');
                $(this).val('');
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
        }

    });


    setInterval(function () {
        var chat_id = $(document).find("input[name=name]").val();
        $.ajax({
            type: 'post',
            url: 'chatFile.php',
            data: 'chat_id=' + chat_id,
            success: function (data) {

                var chatId = data.firstChild.childNodes[0].childNodes[0].nodeValue;
                var content = data.firstChild.childNodes[1].childNodes[0].nodeValue;
                var createTime = data.firstChild.childNodes[2].childNodes[0].nodeValue;

                if (i != 0) {

                    var val = $.inArray(chatId, chatArr);
                    if (val < 0) {

                        $('.msg_body').append('<div class="msg_a">' + content + '</div>');
                        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);

                        var arr = chatArr.push(chatId);

                    }
                }
                else {
                    var arr = chatArr.push(chatId);
                }
                i++;

            }
        });


    }, 1000);


    setInterval(function () {
        for ($i = 1; $i < ids.length; $i++) {
            //$('#chat'+ids[$i]).html('');
            chatCount[ids[$i]] += 0;
            $.ajax({
                dataType: 'xml',
                type: 'post',
                url: 'chatCount.php',
                data: 'id=' + ids[$i] + '&last_count=' + chatCount[ids[$i]],
                success: function (data) {

                    var id = data.firstChild.childNodes[0].childNodes[0].nodeValue;
                    var reply = data.firstChild.childNodes[1].childNodes[0].nodeValue;

                    if (reply) {
                        $('#chat' + id).html(' (' + reply + ')');
                    }
                }
            });


        }
    }, 2000);
    <?php
    }
    ?>
</script>