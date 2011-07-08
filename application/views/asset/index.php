<style>
#main_asset_content{float:left; width:67%;}
#sidebar{float:right; width:33%; overflow:hidden;}
#image_content{border:solid #333 5px; width:500px;}
#comments{float: left; width: 67%;}
img{max-width: 500px; max-height: 500px;}
</style>
<div id="wrapper">

  <div id="top_nav">
    <p style="float:right;">
    <?if($logged_in):?>
    Welcome <a href="<?=base_url();?>user/<?=$username?>"><?=$username?></a> | <a href="<?=base_url();?>upload">Upload</a> | <a href="<?=base_url();?>ajax/logout">Logout</a>
    <?else:?>
    <a id="triggers" href="#" rel="#login"/>Login</a>
    <a id="triggers" href="#" rel="#register"/>Register</a>
    <?endif;?>
    </p>
  </div>

  <section id="main_asset_content">
    <div id="image_content">
      <img src="<?=base_url()?>main/image/<?=$_id?>" title="<?=$description?>">
    </div>
    <div id="comments">
      <h2><p>Comments</p></h2>
    </div>
  </section>

  <section id="sidebar">
    <div class="single_content_submitted_by">
      <p>Submitted by: <?=$submitted_by?></p>
    </div>
    <div class="single_content_tags">
      <p>Filed Under:</p>
      <ul>
        <li><?=$tags?></li>
      </ul>
    </div>
    <div class="single_content_user_pics">
      <p>Other pictures from Username:<?=$submitted_by?></p>
    </div>
  </section>

</div>
