<h2>Ihre Dokumente</h2>

<?php
global $db;
global $session;
$userId = $session->getData('userId');
if(is_numeric($userId)){
  echo '<a style="display:block" href="?menu=mCreateDocument">Create new Document</a>';
  echo '<h2>Your documents</h1>';
  $documents = $db->getOwnDocuments($userId);
  foreach ($documents as $value) {
    echo "<a href='?menu=mDocumentDetails&documentId=$value[0]'>$value[1]</a></br>";
  }
  echo '<h2>Shared with you</h1>';
  $documents = $db->getDocumentsFromPerson($userId);
  foreach ($documents as $value) {
    echo "<a href='?menu=mDocumentDetails&documentId=$value[0]'>$value[1]</a></br>";
  }
} else{
  echo "You need to Login to see this Content.";
}
?>
