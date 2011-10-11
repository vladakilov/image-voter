<script>
$(document).ready(function () {
  // Make a vote
  $(".up, .down").click(function () {
    submit_vote($(this).attr('class').split(' ')[0], $(this).attr('id').split(' ')[0], $(this));
  });
});
</script>

<style>
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
  display: block;
}
body {
  line-height: 1;
}
ol, ul {
  list-style: none;
}
blockquote, q {
  quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
  content: '';
  content: none;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}





a{text-decoration:none; color:#BE0527;}
a:hover{text-decoration:none; color:#34B0AF;}
li{display:inline; list-style: none;}
.single_post_content{width:700px; overflow:hidden;height:inherit;border:1px solid #333;padding:20px 10px; color:#022328;}
.post_header{margin-left:5px;float:left; width:500;}
.header_meta{margin-bottom:20px;}
.post_content{margin-left:55px;float:left; width:500;}
.description{line-height:1.5;color:#666;}
p.description:hover{color:#333;}

.post_title{font-size:16px;}
.post_links{color:#1D1C2A;margin-top:10px;}
.post_links li{width:100px;}

.votes{float:left; width:50px; height:50px;}

/*UP VOTES*/
#votes_up{width:30px; height:25px;}
ul#votes_up li.up_vote{float:left;width:11px;height:10px;background:url('<?=base_url();?>/static/img/arrow.png') no-repeat -22px 0px scroll transparent;cursor:pointer;display:block;text-indent: -9999em;}
ul#votes_up li.up_vote:hover{background:url('<?=base_url();?>/static/img/arrow.png') no-repeat -22px -20px scroll transparent;}
.up_count{float:right;}

/*DOWN VOTES*/
#votes_down{width:30px; height:25px;}
.down_vote{float:left;width:11px;height:10px;background:url('<?=base_url();?>/static/img/arrow.png') no-repeat 0px 0px scroll transparent;cursor:pointer;display:block;text-indent: -9999em;}
li.down_vote:hover{background:url('<?=base_url();?>/static/img/arrow.png') no-repeat 0px -20px scroll transparent;}
.down_count{float:right;}

/* NO VOTES */
ul#votes_up li.no_vote{float:left;width:11px;height:10px;background:url('<?=base_url();?>/static/img/arrow.png') no-repeat -22px -20px scroll transparent;cursor:pointer;display:block;text-indent: -9999em;}
ul#votes_up li.no_vote:hover{background:url('<?=base_url();?>/static/img/arrow.png') no-repeat -22px 0px scroll transparent;}
ul#votes_down li.no_vote{float:left;width:11px;height:10px;background:url('<?=base_url();?>/static/img/arrow.png') no-repeat 0px -20px scroll transparent;cursor:pointer;display:block;text-indent: -9999em;}
ul#votes_down li.no_vote:hover{background:url('<?=base_url();?>/static/img/arrow.png') no-repeat 0px 0px scroll transparent;}

.post_img_thumb{float:right; position:relative; width:100px; height:100px;background:#333;overflow:hidden;}

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

<!-- The loop to show all assets -->
<?foreach ($documents as $document):?>

<div class="single_post_content">
  <div class="votes">
    <ul id="votes_up">
      <?if($document['already_voted_up']):?>
      <li class="up up_vote up<?=$document['_id']?>" id="<?=$document['_id']?>">upvote</li>
      <li class="up_count"><?=$document['up_votes']?></li>
      <?else:?>
      <li class="up no_vote" id="<?=$document['_id']?>">upvote</li>
      <li class="up_count"><?=$document['up_votes']?></li>
      <?endif;?>
    </ul>
    <ul id="votes_down">
      <?if($document['already_voted_down']):?>
      <li class="down down_vote down<?=$document['_id']?>" id="<?=$document['_id']?>">downvote</li>
      <li class="down_count"><?=$document['down_votes']?></li>
      <?else:?>
      <li class="down no_vote" id="<?=$document['_id']?>">downvote</li>
      <li class="down_count"><?=$document['down_votes']?></li>
      <?endif;?>
    </ul>
  </div>
  <div class="post_img_thumb"><img src="<?=base_url();?>main/image/<?=$document['_id']?>" width="150" height="150"/></div>

  <div class="post_header">
    <h2 class="post_title">
      <a href="<?=base_url();?>asset/<?=$document['_id']?>"></a>
    </h2>
    <p class="header_meta">
      By
      <a href="<?=base_url();?>user/<?=$document['submitted_by']?>"><?=$document['submitted_by']?></a>
      <time class="properCase" datetime="2011-05-31T17:26:20" pubdate="pubdate"> 50 days ago</time>
      on
      <a class="tag" href="#">Science</a>
    </p>
  </div>

  <div class="post_content">
    <p class="description">asdfasdfasdfasdfasdf</p>
    <ul class="post_links">
      <li><a href="#">Read More</a></li>
      <li><a href="#">Comments</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Facebook</a></li>
      <li><a href="#">G+</a></li>
    </ul>
  </div>
</div>
<?endforeach;?>
<!-- End loop -->
</div>