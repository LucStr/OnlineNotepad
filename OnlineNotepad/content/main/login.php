<?php
$emailcheck = $session->getData('emailmessage');
$pwcheck = $session->getData('passwordmessage');
$loginversuch = $session->getData('loginattemptmessage');
$loggedstatus=$session->getData('LOGGEDIN');

$session->unsetData('emailmessage');
$session->unsetData('passwordmessage');
$session->unsetData('loginattemptmessage');
?>


<?php
if($loggedstatus=="false") {
?>
<h1>Login</h1>
<?php if($loginversuch==1 and is_numeric($loginversuch)) { echo "<b>Keine Übereinstimmung</b> !! Benutzername und oder PW nicht gefunden <br>"; } ?>
<!-- Action variable -->
 <form name="Login" enctype="multipart/form-data" action="?action=aLogin" method="post">
	E-Mail: <input name="email" type="text" value=""> <br />
	<?php if($emailcheck==0 and is_numeric($emailcheck)) { echo "<b>E-Mail Adresse falsch</b> !!<br>"; } ?>
    Password: <input name="password" type="password" value=""><br />
    <?php if($pwcheck==0 and is_numeric($pwcheck)) { echo "<b>Das Passwort muss mindestens acht Zeichen lang sein und mindestens ein Zeichen, sowie Gross- und Kleinschreibung enthalten.</b> !!<br>"; } ?>
	<input name="submit" type="submit" value="Login"  />
</form><br />
<?php  } else { echo "<br><h3>Sie sind bereits erfolgreich eingeloggt ! </h3>"; }  ?>
