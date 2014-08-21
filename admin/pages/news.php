<?php
/*
 *  © BitcoinDice 


 
*/

if (!isset($included)) exit();

if (isset($_POST['new_new'])) {
  if (!empty($_POST['new_new'])) {
    mysql_query("INSERT INTO `news` (`content`) VALUES ('".prot($_POST['new_new'])."')");
    echo '<div class="zpravagreen"><b>Success:</b> New has been posted.</div>';
  }
  else echo '<div class="zpravared"><b>Error:</b> One of required fields stayed empty.</div>';
}  
?>
<h1>News</h1>
<div class="zprava">
<b>Add new:</b><br>
<form method="post" action="./?p=news">
<table><tr><td><textarea name="new_new" style="width: 480px; height: 70px;"></textarea></td><td><input style="padding: 10px;" type="submit" value="Post"></td></tr></table>
<small>
<b>[B]</b>...<b>[/B]</b> = bold font<br>
<b>[I]</b>...<b>[/I]</b> = italic font<br>
<b>[BR]</b> = new line
</small>
</form>
</div>
<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>ID</th>
    <th>Time</th>
    <th>Content</th>
    <th>Actions</th>
  </tr>
  <?php
  $qu=mysql_query("SELECT * FROM `news` ORDER BY `time` DESC");
  while ($row=mysql_fetch_array($qu)) {
    echo '<tr class="vypis_table_obsah" id="rowid_'.$row['id'].'">';
    echo '<td>'.$row['id'].'</td>';
    echo '<td><small>'.$row['time'].'</small></td>';
    echo '<td class="content'.$row['id'].' getwidth">'.$row['content'].'</td>';
    echo '<td><a href="#" onclick="javascript:removeNew('.$row['id'].');return false;" title="Delete"><img src="./imgs/cross.png" style="width: 16px;"></a>&nbsp;<a href="#" onclick="javascript:edit_new('.$row['id'].',$(\'td.content'.$row['id'].'\').html());return false;" title="Edit New" id="edit_karos"><img src="./imgs/edit.png" style="width: 16px;"></a></td>';
    echo '</tr>';
  }
  ?>
</table>
<script type="text/javascript">
  function removeNew(id) {
    if (confirm('Do you really want to delete this new?')) {
      $.ajax({
        'url': 'ajax/delete_new.php?_new='+id,
        'dataType': "json",
        'success': function(data) {
          $("tr#rowid_"+id).remove();
          message('success','New has been deleted.');
        }
      });
    }
  }
  function sendEdited(id,content) {
    $.ajax({
      'url': 'ajax/edit_new.php?_new='+id+'&con='+content,
      'dataType': "json",
      'success': function(data) {
        $("td.content"+id).html(content);
        message('success','New has been edited.');
      }
    }); 
  }
  function edit_new(id,content) {
    $("td.content"+id).html('<textarea style="width: '+($("td.getwidth").width()-3)+'px; height: 50px;" id="content'+id+'">'+content+'</textarea><br><button style="padding: 2px 30px;" onclick="javascript:sendEdited('+id+',$(\'textarea#content'+id+'\').val());">Edit</button>');
  }

</script>