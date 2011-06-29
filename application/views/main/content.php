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
      if (response == 'You must be logged in to vote') {
        alert(response);
      } else {
        $(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) + 1) + '</p>').remove();
      }
    }
  });
}
</script>

<?if($logged_in):?>
<div id="top_nav">
  <p>Welcome <?=$username;?></p>
  <a href="ajax/logout">Logout</a>
</div>
<?endif;?>

<!-- The loop to show all assets -->
<table>
	<?foreach ($documents as $document):?>
  <tr>
    <td>
      <a href="javascript:;" class="up" id="<?=$document['_id']?>">Up Vote</a>
      <p class="count"><?=$document['up_votes']?></p>
    </td>
    <td>
      <a href="javascript:;" class="down" id="<?=$document['_id']?>">Down Vote</a>
      <p class="count"><?=$document['down_votes']?></p>
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
