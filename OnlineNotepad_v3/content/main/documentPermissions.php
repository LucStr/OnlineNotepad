<?php
  global $db;
  $users = $db->getUsersWithPermission($_GET['documentId'])
 ?>
 <h2>Following Useres have Access:</h2>
 <table>
   <?php
    foreach ($users as $value) {
       ?>
      <tr>
        <?=$value[1]?>
        <a href="#" onclick="deleteUser(<?=$value[0]?>)"></a>
      </tr>
      <?php
    }
    ?>
 </table>
