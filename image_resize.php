<?php
//author Samson Yoseph samjosus@yahoo.com
//this function resizes or crops image and display on the fly
//try it by inserting path of the image, desired size and type ( c for crop and r for resize)
function imgResize($tar,$size,$type){ 

list($w, $h)=getimagesize($tar); //get umage width and height
$minMax=max($w,$h);

// resize image when user uploads large image
if($type=="r"){
   
    if($w>=$size or $h>=$size) {
    $percent=$size/$minMax; 
        }
     else {
     $percent=1;     
     }
     
$new_width=$w*$percent;
$new_height=$h*$percent;
$image_p = imagecreatetruecolor($new_width, $new_height);
}
//crop the image to square and display on the browser on the fly 
if($type=="c"){
    ob_start();// start the buffer
   
//get the minimum of the height or width and reduce size without affecting resolution
 if($w<$size and $h<$size) {
     $size=min($h,$w);
      }
if ($w > $h){
    $y = 0;  $x = ($w - $h) / 2; $smallestSide = $h;
  } 
  
  else {
      $x = 0; $y = ($h - $w) / 2;$smallestSide = $w;
       }
  $image_p = imagecreatetruecolor($size, $size);
}

$image = imagecreatefromjpeg($tar);

//resize image by keeping aspect ratio
if($type=="r"){
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
imagejpeg($image_p, $tar, 90);
    return '<img src="'.$tar.'"/>';

}

//crop the image 
if($type=="c") { 
imagecopyresampled($image_p, $image, 0, 0, $x, $y, $size, $size, $smallestSide, $smallestSide);
imagejpeg($image_p, NULL, 90);
    $getImg=ob_get_clean();//get image from buffer
    return  "<img src='data:image/jpeg;base64," .base64_encode( $getImg) ."'/>";
}

}


//r =resize ;
echo imgResize("flower.jpg",500,"r"); 
echo "<p>"; 

//c=crop image not saved but shown on the fly
echo imgResize("flower.jpg",200,"c");

?>

