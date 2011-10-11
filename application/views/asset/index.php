<style>
#main_asset_content{float:left; width:67%;}
#sidebar{float:right; width:33%; overflow:hidden;}
#image_content{border:solid #333 5px; width:500px;}
#comments{float: left; width: 67%;}
img{max-width: 500px; max-height: 500px;}
.down_vote{color:red;}
.up_vote{color:green;}
.no_vote{color:black;}
</style>
<script>
$(document).ready(function () {
  // Make a vote
  $(".up, .down").click(function () {
    submit_vote($(this).attr('class').split(' ')[0], $(this).attr('id').split(' ')[0], $(this));
  });
});
</script>
<div id="wrapper">

  <header id="top_nav">
    <p style="float:right;">
    <?if($logged_in):?>
    Welcome <a href="<?=base_url();?>user/<?=$username?>"><?=$username?></a> | <a href="<?=base_url();?>upload">Upload</a> | <a href="<?=base_url();?>ajax/logout">Logout</a>
    <?else:?>
    <a id="triggers" href="#" rel="#login"/>Login</a>
    <a id="triggers" href="#" rel="#register"/>Register</a>
    <?endif;?>
    </p>
  </header>

  <section id="main_asset_content">
    <table>
      <tr>
        <td>
          <?if($already_voted_up):?>
          <a href="javascript:;" class="up up_vote up<?=$_id?>" id="<?=$_id?>">Up Vote</a>
          <p class="count"><?=$up_votes?></p>
          <?else:?>
          <a href="javascript:;" class="up no_vote" id="<?=$_id?>">Up Vote</a>
          <p class="count"><?=$up_votes?></p>
          <?endif;?>
        </td>
        <td>
          <?if($already_voted_down):?>
          <a href="javascript:;" class="down down_vote down<?=$_id?>" id="<?=$_id?>">Down Vote</a>
          <p class="count"><?=$down_votes?></p>
          <?else:?>
          <a href="javascript:;" class="down no_vote" id="<?=$_id?>">Down Vote</a>
          <p class="count"><?=$down_votes?></p>
          <?endif;?>
        </td>
      </tr>
    </table>
    <div id="image_content">
      <img src="<?=base_url()?>main/image/<?=$_id?>" title="<?=$description?>">
    </div>
  </section>

  <section id="comments">
    <h2><p>Comments</p></h2>
    <div id="disqus_thread"></div>
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

<script type="text/javascript">
    var disqus_shortname = 'testapp'; // required: replace example with your forum shortname
    var disqus_url = 'http://example.com/permalink-to-page.html';
    var disqus_identifier = '<?=$_id?>';
    //var disqus_url = '<?=base_url()?>asset/<?=$_id?>';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
