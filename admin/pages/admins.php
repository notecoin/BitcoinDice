<?php
/*
 *  © BitcoinDice 


 
*/

if (!isset($included)) exit();

if (isset($_POST['nwa_user']) && isset($_POST['nwa_pass'])) {
  if (!empty($_POST['nwa_user']) && !empty($_POST['nwa_pass'])) {
    mysql_query("INSERT INTO `admins` (`username`,`passwd`) VALUES ('".prot($_POST['nwa_user'])."','".md5($_POST['nwa_pass'])."')");
    echo '<div class="zpravagreen"><b>Success:</b> Admin was successfuly created!</div>';
  }
  else echo '<div class="zpravared"><b>Error:</b> One of required fields stayed empty!</div>';
}
?>

<script type="text/javascript">
  function edit_admin(a_id,a_a) {
    var a_alias=prompt('Alias:',a_a);
    if (a_alias==null) return false;
    var a_pass=prompt('Password:');
    if (a_pass==null) return false;
    if (a_alias!='' && a_pass!='' && a_alias!=null && a_pass!=null) {
      $.ajax({
        'url': 'ajax/edit_admin.php?admin='+a_id+'&unm='+a_alias+'&pass='+a_pass,
        'dataType': "json",
        'success': function(data) {
          $("tr#row"+a_id+" td.a__ali").html(a_alias);
          $("tr#row"+a_id+" a#edit_karos").attr('onclick',"javascript:edit_admin("+a_id+",'"+a_alias+"');return false;");
          message('success','Admin has been updated.');
        }
      });
    } else message('error',"One of fields has an incorrect value. Please, try again.");
  }
  function removeAdmin(id) {
    if (confirm('Do you really want to delete this admin?')) {
      $.ajax({
        'url': 'ajax/delete_admin.php?_admin='+id,
        'dataType': "json",
        'success': function(data) {
          $("tr#row"+id).remove();
          message('success','Admin has been deleted.');
        }
      });
    }
  }
</script>

<h1>Administrators</h1>
<div class="zprava">
<b>New admin:</b><br>
<form action="./?p=admins" method="post">
  Username: <input type="text" name="nwa_user"> Password: <input type="password" name="nwa_pass"> <input type="submit" value="Create">
</form>
</div>
<table class="vypis_table">
  <tr class="vypis_table_head">
    <th align="center">ID</th>
    <th align="center">Username</th>
    <th align="center">Two-factor auth.</th>
    <th align="center">Actions</th>
  </tr>
    <?php
    $qu=mysql_query("SELECT * FROM `admins`");
    while ($row=mysql_fetch_array($qu)) {
      $twf=($row['ga_token']=='')?'<span style="color: #d10000;">Off</span>':'<span style="color: green;">On</span>';
      echo '<tr class="vypis_table_obsah" id="row'.$row['id'].'">';
      echo '<td align="center">'.$row['id'].'</td>';
      echo '<td align="center" class="a__ali">'.$row['username'].'</td>';
      echo '<td align="center">'.$twf.'</td>';
      echo '<td align="center"><a href="#" onclick="javascript:removeAdmin('.$row['id'].');return false;" title="Delete Admin"><img src="./imgs/cross.png" style="width: 16px;"></a>&nbsp;<a href="#" onclick="javascript:edit_admin('.$row['id'].',\''.$row['username'].'\');return false;" title="Edit Admin" id="edit_karos"><img src="./imgs/edit.png" style="width: 16px;"></a></td>';
      echo '</tr>';
    }
    ?>
</table>
