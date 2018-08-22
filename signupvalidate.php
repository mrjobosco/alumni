<?php
include_once 'core/init.php';

if(Input::exists()){
	$user = new User();

	if(Input::get('username')) 
{
	$validate = new Validation();

	$validation = $validate->check($_POST, [
		'username' => [
		'unique'	=> 'users'
		],
		]);
	if($validation->passed()){

		$return  = 'true';
	}
	else
	{
		$return = 'false'; 
	}
 echo $return;
}
elseif (Input::get('adm_no')) {
	$validate = new Validation();

	$validation = $validate->check($_POST, [
		'adm_no' => [
		'unique'	=> 'student'
		],
		]);
	if($validation->passed()){

		$return  = 'true';
	}
	else
	{
		$return = 'false'; 
	}
 echo $return;
}
else{
	$validate = new Validation();

	$validation = $validate->check($_POST, [
		'email' => [
		'unique'	=> 'users'
		],
		]);
	if($validation->passed()){

		$return  = 'true';
	}
	else
	{
		$return = 'false'; 
	}
 echo $return;	
}
}

else{
	Redirect::to('index.php');
}
?>