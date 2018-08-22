<?php
session_start();
error_reporting(0);

$GLOBALS['config'] = [
			'mysql' =>		 [
							'host' => '127.0.0.1',
							'username' => 'root',
							'password' => '',
							'db'	=> 'alumni_system',
							 ],

			'remember' =>	[
							'cookie_name' 	=> 'hash',
							'cookie_expiry'	=> 604800,

							],

			'session' =>	[
							'session_name' => 'user',
							'token_name' => 'token'
							],
            'file'	 =>		[
                        'picture'		=>	'file/images/',
                        'document'		=>	'file/materials/',
                        'audio'		=>	'file/audios/',
                        'video'		=>	'file/videos/'

                            ]
		
					];

spl_autoload_register(function($class)
{
	require_once('classes/'. $class .'.php');
});

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')))
{
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', ['hash','=',$hash]);
	 
	if($hashCheck->counter())
	{
		$user = new User($hashCheck->first()->user_id);
		$user->login();

	}
}
?>