<div id="wrapper">

<section id="top_nav">
  <div id="logo">
    <a href="<?=base_url();?>">Home</a>
  </div>
  <p style="float:right;">
  <?if($logged_in):?>
  Welcome <a href="<?=base_url();?>user/<?=$username?>"><?=$username?></a> | <a href="<?=base_url();?>upload">Upload</a> | <a href="<?=base_url();?>ajax/logout">Logout</a>
  <?else:?>
  <a id="triggers" href="#" rel="#login"/>Login</a>
  <a id="triggers" href="#" rel="#register"/>Register</a>
  <?endif;?>
  </p>
</section>

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

</div>
