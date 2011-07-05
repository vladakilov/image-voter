<script>
$(document).ready(function () {
  // Make a vote
  $(".up, .down").click(function () {
    submit_vote($(this).attr('class').split(' ')[0], $(this).attr('id').split(' ')[0], $(this));
  });
});

function submit_vote(vote_type, _id, current) {
  $.ajax({
    type: "POST",
    url: "ajax/vote",
    async: true,
    data: {
      '_id': _id,
      'vote_type': vote_type
    },
    success: function (response) {
      var remove = $(current).attr('class').split(' ')[1];
      var current_class = $(current).attr('class').split(' ')[0];
      switch (response) {
      case 'vote':
        if (current_class == 'down') {
          $(current).removeClass(remove).addClass("down_vote");
          $('.up4e0cbc71529e2d76290d0000')
          .siblings()
          .after('<p class="count">' + (parseInt($('.up4e0cbc71529e2d76290d0000').siblings().text()) - 1) + '</p>')
          .remove();
          $('.up4e0cbc71529e2d76290d0000').removeClass('up4e0cbc71529e2d76290d0000');
        } else {
          $(current).removeClass(remove).addClass("up_vote");
        }
        $(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) + 1) + '</p>').remove();
        break;
      case 'remove_vote':
        $(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) - 1) + '</p>').remove();
        $(current).removeClass(remove).addClass("no_vote");
        break;
      case 'login':
        alert('You need to login to vote.');
        break;
      default:
        // Do something when response != login, remove_vote, or vote.
      }
    }
  });
}
</script>

<style>
.down_vote{color:red;}
.up_vote{color:green;}
.no_vote{color:black;}
</style>

<?if($logged_in):?>
<div id="top_nav">
  <p style="float:right;">Welcome <a href="user/<?=$username?>"><?=$username?></a> | <a href="upload">Upload</a> | <a href="ajax/logout">Logout</a></p>
</div>
<?endif;?>

<!-- The loop to show all assets -->
<table>
	<?foreach ($documents as $document):?>
  <tr>
    <td>
      <?if($document['already_voted_up']):?>
      <a href="javascript:;" class="up up_vote up<?=$document['_id']?>" id="<?=$document['_id']?>">Up Vote</a>
      <p class="count"><?=$document['up_votes']?></p>
      <?else:?>
      <a href="javascript:;" class="up no_vote" id="<?=$document['_id']?>">Up Vote</a>
      <p class="count"><?=$document['up_votes']?></p>
      <?endif;?>
    </td>
    <td class="remove">
      <?if($document['already_voted_down']):?>
      <a href="javascript:;" class="down down_vote" id="<?=$document['_id']?>">Down Vote</a>
      <p class="count"><?=$document['down_votes']?></p>
      <?else:?>
      <a href="javascript:;" class="down no_vote" id="<?=$document['_id']?>">Down Vote</a>
      <p class="count"><?=$document['down_votes']?></p>
      <?endif;?>
    </td>
    <td>
      <a href="<?=base_url();?>asset/<?=$document['_id']?>">
        <img src="<?=base_url();?>main/image/<?=$document['_id']?>" width="150" height="150"/>
      </a>
    </td>
    <td>
      <p><a href="<?=base_url();?>main/image/<?=$document['_id']?>">View Image</a></p>
    </td>
    <td>
      <p><a href="<?=base_url();?>user/<?=$document['submitted_by']?>"><?=$document['submitted_by']?></a></p>
    </td>
    <td>
      <p><?=$document['tags'][0]?></p>
    </td>
  </tr>
  <?endforeach;?>
</table>
<!-- End loop -->