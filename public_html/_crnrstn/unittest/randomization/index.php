<?php

//print_r(gd_info());

header("Content-type: image/png");
$sizex = 800;
$sizey = 800;

$img = imagecreatetruecolor(3 * $sizex, $sizey) or die('Cannot Initialize new GD image stream');
$r = imagecolorallocate($img,255, 0, 0);
$g = imagecolorallocate($img,0, 255, 0);
$b = imagecolorallocate($img,0, 0, 255);
imagefilledrectangle($img, 0, 0, 3 * $sizex, $sizey, imagecolorallocate($img, 255, 255, 255));

$p = 0;
for($i=0; $i < 100000; $i++) {
    $np = rand(0,$sizex);
    imagesetpixel($img, $p, $np, $r);
    $p = $np;
}

$p = 0;
for($i=0; $i < 100000; $i++) {
    $np = mt_rand(0,$sizex);
    imagesetpixel($img, $p + $sizex, $np, $g);
    $p = $np;
}

$p = 0;
for($i=0; $i < 100000; $i++) {
    $np = floor($sizex*(hexdec(bin2hex(openssl_random_pseudo_bytes(4)))/0xffffffff));
    imagesetpixel($img, $p + (2*$sizex), $np, $b);
    $p = $np;
}

imagepng($img);
imagedestroy($img);