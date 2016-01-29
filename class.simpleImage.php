<?php 
class simpleImage {
	protected 			$image 				= null; // image
	protected static    $thumbnail_image   = 500; // The width size of a thumbnail.
	/*
		*
		* @str
		*
	*/	
	public function getImage($str){
		$this->image = $str;
	}
	/*
		*
		* #imageType
		*
	*/
	private function imageType(){
		$imageType = strrchr($this->image,".");
		if($imageType == ".JPG" || $imageType == ".jpg"){
			return true;
		}else {
			return false;
		}
	}
	/*
		*
		* #img
		* #width
		* #height
		*
	*/	
	private function imageSize(){
		$img = imagecreatefromjpeg("{$this->image}");
		$width = imagesx($img);
		$height = imagesy($img);
		return array(
			"img"     	=> $img,
			"width" 	=> $width,
			"height" 	=> $height
		);
	}
	/*
		*
		* #orginalImageSize
		* #new_width
		* #new_height
		*
	*/		
	private function newImageSize(){
		$orginalImageSize = self::imageSize();
		$new_width  = self::$thumbnail_image;
		$new_height = floor($orginalImageSize["height"]*(self::$thumbnail_image/$orginalImageSize["width"]));
		return array(
			"new_width" 	=> $new_width,
			"new_height" 	=> $new_height
		);
	}
	private function createImage(){
		$orginalImageSize	 = self::imageSize();
		$newImageSize		 = self::newImageSize();
		$thump		 = imagecreatetruecolor($newImageSize["new_width"],$newImageSize["new_height"]);
		imagecopyresized($thump,$orginalImageSize["img"],0,0,0,0,$newImageSize["new_width"],$newImageSize["new_height"],$orginalImageSize["width"],$orginalImageSize["height"]);
		return $thump;
	}
	/*
		*
		* @name folder name
		*
	*/
	public function smallImageToSaveFolder($name){
		if(!is_dir($name)){	
			mkdir($name); 
			echo "Folder was created: <b style='color:red'>".$name."</b><br/>";	
		}
		if(!self::imageType()){
			echo "Error";
		}else{
			$time = date("d-m-Y-H-i-s");
			$imageName = $time."-".$this -> image;
			$folder = $name."/";
			imagejpeg(self::createImage(),"{$folder}{$imageName}");
			echo "Small image has been created: <b style='color:red'>".$imageName."</b>";
		}
	}
	
}

?>
