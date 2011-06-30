<style>
#wrapper{margin: 0 auto; width: 1000px;}
#image_content{float:left;}
#comments{float: left;}
#sidebar{float:right;}
img{max-width: 500px; max-height: 500px;}
</style>
<div id="wrapper">
  <div id="image_content">
	Single user page
  </div>
  <div id="comments">
	<p>
	<?foreach($user_data['user']['image_votes'] as $votes):?>
	<?=$votes?></br>
	<?endforeach;?>
	</p>
  </div>
  <div id="sidebar">
    <div class="single_content_submitted_by">
      <p>posts Submitted by user: </p>
    </div>
    <div class="single_content_tags">
      <p>Filed Under:</p>
      <ul>
        <li></li>
        <li>tag2</li>
        <li>tag3</li>
      </ul>
    </div>
    <div class="single_content_user_pics">
      <p>Other pictures from Username:</p>
    </div>
  </div>
</div>
