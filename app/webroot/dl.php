<?php

// Get the file URL from the request
if(!isset($_GET['file_url'])){ echo 'no file'; exit; }
$file_url = $_GET['file_url'];
//print_r($file_url); exit;

// Check if the file is public or private
if (strpos($file_url, 'public/') === 0) {
  // Public file
  $file_path = 'dl/'. substr($file_url, strlen('public/'));
} else {
  // Private file
  $private_files = array(
    'secret_file_1' => 'private/secret_file_1.txt',
    'secret_file_2' => 'private/secret_file_2.txt'
    // Add more files and their paths here
  );
  
  // Get the file path from the string
  $file_path = $private_files[$file_url];
}

//print_r($file_path); exit;
if(!is_file($file_path)){ echo 'no file found'; exit; }

// Set headers for file download
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . basename($file_path));
header("Content-Length: " . filesize($file_path));

// Read the file and output it to the browser
readfile($file_path);

exit;

/*
OLD VERSION - IMAGES ONLY
*/


$default_img = 'default.jpg';
$filename = !empty($_GET['file']) ? $_GET['file'] : $default_img;
$ext = pathinfo($filename, PATHINFO_EXTENSION);

//echo $ext; exit;
if($ext == "jpg"){
	$content_type = 'Content-type: image/jpeg';
	$image_create_func = 'imagecreatefromjpeg';
	$image_save_func = 'imagejpeg';	
} 
else if($ext == "png"){
	$content_type = 'Content-type: image/png';	
	$image_create_func = 'imagecreatefrompng';
	$image_save_func = 'imagepng';
}
else if($ext == "gif"){
	$content_type = 'Content-type: image/gif';	
	$image_create_func = 'imagecreatefromgif';
	$image_save_func = 'imagegif';
}
else {
	//echo 'unknown image file';
	exit;
}

if (!file_exists($filename)) {
	//echo 'image does not exit'; // show default
	if (file_exists($default_img)) {
		header('Content-type: image/jpeg');
		readfile($default_img);
	}
	exit;
}

// check for existing thumb file
if( (isset($_GET['width']) && is_numeric($_GET['width'])) || (isset($_GET['height']) && is_numeric($_GET['height'])) ) {
    $thumb_width = isset($_GET['width']) ? 'w' . $_GET['width'] . '_' : '';
    $thumb_height = isset($_GET['height']) ? 'w' . $_GET['height'] . '_' : '';
    $thumb_filename = 'thumb_' . $thumb_width . $thumb_height . $filename;
    if (file_exists($thumb_filename)) {
        header($content_type);
        readfile($thumb_filename);
        exit;
    }
}

//$image = $image_create_func($filename);
$image = @imagecreatefromstring(file_get_contents($filename));

// set custom dimensions
if(isset($_GET['width']) && is_numeric($_GET['width'])){
	$width = $_GET['width']; 
	$orig_width = imagesx($image);
	$orig_height = imagesy($image);

	// Calc the new height
	$height = (($orig_height * $width) / $orig_width);
	if(isset($_GET['height']) && is_numeric($_GET['height'])){
		$height = $_GET['height']; // height override
	}
	
	// Create new image to display
	$new_image = imagecreatetruecolor($width, $height);
	
	if($ext == "png"){ // preserve png
		imagealphablending( $new_image, false );
		imagesavealpha( $new_image, true );
		imagealphablending($image, true);
	}
	if($ext == "gif"){ // preserve gif
		imagealphablending($new_image, true);
		imagesavealpha( $new_image, true );
		$transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
		imagefill($new_image, 0, 0, $transparent);
	}

	// Create new image with changed dimensions
	imagecopyresampled($new_image, $image,
		0, 0, 0, 0,
		$width, $height,
		$orig_width, $orig_height);

    // save image to file
    $set_width = (isset($_GET['width']) && is_numeric($_GET['width']) ) ? 'w'.$_GET['width'].'_' : '';
    $set_height = (isset($_GET['height']) && is_numeric($_GET['height']) ) ? 'w'.$_GET['height'].'_' : '';
    $new_filename = 'thumb_' . $set_width . $set_height . $filename;
    $image_save_func($new_image, $new_filename);
	// Print image
	header($content_type);
	$image_save_func($new_image);
}
else { 
	header($content_type);
	//$image_save_func($image);
    readfile($filename);
}
?>