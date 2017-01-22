<?php

  $firstname = "Luca";//$session->getData('firstname');
  $lastname = "Strebel"; //$session->getData('lastname');
?>
<h2>Ihre Dokumente</h2>
<?php
global $db;
global $session;
$loggedInUser = $session->getData('UserId');
$documents = $db->getDocumentsFromPerson($loggedInUser);
foreach ($documents as $value) {
  echo "<a href='?documentId=$value[0]'>$value[1]</a></br>";
}
?>
