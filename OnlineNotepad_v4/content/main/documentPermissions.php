<?php
global $db;
$users = $db->getUsersWithPermission($_GET['documentId']);
$userId = $session->getData('userId');
$documentOwnerId = $db->getOwnerId($_GET['documentId']);
if($userId != $documentOwnerId){
  echo "<h1>You are not allowed to acces this Content!</h1>";
  return;
}
 ?>
 <h2>Following Useres have Access:</h2>
 <table>
   <?php
    foreach ($users as $value) {
       ?>
      <tr>
        <?=$value[1]?>
        <form action="?action=aDenyAccess" method="post">
          <input type="hidden" name="personId" value="<?=$value[0]?>">
          <input type="hidden" name="documentId" value="<?=$_GET['documentId']?>">
          <input type="submit" name="" value="Deny access">
        </form>
        </br>
      </tr>
      <?php
    }
    ?>
 </table>
 <form action="?action=aGiveAccess" method="post">
   <input type="text" name="email" >
   <input type="hidden" name="documentId" value="<?=$_GET['documentId']?>">
   <input type="submit" name="" value="Add User">
 </form>
