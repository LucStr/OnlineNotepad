<?php
$session->putData('apples',1250);


$session->putData('LOGGEDIN',"false");

echo ">>" . $session->getData('apples') . "<br><br>";


echo "TEST IF LOGGED IN>>" . $session->getData('LOGGEDIN') . "<br><br>";


print_r($_SESSION);

?>
<br /><br />
<h2>HOME SITE</h2>
this is home0 site yes main