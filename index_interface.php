<?php
include_once 'core/init.php';

Html::start("Alumni System | Index Interface");

?>
<body>

<?php
Template::start();
?>
<div class="row">
    <div class="container">




        <div class="tabs">
            <div class="tab-item tab-active" id="log-in">
                <a href="#">Unanswered Questions</a>
            </div>
            <div class="tab-item tab-inactive" id="sign-up">
                <a href="#">Top rated Questions</a>
            </div>
            <div class="tab-line">

            </div>
        </div>

    </div>


</div>



</body>
<?php
Html::end();
?>

