<?php
if (isset($GLOBALS['HTTP_RAW_POST_DATA']))
{
    $data = $GLOBALS['HTTP_RAW_POST_DATA'];
    if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
        $data = substr($data, strpos($data, ',') + 1);
        $data = base64_decode($data);
    
        if ($data === false) {
            throw new \Exception('base64_decode failed');
        }
    } else {
        throw new \Exception('did not match data URI with image data');
    }
    file_put_contents("../resources/result/img.png", $data);
}
?>
