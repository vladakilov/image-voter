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
        //alert( "Data Saved: " + msg );
      }
    });
  }
});
</script>


<a href="index.php/main/logout">Logout</a>
<!-- The loop to show all assets -->
<?=$this->session->userdata('logged_in');?>
<table>
	<?foreach ($documents as $document):?>
  <tr>
    <td><a href="#" class="up" id="<?=$document['_id']?>">Up Vote</a><p class="count"></p></td>
    <td><a href="#" class="down" id="<?=$document['_id']?>">Down Vote</a><p class="count"></p></td>
    <td><img src="index.php/main/image/<?=$document['_id']?>"/></td>
    <td><p><a href="index.php/main/image/<?=$document['_id']?>">View Image</a></p></td>
    <td><p><a href="user/"></a></p></td>
    <td><p></p></td>
  </tr>
  <?endforeach;?>
</table>
<!-- End loop -->
