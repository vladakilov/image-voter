<?
// Stream image to browser
header('Content-type: image/jpg');
echo $photo->getBytes();
?>