<?php
	
	App::uses('Component', 'Controller');
	
	
	/**
	 *
	 * CakePHP (version 2) component to upload, resize, crop and
	 * add watermark to images.
	 *
	 * @author Angelito M. Goulart <ange.sap@hotmail.com>
	 *
	 */
	class QimageComponent extends Component{
		
		/**
		 * Watermark image file (must be png)
		 *
		 * @var string
		 */
		public $watermarkImage;		


		/**
		 * Jpeg image quality (0 - 100)
		 *
		 * @var int
		 */
		public $jpgQuality;

		
		/**
		 * Property that will contain execution errors
		 *
		 * @var array
		 */
		private $errors;
	
		
		/**
		 * Initialize method. Initialize class properties.
		 *
		 * @param Controller $controller
		 */
		public function initialize(Controller $controller) {
			$this->watermarkImage = "img" . DIRECTORY_SEPARATOR . "watermark.png";
			$this->jpgQuality = 100;
			$this->errors = array();
		}
	
		
		/**
		 * Copy an uploaded image to the destination path
		 *
		 * $data['file'] 	-> array with image data (found in $_FILES)
		 * $data['path'] 	-> destination path
		 *
		 * @param array $data
		 * @return mixed
		 */
		public function copy($data){
			
			// Verify file and path
			if (!isset($data['file']) || !isset($data['path']) || !is_array($data['file'])){
				$this->errors[] = 'Name or path not found!';
				return false;
			}

			if (!is_writable($data['path'])){
				$this->errors[] = 'Destination path is not writable!';
				return false;
			}
			
			if (!$this->_verifyMime($data['file']['name'])){
				$this->errors[] = 'The file must be an jpg, gif or png image!';
				return false;
			}
			
			
			
			// Generate filename and move file to destination path
			$filename_array = explode('.', $data['file']['name']);
			$ext = end($filename_array);
			$ext = strtolower($ext);
			$name = uniqid() . date('dmYHis') . '.' . $ext;
			$complete_path = $data['path'] . DIRECTORY_SEPARATOR . $name;
			
			if (!move_uploaded_file($data['file']['tmp_name'], $data['path'] . $name)){
				$this->errors[] = 'Error while upload the image!';
				return false;
			}
			
			// Return image filename
			return $name;
			
		}
		
		
		
		public function avatar($data, $user_id){
			
			$data['path'] = WWW_ROOT.'/img/avatars/';
			
			// Verify file and path
			if (!isset($data['file']) || !isset($data['path']) || !is_array($data['file'])){
				$this->errors[] = 'Error.';
				return false;
			}

			if (!is_writable($data['path'])){
				$this->errors[] = 'Destination path is not writable!';
				return false;
			}
			
			if (!$this->_verifyMimeForAvatar($data['file']['name'])){
				$this->errors[] = 'Error.';
				return false;
			}
			
			$img = getimagesize($data['file']['tmp_name']);
			$original_width = $img[0];
			$original_height = $img[1];
			
			if (!($original_width == 50 AND $original_height == 50)){
				$this->errors[] = 'Error.';
				return false;
			}
			
			// Generate filename and move file to destination path
			$filename_array = explode('.', $data['file']['name']);
			$ext = end($filename_array);
			$ext = strtolower($ext);
			$name = $user_id . '.' . $ext;
			$complete_path = $data['path'] . DIRECTORY_SEPARATOR . $name;
			
			if(file_exists($complete_path)) {
				unlink($complete_path);
			}
			
			if (!move_uploaded_file($data['file']['tmp_name'], $data['path'] . $name)){
				$this->errors[] = 'Error.';
				return false;
			}
			
			// Return image filename
			return $ext;
			
		}


		public function photo($data, $user_id){
			
			$data['path'] = WWW_ROOT.'/img/photos/';
			
			// Verify file and path
			if (!isset($data['file']) || !isset($data['path']) || !is_array($data['file'])){
				$this->errors[] = 'Error.';
				return false;
			}

			if (!is_writable($data['path'])){
				$this->errors[] = 'Destination path is not writable!';
				return false;
			}
			
			if (!$this->_verifyMimeForPhoto($data['file']['name'])){
				$this->errors[] = 'Error.';
				return false;
			}
			
			$img = getimagesize($data['file']['tmp_name']);
			$original_width = $img[0];
			
			if (!($original_width < 231)){
				$this->errors[] = 'Error.';
				return false;
			}
			
			// Generate filename and move file to destination path
			$filename_array = explode('.', $data['file']['name']);
			$ext = end($filename_array);
			$ext = strtolower($ext);
			$name = $user_id . '.' . $ext;
			$complete_path = $data['path'] . DIRECTORY_SEPARATOR . $name;
			
			if(file_exists($complete_path)) {
				unlink($complete_path);
			}
			
			if (!move_uploaded_file($data['file']['tmp_name'], $data['path'] . $name)){
				$this->errors[] = 'Error.';
				return false;
			}
			
			// Return image filename
			return $ext;
			
		}

		
		public function newsPhoto($data){
			
			$path = WWW_ROOT.'/img/news/';
			
			// Verify file and path
			if (!isset($data) || !isset($path) || !is_array($data)){
				$this->errors[] = 'Error.';
				return false;
			}

			if (!is_writable($path)){
				$this->errors[] = 'Destination path is not writable!';
				return false;
			}
			
			if (!$this->_verifyMimeForPhoto($data['name'])){
				$this->errors[] = 'Error.';
				return false;
			}
			
			$img = getimagesize($data['tmp_name']);
			$original_width = $img[0];
			$original_height = $img[1];
			
			if (!($original_width < 601)){
				$this->errors[] = 'Error.';
				return false;
			}
			
			$file_size = $data['size'];
			if(!($file_size < 2097152)) {
				$this->errors[] = 'Error.';
				return false;
			}
			
			// Generate filename and move file to destination path
			$filename_array = explode('.', $data['name']);
			$ext = end($filename_array);
			$ext = strtolower($ext);
			$uidName = uniqid() . date('dmYHis');
			$name = $uidName . '.' . $ext;
			$complete_path = $path . DIRECTORY_SEPARATOR . $name;
			
			if (!move_uploaded_file($data['tmp_name'], $path . $name)){
				$this->errors[] = 'Error.';
				return false;
			}

			if($original_width > $original_height) {
				$percent = 200/$original_width;
				$mini_height = $original_height * $percent;
				$mini_height = round($mini_height);
				$img_mini = imagecreatefromjpeg($complete_path);
				$img_d_mini = imagecreatetruecolor(200, $mini_height);
				imagecopyresampled($img_d_mini, $img_mini, 0, 0, 0, 0, 200, $mini_height, $original_width, $original_height);
				imagejpeg($img_d_mini, $path . DIRECTORY_SEPARATOR . $uidName . "_mini." . $ext);
				imagedestroy($img_d_mini);
			} else {
				$percent = 200/$original_height;
				$mini_width = $original_width * $percent;
				$mini_width = round($mini_width);
				$img_mini = imagecreatefromjpeg($complete_path);
				$img_d_mini = imagecreatetruecolor($mini_width, 200);
				imagecopyresampled($img_d_mini, $img_mini, 0, 0, 0, 0, $mini_width, 200, $original_width, $original_height);
				imagejpeg($img_d_mini, $path . DIRECTORY_SEPARATOR . $uidName . "_mini." . $ext);
				imagedestroy($img_d_mini);
			}
			
			// Return image filename
			return $name;
			
		}

		public function uploadWork($user_id, $data){
			
			/*unlink($path_source . $user_id . "/" . $file_name);
			unlink($path_source . "minis/mini/" . $user_id . "/" . $user_id . "_" . $file_name);
			unlink($path_source . "minis/supermini/" . $user_id . "/" . $user_id . "_" . $file_name);*/
			
			$path = WWW_ROOT.'/img/works/';
			$pathOriginalFile = $path . $user_id . "/";
			$pathMiniFile = $path . "minis/mini/" . $user_id . "/";
			$pathSuperminiFile = $path . "minis/supermini/" . $user_id . "/";
			
			// Verify file and path
			if (!isset($data) || !isset($path) || !is_array($data)){
				$this->errors[] = 'Error.';
				return false;
			}

			if (!is_writable($path)){
				$this->errors[] = 'Destination path is not writable!';
				return false;
			}
			
			if (!$this->_verifyMimeForPhoto($data['name'])){
				$this->errors[] = 'Error.';
				return false;
			}
			
			$img = getimagesize($data['tmp_name']);
			$upload_w1 = $img[0];
			$upload_w2 = $img[1];
			
			$file_size = $data['size'];
			if(!($file_size < 512000)) {
				$this->errors[] = 'Error.';
				return false;
			}
			
			// Generate filename and move file to destination path
			$filename_array = explode('.', $data['name']);
			$ext = end($filename_array);
			$ext = strtolower($ext);
			$uidName = uniqid() . date('dmYHis');
			$name = $uidName . '.' . $ext;
			$complete_path = $pathOriginalFile . $name;
			
			if(file_exists($complete_path)) {
				unlink($complete_path);
			}
			
			if (!move_uploaded_file($data['tmp_name'], $complete_path)){
				$this->errors[] = 'Error.';
				return false;
			}
			
			//mini
			$mini_w1m=$upload_w1-($upload_w1*0.2);
			$mini_w2m=$upload_w2-($upload_w2*0.2);
			$mini_w1m = round($mini_w1m);
			$mini_w2m = round($mini_w2m);
			if($mini_w1m < 530) {
				$procent = 0.2;
			} else {
				$mini_w1m=$upload_w1-($upload_w1*0.4);
				$mini_w2m=$upload_w2-($upload_w2*0.4);
				$mini_w1m = round($mini_w1m);
				$mini_w2m = round($mini_w2m);
				if($mini_w1m < 530) {
					$procent = 0.4;
				} else {
					$mini_w1m=$upload_w1-($upload_w1*0.6);
					$mini_w2m=$upload_w2-($upload_w2*0.6);
					$mini_w1m = round($mini_w1m);
					$mini_w2m = round($mini_w2m);
					if($mini_w1m < 530) {
						$procent = 0.6;
					} else {
						$procent = 0.8;
					}
				}
			}
			$mini_w1m=$upload_w1-($upload_w1*$procent);
			$mini_w2m=$upload_w2-($upload_w2*$procent);
			$mini_w1m = round($mini_w1m);
			$mini_w2m = round($mini_w2m);
			
			if(file_exists($pathMiniFile . $user_id . "_" . $name)) {
				unlink($pathMiniFile . $user_id . "_" . $name);
			}
			
			$img_mini = imagecreatefromjpeg($complete_path);
			$img_d_mini = imagecreatetruecolor($mini_w1m, $mini_w2m);
			imagecopyresampled($img_d_mini, $img_mini, 0, 0, 0, 0, $mini_w1m, $mini_w2m, $upload_w1, $upload_w2);
			imagejpeg($img_d_mini, $pathMiniFile . $user_id . "_" . $name);
			imagedestroy($img_d_mini);
			
			//supermini
			if(file_exists($pathSuperminiFile . $user_id . "_" . $name)) {
				unlink($pathSuperminiFile . $user_id . "_" . $name);
			}
			
			$img_supermini = imagecreatefromjpeg($complete_path);
			if($upload_w1 > $upload_w2) {
				$procent = 96/$upload_w1;
				$mini_w2n = $upload_w2*$procent;
				$mini_w2n = round($mini_w2n);
				$img_d_supermini = imagecreatetruecolor(96, $mini_w2n);
				imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, 0, 0, 96, $mini_w2n, $upload_w1, $upload_w2);
			} else {
				$procent = 96/$upload_w2;
				$mini_w1n = $upload_w1*$procent;
				$mini_w1n = round($mini_w1n);
				$img_d_supermini = imagecreatetruecolor($mini_w1n, 96);
				imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, 0, 0, $mini_w1n, 96, $upload_w1, $upload_w2);
			}
			imagejpeg($img_d_supermini, $pathSuperminiFile . $user_id . "_" . $name);
			imagedestroy($img_d_supermini);
			
			// Return image filename
			return $name;
			
		}

		public function deleteWork($user_id, $file_name){
			$path_source = WWW_ROOT.'/img/works/';
			
			unlink($path_source . $user_id . "/" . $file_name);
			unlink($path_source . "minis/mini/" . $user_id . "/" . $user_id . "_" . $file_name);
			unlink($path_source . "minis/supermini/" . $user_id . "/" . $user_id . "_" . $file_name);
			
			return true;
		}

		public function cronDG($user_id, $file_name){
			
			$path_source = WWW_ROOT.'/img/works/';
			$path_destination = WWW_ROOT.'/img/dg/';
			
			$img = getimagesize($path_source . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $file_name);
			$w = $img[0];
			$h = $img[1];
			
			$half_w = 0;
			$half_h = 0;
			
			$source_w = 436;
			$source_h = 123;
			
			if($w > 436) {
				if($h > 123) {
					$half_w = $w/2;
					$half_w = $half_w-218;
					$half_h = $h/2;
					$half_h = $half_h-62;
				} else {
					$percent_h = $h/123;
					$source_w = floor(436 * $percent_h);
					$half_w = $w/2;
					$half_w = $half_w-218;
					$half_h = 0;
				}
			} else {
				if($h > 123) {
					$percent_w = $w/436;
					$source_h = floor(123 * $percent_w);
					$half_w = 0;
					$half_h = $h/2;
					$half_h = $half_h-62;
				} else {
					$half_w = 0;
					$half_h = 0;
					
					$percent_w = $w/436;
					$source_h = floor(123 * $percent_w);
					
					$percent_h = $h/123;
					$source_w = floor(436 * $percent_h);
				}
			}
			
			$img_supermini = imagecreatefromjpeg($path_source . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $file_name);
			$img_d_supermini = imagecreatetruecolor(436, 123);
			if($w > 436) {
				if($h > 123) {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 436, 123, 436, 123);
				} else {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 436, 123, $source_w, $h);
				}
			} else {
				if($h > 123) {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 436, 123, $w, $source_h);
				} else {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 436, 123, $source_w, $source_h);
				}
			}
			imagejpeg($img_d_supermini, $path_destination . DIRECTORY_SEPARATOR . $user_id . "_" . $file_name);
			imagedestroy($img_d_supermini);
			
			return true;
			
		}

		public function cronDGBIG($user_id, $file_name){
			
			$path_source = WWW_ROOT.'/img/works/';
			$path_destination = WWW_ROOT.'/img/dg/';
			
			$img = getimagesize($path_source . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $file_name);
			$w = $img[0];
			$h = $img[1];
			
			$half_w = 0;
			$half_h = 0;
			
			$source_w = 1170;
			$source_h = 300;
			
			if($w > 1170) {
				if($h > 300) {
					$half_w = $w/2;
					$half_w = $half_w-585;
					$half_h = $h/2;
					$half_h = $half_h-150;
				} else {
					$percent_h = $h/300;
					$source_w = floor(1170 * $percent_h);
					$half_w = $w/2;
					$half_w = $half_w-585;
					$half_h = 0;
				}
			} else {
				if($h > 300) {
					$percent_w = $w/1170;
					$source_h = floor(300 * $percent_w);
					$half_w = 0;
					$half_h = $h/2;
					$half_h = $half_h-150;
				} else {
					$half_w = 0;
					$half_h = 0;
					
					$percent_w = $w/1170;
					$source_h = floor(300 * $percent_w);
					
					$percent_h = $h/300;
					$source_w = floor(1170 * $percent_h);
				}
			}
			
			$img_supermini = imagecreatefromjpeg($path_source . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $file_name);
			$img_d_supermini = imagecreatetruecolor(1170, 300);
			if($w > 1170) {
				if($h > 300) {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 1170, 300, 1170, 300);
				} else {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 1170, 300, $source_w, $h);
				}
			} else {
				if($h > 300) {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 1170, 300, $w, $source_h);
				} else {
					imagecopyresampled($img_d_supermini, $img_supermini, 0, 0, $half_w, $half_h, 1170, 300, $source_w, $source_h);
				}
			}
			imagejpeg($img_d_supermini, $path_destination . DIRECTORY_SEPARATOR . $user_id . "_BIG_" . $file_name);
			imagedestroy($img_d_supermini);
			
			return true;
			
		}
		
		
		
		/**
		 * Method responsible for resize an image. Return false on error.
		 *
		 * $data['file']                -> complete path of original image file
		 * $data['width']               -> new width
		 * $data['height']              -> new height
		 * $data['output']              -> output path where resized image will be saved
		 * $data['proportional']        -> (true or false). If true, the image will be resized 
		 * only if its dimensions are larger than the values reported in width and height 
		 * parameters. Default: true.
		 *
		 * If only the width or height is given, the function will automatically calculate 
		 * whether the image is horizontal or vertical and will automatically apply the informed 
		 * size in the correct property (width or height).
		 *
		 * @param array $data
		 * @return bool
		 */
		public function resize($data){
			
			// Verify parameters
			if (!isset($data['file']) || (!isset($data['width']) && !isset($data['height']))){
				$this->errors[] = 'Invalid filename or width/height!';
				return false;
			}
			
			if (!isset($data['output']) || !is_dir($data['output'])){
				$this->errors[] = 'Invalid output dir!';
				return false;
			}
			
			$data['proportional'] = (isset($data['proportional'])) ? $data['proportional'] : true;

			$data['height'] = (isset($data['height'])) ? $data['height'] : 0;
			$data['width']  = (isset($data['width']))  ? $data['width']  : 0;
			
			if (!is_writable($data['output'])){
				$this->errors[] = 'Output dir is not writable!';
				return false;
			}
			
			if (!is_file($data['file'])){
				$this->errors[] = 'Invalid file!';
				return false;
			}
		
			if(!$this->_verifyMime($data['file'])){
				$this->errors[] = 'Invalid file type!';
				return false;
			}
				
			if (!isset($data['proportional']))
				$data['proportional'] = true;	
			
			// Validates width and height
			$width  = (isset($data['width']))  ? (int) $data['width']  : 0;
			$height = (isset($data['height'])) ? (int) $data['height'] : 0;		
			
			// Get attributes of image
			$img = getimagesize($data['file']);
			$original_width = $img[0];
			$original_height = $img[1];
			$mime = $img['mime'];
					 			
			$source = ($mime == 'image/png') ? imagecreatefrompng($data['file']) : imagecreatefromstring(file_get_contents($data['file']));
			$filename = basename($data['file']);
			$output = $data['output'] . $filename;
			
			// Verify if resize it's necessary
			if (($width > $original_width || $height > $original_height) && $data['proportional'] === true){
			
				$width = $original_width;
				$height = $original_height;
			
			} else {
				
				// If width or height not defined, it's necessary calculate proportional size
				if (!($width > 0 && $height > 0)){
					
					
					// Verify if image is horizontal or vertical
					if ($original_height > $original_width){
						$height = ($data['width'] > 0) ? $data['width'] : $data['height'];
						$width  = ($height / $original_height) * $original_width;
					} else {
						$width = ($data['height'] > 0) ? $data['height'] : $data['width'];
						$height = ($width / $original_width) * $original_height;
					}
					
				} 
			
			}
			
			// Generate thumb
			$thumb = imagecreatetruecolor($width, $height);
			
			// Add transparency if image is png
			if ($mime == 'image/png') {
				imagealphablending($thumb, false);
				imagesavealpha($thumb,true);
				$transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
				imagefilledrectangle($thumb, 0, 0, $width, $height, $transparent);
			} 
			
			// Finish image
			imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $original_width, $original_height);
			$finishFunction = $this->_getFinishFunction($mime); 
						
			if (false === $finishFunction) { 
				$this->errors[] = 'Invalid file type.';
				return false;	
			} elseif ($mime == 'image/jpeg' || $mime == 'image/pjpeg') {
				$finishFunction($thumb, $output, (int) $this->jpgQuality);
			} else {
				$finishFunction($thumb, $output);
			} 

			return true;
			
		}


		/**
		 * Method to crop an image
		 * 
		 * $data['file']        -> complete path of original image file
		 * $data['w']           -> width of crop area
		 * $data['h']           -> height of crop area
		 * $data['x']           -> x coordinate of source point
		 * $data['y']           -> y coordinate of source point
		 * $data['output']      -> output path where cropped image will be saved
		 *
		 * @param array $data
		 * @return bool
		 */
		public function crop($data = array()){

			// Validates params
			if (!isset($data['file']) ||
			    !isset($data['w']) ||
			    !isset($data['h']) ||
			    !isset($data['x']) ||
			    !isset($data['y']) ||
			    !isset($data['output'])) {
				 $this->errors[] = 'Params missing!';
			}
			
			if (!is_file($data['file'])) {
				$this->errors[] = 'Invalid image!';
				return false;
			}

			if (!is_dir($data['output']) || !is_writable($data['output'])) {
				$this->errors[] = 'Output dir is not a dir or not writeable!';
				return false;
			}

			// Output path
			$path = $data['output'] . DIRECTORY_SEPARATOR . basename($data['file']);

			// Get image data
			$img = getimagesize($data['file']);

			$createFunction = $this->_getCreateFunction($img['mime']);
			$finishFunction = $this->_getFinishFunction($img['mime']);

			// Create source and destination image
			$src_img = $createFunction($data['file']);
			$dst_img = imagecreatetruecolor($data['w'], $data['h']);

			// Crop image
			imagecopyresampled($dst_img, 
					   $src_img, 
					   0, 
					   0, 
					   (int) $data['x'], 
					   (int) $data['y'],
	        			   (int) $data['w'],
	        			   (int) $data['h'],
	        			   (int) $data['w'], 
	        			   (int) $data['h']);

			// Finish image
			if ($img['mime'] == 'image/jpeg' || $img['mime'] == 'image/pjpeg'){
				$finishFunction($dst_img, $path, (int) $this->jpgQuality);
			} else {
				$finishFunction($dst_img, $path);
			}

		}
		
		
		/** 
		 * Verifies the mime-type of a file
		 *
		 * @param string $file
		 * @return bool
		 */
		private function _verifyMime($file){
			
			$filename_array = explode('.',$file);

			$extension = end($filename_array);
			
			$extension = strtolower($extension);
			
			$mimes = array('jpeg', 'jpg', 'png', 'gif');
			
			if (in_array($extension, $mimes)){
				return true;
			} else {
				return false;
			}
			
		}
		
		private function _verifyMimeForPhoto($file){
			
			$filename_array = explode('.',$file);

			$extension = end($filename_array);
			
			$extension = strtolower($extension);
			
			$mimes = array('jpg');
			
			if (in_array($extension, $mimes)){
				return true;
			} else {
				return false;
			}
			
		}
		
		private function _verifyMimeForAvatar($file){
			
			$filename_array = explode('.',$file);

			$extension = end($filename_array);
			
			$extension = strtolower($extension);
			
			$mimes = array('jpg', 'gif');
			
			if (in_array($extension, $mimes)){
				return true;
			} else {
				return false;
			}
			
		}


		/**
		 * Method to get the specific function to create an image
		 * 
		 * @param string $mime
		 * @return string
		 */
		private function _getCreateFunction($mime){
		    if ($mime == 'image/jpeg' || $mime == 'image/pjpeg'){
	            	return 'imagecreatefromjpeg';
		    } elseif ($mime == 'image/gif') {
		        return 'imagecreatefromgif';
		    } elseif ($mime == 'image/png') {
		        return 'imagecreatefrompng';
		    } else {
		        $this->errors[] = 'Invalid file type!';
		        return false;
		    }
		}


		/**
		 * Method to get the specific function to finish an image
		 *
		 * @param string $mime
		 * @return string
		 */
		private function _getFinishFunction($mime) {
			if ($mime == 'image/jpeg' || $mime == 'image/pjpeg'){
				return 'imagejpeg';
			} elseif ($mime == 'image/gif') {
				return 'imagegif';
			} elseif ($mime == 'image/png') {
				return 'imagepng';
			} else {
				$this->errors[] = 'Invalid file type.';
				return false;	
			}
		}


		/**
		 * Get errors
		 *
		 * @return array
		 */
		public function getErrors() {
			return $this->errors;
		}

		
	}
	
?>
