<?php


class File{

	private $_file, $_errors = [], $_passed;

	public function __construct($name){

		$this->_file =	$_FILES[$name]; 

	}

	public static function exists($name){

		return (!empty($_FILES[$name]))?true : false;

	}

	public function addError($error){
		$this->_errors[] = $error;

	}

	public function errors(){
		return $this->_errors;
	}

	public function passed(){
		return $this->_passed;
	}

	public function validate($items = []){

		foreach ($items as $item => $rule) {
			
			foreach ($rule as $key => $value) {
				switch ($item) {
					case 'size':
						foreach ($this->_file['size'] as $thing => $thing_size) {
							
							switch ($key) {
								case 'min':
									if($thing_size < $value){
										$this->addError('File size is too small');

									
									}
									break;
								
								case 'max':
									if($thing_size > $value){
										$this->addError('File size is too Big');
										
									
									}
									break;
							}
						}
						break;
					
					case 'type':
					foreach ($this->_file['name'] as $name => $file) {
						$file_tmp  = $this->_file['tmp_name'][$name];
						$file_name = $file;
						$file_ext = explode('.', $file_name);
						$file_extn = strtolower(end($file_ext));
						
						switch ($key) {
									case 'picture':
									$image_size = getimagesize($file_tmp);
									$width  = $image_size[0];
									$height = $image_size[1];
									$allowed = ['jpg','jpeg','png'];
									if(!in_array($file_extn, $allowed)){
										$this->addError('Invalid File Type');
										break;

									}
										foreach ($value as $image_parameter => $image_item) {
											switch ($image_parameter) {
												
												case 'min':
													foreach ($image_item as $parameter => $parameter_value) {
														switch ($parameter) {
															case 'width':
																if ($parameter_value > $width ) {
																	$this->addError('Image width is too small');
																}
																break;

															case 'height':
																if ($parameter_value > $height ) {
																	$this->addError('Image height is too small');
																}
																break;
														}
													}

													break;
												
												case 'max':
													foreach ($image_item as $parameter => $parameter_value) {
														switch ($parameter) {
															case 'width':
																if ($parameter_value < $width ) {
																	$this->addError('Image width is too large');
																}
																break;

															case 'height':
																if ($parameter_value < $height ) {
																	$this->addError('Image height is too large');
																}
																break;
														}
													}


													break;
											}


										}

									break;
								
									case 'video':
									$allowed = ['mp4','avi','3gp','ogv','webm'];
									if(!in_array($file_extn, $allowed)){
										$this->addError('Invalid File Type');
										break;

									}
									break;

									case 'audio':
									$allowed = ['mp3','ogg','wav','wma','amr'];
									if(!in_array($file_extn, $allowed)){
										$this->addError('Invalid File Type');
										break;

									}	


									break;

									case 'document':
									$allowed = ['doc','pdf','docx','ppt','xlsx'];
									if(!in_array($file_extn, $allowed)){
										$this->addError('Invalid File Type');
										break;

									}	
	
										
									break;
							}
					}
						break;
				}


			}

		}

		if(empty($this->_errors))
			{
				$this->_passed = true;
			}
			return $this;

	}


	public function save($type){
		$item = [];
		if ($this->_passed) {
			switch ($type) {
			
				case 'picture':
			
					foreach ($this->_file['tmp_name'] as $key => $value) {
					$file_path = Config::get('file/picture').substr(md5(time()),0,2).$this->_file['name'][$key] ;
					move_uploaded_file($value, $file_path);
					$item[] = [$this->_file['name'][$key], $file_path];
				}
					break;
				
				case 'document':
					foreach ($this->_file['tmp_name'] as $key => $value) {
					$file_path = Config::get('file/document').substr(md5(time()),0,2).$this->_file['name'][$key] ;
					move_uploaded_file($value, $file_path);
					$item[] = [$this->_file['name'][$key], $file_path];
				}						

					break;

				case 'audio':
					foreach ($this->_file['tmp_name'] as $key => $value) {
					$file_path = Config::get('file/audio').substr(md5(time()),0,2).$this->_file['name'][$key] ;
					move_uploaded_file($value, $file_path);
					$item[] = [$this->_file['name'][$key], $file_path];
				}

					break;

				case 'video':
					foreach ($this->_file['tmp_name'] as $key => $value) {
					$file_path = Config::get('file/video').substr(md5(time()),0,2).$this->_file['name'][$key] ;
					move_uploaded_file($value, $file_path);
					$item[] = [$this->_file['name'][$key], $file_path];
				}

					break;
			
			}


		}
			return $item;

		}

	}






?>