<script>
$(document).ready(function () {
  // Make a vote
  $(".up, .down").click(function () {
    var vote_type = $(this).attr('class');
    var _id = $(this).attr('id');
    submitVote(vote_type, _id);
  });

  function submitVote(vote_type, _id) {
    $.ajax({
      type: "POST",
      url: "index.php/ajax/vote",
      async: true,
      data: {
        '_id': _id,
        'vote_type': vote_type
      },
      success: function (msg) {
        if (msg == 'You must be logged in to vote') {
          alert(msg);
        }
      }
    });
  }
});
</script>

<?if($logged_in):?>
<div id="top_nav">
  <p>Welcome <?=$username;?></p>
  <a href="<?=base_url();?>main/logout">Logout</a>
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
      <img src="<?=base_url();?>main/image/<?=$document['_id']?>" width="150" height="150"/>
    </td>
    <td>
      <p><a href="<?=base_url();?>main/image/<?=$document['_id']?>">View Image</a></p>
    </td>
    <td>
      <p><a href="<?=base_url();?>user/<?=$document['submitted_by']?>"><?=$document['submitted_by']?></a></p>
    </td>
    <td>
      <p></p>
    </td>
  </tr>
  <?endforeach;?>
</table>
<!-- End loop -->
