<?php
include_once 'core/init.php';

Html::start("Alumni System | Edit Category");

$user = new User();

if (!$user->isLoggedIn()){
    Redirect::to('index.php');
}


$category = new Category();
$category->activeRecord()->relate(['id'   =>  Input::get('id')]);





?>
<body>
<?php
Template::start();
?>
<div class="row">
    <div class="container">





        <div class="tabs"></div>



        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php


                    if(Session::exists('Home')){
                        echo'<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-thumbs-up"></i> Success</h4>
              '.Session::flash('Home').'
            </div>
            
            ';
                    }
                    ?>


                    <legend>All Users</legend>

                    <div class="box box-success">
                        <div class="box-header">
                            Users
                        </div>
                        <div class="box-body">

            <div class="nav-tab-justified">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#questions" data-toggle="tab">Questions</a></li>
                    <li><a href="#topic" data-toggle="tab">Topics</a></li>
                </ul>



                <div class="tab-content">
                    <div class="active tab-pane" id="questions">


                        <table class="table table-bordered">

                            <thead>
                            <th>SN.</th>
                            <th>Question</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                            <?php
                            $all_topics = $category->getQuestions();
                            $i = 1;
                            foreach ($all_topics as $topic) {

                                ?>
                                <tr>
                                    <td><?= $i?></td>
                                    <td><?= $topic->question ?></td>
                                    <td><a href="editquestions.php?id=<?= $topic->id?>" class="btn bg-green-gradient">Edit Question</a></td>
                                    <td><button class="btn bg-red-gradient" onclick="deleteQuestion(<?= $topic->id?>);">Delete Question</button></td>
                                </tr>



                                <?php
                            }

                            ?>
                        </table>


                    </div>


                    <div class="tab-pane" id="topic">

                        <table class="table table-bordered">

                            <thead>
                            <th>SN.</th>
                            <th>Topics</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                        <?php
                        $all_topics = $category->getTopics();
                        $i = 1;
                        foreach ($all_topics as $topic) {

                            ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $topic->name ?></td>
                                <td><a href="edittopics.php?id=<?= $topic->id?>" class="btn bg-green-gradient">Edit Topic</a></td>
                                <td><button class="btn bg-red-gradient" onclick="deleteTopics(<?= $topic->id ?>)">Delete Topic</button></td>
                            </tr>



                            <?php
                        }

                        ?>
                        </table>
                    </div>



                </div>




            </div>





                        </div>
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



                        $('.'+id).on('click', function() {

                            var chat_id = this.id;
                            $('.name').text(names[this.id]);
                            $('.reader').html('<div><input type="hidden" value="'+chat_id+'" name="name"></div>');

                            $('.msg_body').html('');
                            i = 0;
                            $.ajax({
                                type: 'POST',
                                url:'getChat.php',
                                dataType:'xml',
                                data:'id='+chat_id,
                                success: function(data){

                                    var response = data.firstChild.getElementsByTagName("child");
                                    for($i = 0; $i < response.length; $i++)
                                    {
                                        var content     = response[$i].childNodes[0].childNodes[0].nodeValue;
                                        var postId      = response[$i].childNodes[1].childNodes[0].nodeValue;
                                        var time        = response[$i].childNodes[2].childNodes[0].nodeValue;
                                        var author      = response[$i].childNodes[3].childNodes[0].nodeValue;
                                        var receiver    = response[$i].childNodes[4].childNodes[0].nodeValue;

                                        author = parseInt(author);


                                        if(author == response[$i].childNodes[5].childNodes[0].nodeValue)
                                        {
                                            $('.msg_body').append('<div class="msg_b">'+content+'</div>');
                                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                                        }else{
                                            $('.msg_body').append('<div class="msg_a">'+content+'</div>');
                                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);

                                        }

                                    }
                                }
                            }).error(function() {
                                console.log('there is a problem');
                            });


                            $.ajax({
                                url: 'updateChatCount.php',
                                type: 'post',
                                data: 'id='+chat_id,
                                success: function(data){

                                    $('#chat'+chat_id).html('');
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
            success: function(data){
                var response = data.firstChild.getElementsByTagName('child');
                var len = response.length;
                for($i = 0; $i < len; $i++){
                    var id = response[$i].childNodes[0].childNodes[0].nodeValue;
                    var id = parseInt(id);

                    var val = $.inArray( id, ids);

                    if(val >= 0)
                    {
                        $('.'+id).remove();
                        ids.splice( $.inArray(id, ids), 1 );

                    }

                }
            }

        });



    }, 2000);

    $('textarea').keypress(function(e){
        if(e.keyCode == 13)
        {   e.preventDefault();
            var msg = $(this).val();
            if(msg != ""){
                var chat_id = $(document).find("input[name=name]").val();

                $.ajax({
                    type:'post',
                    url:'updateChat.php',
                    data:'msg='+msg+'&chat_id='+chat_id,
                    success: function(data){

                    }
                });
                $('<div class="msg_b">'+msg+'</div>').appendTo('.msg_body');
                $(this).val('');
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
        }

    });




    setInterval(function(){
        var chat_id = $(document).find("input[name=name]").val();
        $.ajax({
            type:'post',
            url:'chatFile.php',
            data:'chat_id='+chat_id,
            success: function(data){

                var chatId = data.firstChild.childNodes[0].childNodes[0].nodeValue;
                var content = data.firstChild.childNodes[1].childNodes[0].nodeValue;
                var createTime = data.firstChild.childNodes[2].childNodes[0].nodeValue;

                if(i != 0)
                {

                    var val = $.inArray( chatId, chatArr);
                    if(val < 0)
                    {

                        $('.msg_body').append('<div class="msg_a">'+content+'</div>');
                        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);

                        var arr = chatArr.push(chatId);

                    }
                }
                else{
                    var arr = chatArr.push(chatId);
                }
                i++;

            }
        });





    }, 1000);


    setInterval(function(){
        for($i = 1; $i < ids.length; $i++){
            //$('#chat'+ids[$i]).html('');
            chatCount[ids[$i]] += 0;
            $.ajax({
                dataType: 'xml',
                type: 'post',
                url: 'chatCount.php',
                data: 'id='+ids[$i]+'&last_count='+chatCount[ids[$i]],
                success: function(data){

                    var id = data.firstChild.childNodes[0].childNodes[0].nodeValue;
                    var reply = data.firstChild.childNodes[1].childNodes[0].nodeValue;

                    if(reply){
                        $('#chat'+id).html(' ('+reply+')');
                    }
                }
            });


        }
    }, 2000);


    function deleteTopics($id) {

        $.ajax({

            url:'deletetopic.php',
            type:'post',
            data:'id='+$id,
            success: function (data) {
                alert(data);
                window.location  ='categories.php';
            }
        });
    }

    function deleteQuestion($id) {

        $.ajax({

            url:'deleteQuestion.php',
            type:'post',
            data:'id='+$id,
            success: function (data) {
                alert(data);
                window.location  ='categories.php';
            }
        });
    }

</script>
