<?php

$hidden = array('user_id' => '1234');
echo form_open_multipart('upload/do_upload', '', $hidden); 
echo form_upload('file');
echo '</br>';
echo form_submit('submit', 'Upload File');
echo form_close();
?>
