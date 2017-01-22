<?php

  $firstname = "Luca";//$session->getData('firstname');
  $lastname = "Strebel"; //$session->getData('lastname');
 ?>
<h2> Hallo <?=$firstname . " " . $lastname?></h2>
<?php
global $db;
$documents = $db->getDocumentsFromPerson(1);
echo $documents[0][0];
//foreach ($documents as $value) {
//  echo "Name :" . $value . "Content: " . $value;
//}
?>
<?=$documents?>
<!-- Hello -->
