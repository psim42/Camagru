<?php
if (isset($GLOBALS['HTTP_RAW_POST_DATA']))
{
    $set_filter = $GLOBALS['HTTP_RAW_POST_DATA'];
    $src = imagecreatefrompng('../resources/result/img.png');
    $dst = imagecreatetruecolor(1000,750);
    $filter = imagecreatefrompng("../resources/img/{$set_filter}.png");

    imagecopy($dst, $src, 0, 0, 0, 0, 1000, 750);
    imagecopy($dst, $filter, 60, 60, 0, 0, 318, 479);
    imagejpeg($dst, "../resources/result/result.png");
}
