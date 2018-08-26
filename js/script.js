
$('#topics').hover(function (event) {

$('.categorieslist2').fadeIn('slow');
    $('.categorieslist').hide();


},function (event) {

  //  $('.categorieslist').fadeOut('slow');

});

$('.categorieslist').hover(function () {
    $('.categorieslist').show();
},function () {
     $('.categorieslist').fadeOut('slow');
})

$('.categorieslist2').hover(function () {
    $('.categorieslist2').show();
},function () {
    $('.categorieslist2').fadeOut('slow');
})


$('#question').hover(function (event) {

    $('.categorieslist').fadeIn('slow');
    $('.categorieslist2').hide();


},function (event) {

   // $('.categorieslist').fadeOut('slow');

});



$('.msg_box').hide();


$('#chat-btn').on('click', function(){

    $('.chat-box').toggle();
});



$('.signup-talk').hide();

$('#index-2-tab').hide();
$('#index-3-tab').hide();


$('#log-in').on('click', function (event) {
    $('#log-in').addClass("tab-active");
    $('#log-in').removeClass("tab-inactive");
    $('#sign-up').removeClass("tab-active");
    $('#sign-up').addClass("tab-inactive");
    $('.main-login-form').show();
    $('.main-signup-form').hide();
    $('.signup-talk').hide();
    $('.login-talk').show();

});

$('#sign-up').on('click', function (event) {
    $('#log-in').addClass("tab-inactive");
    $('#log-in').removeClass("tab-active");
    $('#sign-up').removeClass("tab-inactive");
    $('#sign-up').addClass("tab-active");
    $('.main-signup-form').show();
    $('.main-login-form').hide();
    $('.login-talk').hide();
    $('.signup-talk').show();

});


$('#index-1').on('click', function (event) {
    $('#index-1').addClass("tab-active");
    $('#index-1').removeClass("tab-inactive");
    $('#index-2').addClass("tab-inactive");
    $('#index-2').removeClass("tab-active")
    $('#index-3').addClass("tab-inactive");
    $('#index-3').removeClass("tab-active")


    $('#index-1-tab').show();
    $('#index-2-tab').hide();
    $('#index-3-tab').hide();



});
$('#index-2').on('click', function (event) {
    $('#index-2').removeClass("tab-inactive");
    $('#index-2').addClass("tab-active");
    $('#index-1').addClass("tab-inactive");
    $('#index-1').removeClass("tab-active");
    $('#index-3').addClass("tab-inactive");
    $('#index-3').removeClass("tab-active")

    $('#index-1-tab').hide();
    $('#index-2-tab').show();
    $('#index-3-tab').hide();

});

$('#index-3').on('click', function (event) {
    $('#index-3').addClass("tab-active");
    $('#index-3').removeClass("tab-inactive");
    $('#index-2').addClass("tab-inactive");
    $('#index-2').removeClass("tab-active")
    $('#index-1').addClass("tab-inactive");
    $('#index-1').removeClass("tab-active");


    $('#index-1-tab').hide();
    $('#index-2-tab').hide();
    $('#index-3-tab').show();
});

$('#search').on('keydown', function (event) {
    var words = $('#search').val();


        if (event.which == 13){
            if (!(words.trim(' ') == '')){

                window.location = "searchresults.php?question="+words;
            }
        }



})
