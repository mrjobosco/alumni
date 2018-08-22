$(document).ready(function(){
$a = 0;
$b = 0;
$c = 0;
$d = 0;
$e = 0;
$f = 0;
$g = 0;
$i = 0;

$('#first_name').focusout(function(){
	$value  = $('#first_name').val();
	$len = $value.length;
	if($value === ""){
		$('#first').addClass('has-error');
		$('#first_text').text('First Name is required');
		document.getElementById('submit').disabled = true;
		$a = 1;
	}else
	if ($len < 3) 
		{
	$('#first').addClass('has-error');
		$('#first_text').text('First Name is too short character length must be between 3 and 20');
		document.getElementById('submit').disabled = true;
		$a = 1;
	}
	else
	if ($len > 20) 
		{
	$('#first').addClass('has-error');
		$('#first_text').text('First Name is too long character length must be between 3 and 20');
		document.getElementById('submit').disabled = true;
		$a = 1;
	}
	else
	if (!isNaN($value)) 
		{
	$('#first').addClass('has-error');
		$('#first_text').text('First Name has to be letters');
		document.getElementById('submit').disabled = true;
		$a = 1;
	}
	else
	{
		$k = 0;
		for($j = 0; $j < 9; $j++){
			for($mm = 0; $mm < $value.length; $mm++){

		if ($j == $value[$mm]) {
			$k++;

		}
			}
		}
		if($k > 0){
		$('#first').addClass('has-error');
		$('#first_text').text('First Name has to be letters');
		document.getElementById('submit').disabled = true;
		$a = 1;
		}
		else{
		$('#first').removeClass('has-error').addClass('has-success');
		$('#first_text').text('').removeClass('has-error');
		document.getElementById('submit').disabled = false;
		$a = 0;
	}
	}
});

$('#last_name').focusout(function(){
	$value  = $('#last_name').val();
	$len = $value.length;
	if($value === ""){
		$('#last').addClass('has-error');
		$('#last_text').text('Last Name is required');
		document.getElementById('submit').disabled = true;
		$b = 1;
	}else
	if ($len < 3) 
		{
	$('#last').addClass('has-error');
		$('#last_text').text('Last Name is too short character length must be between 3 and 20');
		document.getElementById('submit').disabled = true;
		$b = 1;
	}
	else
	if ($len > 20) 
		{
	$('#last').addClass('has-error');
		$('#last_text').text('Last Name is too long character length must be between 3 and 20');
		document.getElementById('submit').disabled = true;
		$b = 1;
	}
	else
		if (!isNaN($value)) 
		{
	$('#last').addClass('has-error');
		$('#last_text').text('Last Name has to be letters');
		document.getElementById('submit').disabled = true;
		$b = 1;
	}
	else
	{

	$k = 0;
		for($j = 0; $j < 9; $j++){
			for($mm = 0; $mm < $value.length; $mm++){

		if ($j == $value[$mm]) {
			$k++;

		}
			}
		}
		if($k > 0){
			$('#last').addClass('has-error');
		$('#last_text').text('Last Name has to be letters');
		document.getElementById('submit').disabled = true;
		$b = 1;
		}
		else{

		$('#last').removeClass('has-error').addClass('has-success');
		$('#last_text').text('').removeClass('has-error');
		document.getElementById('submit').disabled = false;
		$b = 0;
	}
	}
});


$('#phone_no').focusout(function(){

	$value  = $('#phone_no').val();
	$len = $value.length;
	if($value === ""){
		$('#phone_no').addClass('has-error');
		$('#phone_text').text('Phone Number is required');
		document.getElementById('submit').disabled = true;
		$c = 1;
	}else
		if(isNaN($value)){
		$('#phone_no').addClass('has-error');
		$('#phone_text').text('Phone is required');
		document.getElementById('submit').disabled = true;
		$c = 1;
	}
		else{
		$('#phone_text').text('');
		document.getElementById('submit').disabled = false;
		$('#address').removeClass('has-error').addClass('has-success');
		$c = 0;
				}
	
});
$('#password').focusout(function(){
	$value  = $('#password').val();
	$len = $value.length;
	if($value === ""){
		$('#pass').addClass('has-error');
		$('#password_text').text('Password is required');
		document.getElementById('submit').disabled = true;
		$d = 1;
	}else
	if ($len < 6) 
		{
	$('#pass').addClass('has-error');
		$('#password_text').text('Password is too short');
		document.getElementById('submit').disabled = true;
		$d = 1;
	}
	else
	{
		$('#pass').removeClass('has-error').addClass('has-success');
		$('#password_text').text('').removeClass('has-error');
		document.getElementById('submit').disabled = false;
		$d = 0;
	}
});

$('#password_again').focusout(function(){
	$value  = $('#password').val();
	$password = $('#password_again').val();
	if($value !== $password){
		$('#pass_again').addClass('has-error');
		$('#password_again_text').text('Password and password again dosen\'t match');
		document.getElementById('submit').disabled = true;
		$e = 1;
	}
	else
	{
		$('#pass_again').removeClass('has-error').addClass('has-success');
		$('#password_again_text').text('').removeClass('has-error');
		document.getElementById('submit').disabled = false;
		$e = 0;
	}
});

$('#username').focusout(function(){

	$value  = $('#username').val();
	$len = $value.length;
	if($value === ""){
		$('#user').addClass('has-error');
		$('#username_text').text('Username is required');
		document.getElementById('submit').disabled = true;
		$f = 1;
	}else
	if ($len < 3) 
		{
	$('#user').addClass('has-error');
		$('#username_text').text('Username is too short character length must be between 3 and 20');
		document.getElementById('submit').disabled = true;
		$f = 1;
	}
	else
	if ($len > 20) 
		{
	$('#user').addClass('has-error');
		$('#username_text').text('Username is too long character length must be between 3 and 20');
		document.getElementById('submit').disabled = true;
		$f = 1;
	}
	else
	{

		$value = $('#username').val();
	$.ajax({
		type: 'POST',
		url: 'signupvalidate.php',
		data: 'username='+ $value, 
		success: function(data){
			if(data === 'true')
			{ 
				document.getElementById('submit').disabled = false;
				$('#username_text').text('');
				$('#username_text2').text($value + ' is Available!');

		$('#user').removeClass('has-error').addClass('has-success');
			}else{
				document.getElementById('submit').disabled = true;
				$('#username_text').text($value + ' has been taken, choose another one!');
			}
		}
	}).error(function(){
		alert('Something went wrong');
	});
	}
});




$('#email').focusout(function(){

	$value  = $('#email').val();
	$len = $value.length;
	if($value === ""){
		$('#mail').addClass('has-error');
		$('#email_text').text('Email is required');
		document.getElementById('submit').disabled = true;
		$g = 1;
	}
	else
	{

	$value = $('#email').val();
	$.ajax({
		type: 'POST',
		url: 'signupvalidate.php',
		data: 'email='+ $value, 
		success: function(data){
			if(data === 'true')
			{ 
				$('#email_text').text('');
				document.getElementById('submit').disabled = false;
		$('#mail').removeClass('has-error').addClass('has-success');
		$g = 0;
			}else{
				document.getElementById('submit').disabled = true;
				$('#email_text').text($value + ' has been used!');
				$g = 1;
			}
		}
	}).error(function(){
		alert('Something went wrong');
	});
	}
});


$('#address').focusout(function(){

	$value  = $('#address').val();
	$len = $value.length;
	if($value === ""){
		$('#address').addClass('has-error');
		$('#address_text').text('Address is required');
		document.getElementById('submit').disabled = true;
		$i = 1;
	}
		else{
		$('#address_text').text('');
		document.getElementById('submit').disabled = false;
		$('#address').removeClass('has-error').addClass('has-success');
		$i = 0;
				}
	
});

$('#submit').on('click', function(event){

	if($a == 1 || $b == 1 || $c == 1 || $d == 1 || $e == 1 || $f == 1 || $g == 1 || $i == 1){

		event.preventDefault();
		alert('Please fill correctly all required fields');
	}

});


});
