<?php
class Redirect{


	public static function to($string){
		if($string)
			if(is_numeric($string)){
				switch($string){
					case 404:
					header('HTTP/1.0 404 Not Found');
						include 'includes/errors/404.php';
					break;
				}
			}
		{header("Location: {$string}");}
		exit();
	}
}


?>