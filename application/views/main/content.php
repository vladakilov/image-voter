<a href="index.php/main/logout">Logout</a>
<!-- The loop to show all assets -->
<?=$this->session->userdata('logged_in');?>
<table>
	<?foreach ($documents as $document):?>
  <tr>
    <td><a href="#" class="up" id="<?=$document['_id']?>">Up Vote</a><p class="count"></p></td>
    <td><a href="#" class="down" id="<?=$document['_id']?>">Down Vote</a><p class="count"></p></td>
    <td><img src="index.php/main/image/<?=$document['md5']?>"/></td>
    <td><p><a href="index.php/main/image/<?=$document['md5']?>">View Image</a></p></td>
    <td><p><a href="user/"></a></p></td>
    <td><p></p></td>
  </tr>
  <?endforeach;?>
</table>
<!-- End loop -->
