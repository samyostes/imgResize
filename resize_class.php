<?php
//author Samson Yoseph samjosus@yahoo.com
//this function resizes or crops image and display on the fly

class resize{
  private $target;
  private $size;
  private $type;
  private $width;
  private $height;
  private $minMax;
  private $percent;

  public function __construct($tar,$size){
$this->target=$tar;
$this->size=$size;
//$this->type=$type;


 list($w, $h)=getimagesize($this->target); //get image width and height
 $this->width=$w;
 $this->height=$h;
 //echo "Your image has the width of ".$this->width." and the height of ".$this->height."<br/>";
    $this->minMax=max($this->width,$this->height);
    //echo $this->minMax;




// resize image, good when user uploads high resolution image

   
    if($this->width>=$this->size or $this->height>=$this->size) {
    $this->percent=$this->size/$this->minMax; 
        }
     else {
     $this->percent=1;     
     }
     
$new_width=$this->width*$this->percent;
$new_height=$this->height*$this->percent;
echo $new_width;
//$image_p = imagecreatetruecolor($new_width, $new_height);


//crop the image and display on the browser on the fly 
//good to create thumbnails for image gallery and increases page load time
// if($type=="c"){
//     ob_start();// start the buffer
   
// //get the minimum of the height or width and reduce size without affecting resolution
//  if($w<$size and $h<$size) {
//      $size=min($h,$w);
//       }
// if ($w > $h){
//     $y = 0;  $x = ($w - $h) / 2; $smallestSide = $h;
//   } 
  
//   else {
//       $x = 0; $y = ($h - $w) / 2;$smallestSide = $w;
//        }
//   $image_p = imagecreatetruecolor($size, $size);
// }






  }






}

new resize("bird.jpg","","");
?>

