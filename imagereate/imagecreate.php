<?php

//    $my_img = imagecreate(200, 80);
//    $background = imagecolorallocate($my_img, 0, 0, 255);
//    $text_colour = imagecolorallocate($my_img, 255, 255, 0);
//    $line_colour = imagecolorallocate($my_img, 128, 255, 0);
//    imagestring($my_img, 4, 30, 25, "This is a test image", $text_colour);
//    imagesetthickness($my_img,5);
//    imageline($my_img, 30, 45, 165, 45, $line_colour);
//
//    header("Content-type:  image/png");
//    imagepng($my_img);
//    imagecolorallocate($line_colour);
//    imagecolorallocate($line_colour);
//    imagecolorallocate($line_colour);
//    imagedestroy($my_img);

    $img = imagecolorallocate(200, 200);

    $white = imagecolorallocate($img, 255, 255, 255);
    $red = imagecolorallocate($img, 255, 0, 0);
    $green = imagecolorallocate($img, 0, 255, 0);
    $blue = imagecolorallocate($img, 0, 0, 255);

    imagearc($img, 100, 100, 200, 200, 0, 360, $white);
imagearc($img, 100, 100, 150, 150, 25, 150, $red);
imagearc($img, 60, 75, 50, 50, 0, 360, $green);
imagearc($img, 140, 75, 50, 50, 0, 360, $blue);

    header("Content-type: image/png");
    imagepng($img);


    imagedestroy($img);

?>