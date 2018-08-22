<?php 
function escape($string)
{
	return htmlentities($string, ENT_QUOTES, 'UTF-8');

}
	function change_picture($file_tmp, $file_extn){
		$file_path = 'images/avatar/'.substr(md5(time()), 0, 10).'.'.$file_extn;
		move_uploaded_file($file_tmp, $file_path);
		return $file_path;
	}
?>