<?php
$hidden = array('username' => $username);
echo form_open_multipart('upload/do_upload', '', $hidden);
echo form_label('Description for image:', 'description');
echo form_input(array('name' => 'description', 'id' => 'description'));
echo form_input(array('name' => 'tags', 'id' => 'tags'));
echo form_upload('file');
echo form_submit('submit', 'Upload File');
echo form_close();
?>
