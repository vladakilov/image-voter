<?
// Stream image to browser
header('Content-type: image/jpeg');
echo $photo->getBytes();
?>