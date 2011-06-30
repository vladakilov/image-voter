<script>
$(document).ready(function () {
  // Make a vote
  $(".up, .down").click(function () {
    submit_vote($(this).attr('class'), $(this).attr('id'), $(this));
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
      switch (response) {
      case 'vote':
        if ($(current).attr('class') == 'down') {
          $(current).css("color", "red");
        } else {
          $(current).css("color", "green");
        }
        $(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) + 1) + '</p>').remove();
        break;
      case 'remove_vote':
        $(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) - 1) + '</p>').remove();
        $(current).css("color", "black");
        break;
      case 'login':
        alert('You need to login to vote.');
        break;
      default:
        //$(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) + 1) + '</p>').remove();
        //$(current).remove();
        //$(current).addClass(".already_voted");
      }
    }
  });
}
</script>

<style>
.already_voted{color: #333;}

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
      <a href="javascript:;" class="up" id="<?=$document['_id']?>" style="color:green">Up Vote</a>
      <p class="count"><?=$document['up_votes']?></p>
      <?else:?>
      <a href="javascript:;" class="up" id="<?=$document['_id']?>" style="color:black">Up Vote</a>
      <p class="count"><?=$document['up_votes']?></p>
      <?endif;?>
    </td>
    <td>
      <?if($document['already_voted_down']):?>
      <a href="javascript:;" class="down" id="<?=$document['_id']?>" style="color:red">Down Vote</a>
      <p class="count"><?=$document['down_votes']?></p>
      <?else:?>
      <a href="javascript:;" class="down" id="<?=$document['_id']?>" style="color:black">Down Vote</a>
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
