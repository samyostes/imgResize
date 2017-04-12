<?php
//author Samson Y sayoseph@gmail.com
//this function resizes or crops image and display on the fly
function imgResize($tar,$size,$type){ 

//get image width and height
list($w, $h)=getimagesize($tar); 
$minMax=max($w,$h);

//get the image size and get the ratio of height and width in relation to the required size
  //'r' represnts resize
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

ob_start();// start the buffer

    //if request is to crop
    if($type=="c"){

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

        //resize keeping aspect ratio
        if($type=="r"){
         ob_start();
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
        $getImg=ob_get_clean();//get image from buffer
        imagejpeg($image_p, null, 90);
        $getImg=ob_get_clean();//get image from buffer
        return  "<img src='data:image/jpeg;base64," .base64_encode( $getImg) ."'/>";

                   }

  if($type=="c") { 
    
  imagecopyresampled($image_p, $image, 0, 0, $x, $y, $size, $size, $smallestSide, $smallestSide);
  imagejpeg($image_p, NULL, 90);
      $getImg=ob_get_clean();//get image from buffer
      return  "<img src='data:image/jpeg;base64," .base64_encode( $getImg) ."'/>";
                 }

}

//to test this pass an image as a paramater and put the desired size as a second param
//r =resize...image saved on the directory ;
echo imgResize("bird.jpg",800,"r"); 
echo "<p>"; 
//c=crop imaage not saved but shown on the fly
echo imgResize("bird.jpg",600,"c");

?>

