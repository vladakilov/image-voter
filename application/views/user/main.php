<div id="wrapper">
	
<div id="top_nav">
  <p style="float:right;">
  <?if($logged_in):?>
  <a href="<?=base_url();?>user/<?=$username?>"><?=$username?></a> | <a href="<?=base_url();?>upload">Upload</a> | <a href="<?=base_url();?>ajax/logout">Logout</a>
  <?else:?>
  <a id="triggers" href="#" rel="#login"/>Login</a>
  <a id="triggers" href="#" rel="#register"/>Register</a>
  <?endif;?>
  </p>
</div>

<div id="wrapper">
<? 
var_dump($user_data);
foreach ($user_data as $user):
echo $user;
endforeach;
?>
    
</div>
