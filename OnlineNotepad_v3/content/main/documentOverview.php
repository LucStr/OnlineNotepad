<h2>Ihre Dokumente</h2>

<?php
global $db;
global $session;
$loggedInUser = $session->getData('userId');
if(is_numeric($loggedInUser)){
  echo '<a style="display:block" href="?menu=mCreateDocument">Create new Document</a>';
  $documents = $db->getDocumentsFromPerson($loggedInUser);
  foreach ($documents as $value) {
    echo "<a href='?menu=mDocumentDetails&documentId=$value[0]'>$value[1]</a></br>";
  }
} else{
  echo "You need to Login to see this Content.";
}
?>
