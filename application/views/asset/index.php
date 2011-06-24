<style>
#wrapper{margin: 0 auto; width: 1000px;}
#image_content{float:left;}
#comments{float: left;}
#sidebar{float:right;}
img{max-width: 500px; max-height: 500px;}
</style>
<div id="wrapper">
  <div id="image_content">
    <img src="<?=base_url()?>main/image/<?=$_id?>">
  </div>
  <div id="comments">
    <h2><p>Comments</p></h2>
  </div>
  <div id="sidebar">
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
  </div>
</div>
