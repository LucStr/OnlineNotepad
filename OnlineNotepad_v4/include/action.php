<?php
class Action {
	var $action;

	function action($action) { // CLASS CONSTRUCTOR (HANDLER)
		global $security;
		global $db;
		global $header;

		switch ($action) {
			case "aLogin":
				if($security->dataintegrity($_REQUEST)==1) {
					$this->login($_POST["theveryspecialemail"], $_POST["theveryspecialpassword"]);
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aLogOut":
				if($security->dataintegrity($_REQUEST)==1) {
					$this->logOut();
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aRegister":
				if($security->dataintegrity($_REQUEST)==1) {
					$this->register($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password']);
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aChangeDocumentContent":
			if($security->dataintegrity($_REQUEST)==1) {
				$db->updateContent($_POST["documentId"], $_POST["content"]);
			}  else { echo "XSS Attack"; exit; }
				break;
			case "aChangeDocumentName":
				if($security->dataintegrity($_REQUEST)==1) {
					$db->alterNameOfDocument($_POST["documentId"], $_POST["documentName"]);
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aGetContent":
				if($security->dataintegrity($_REQUEST)==1) {
					echo $db->getDocumentsById($_REQUEST["documentId"])[3];
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aCreateDocument":
				if($security->dataintegrity($_REQUEST)==1) {
					$this->createDocument();
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aDenyAccess":
				if($security->dataintegrity($_REQUEST)==1) {
					$this->denyAccess($_POST["documentId"], $_POST["personId"]);
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aGiveAccess":
				if($security->dataintegrity($_REQUEST)==1) {
					$this->giveAccess($_POST["documentId"], $_POST["email"]);
				}  else { echo "XSS Attack"; exit; }
				break;
			case "aDeleteDocument":
				if($security->dataintegrity($_REQUEST)==1) {
					$this->deleteDocument($_GET["documentId"]);
				}  else { echo "XSS Attack"; exit; }
				break;
		}
	}

	function register($lastname, $firstname, $email, $password){
		global $db;
		$db->addUser($firstname, $lastname, $email, $password);
	}

	function logOut() {
		global $session;
		global $header;
		$session->unsetData('userId');
		$session->unsetData('userEmail');
		$header->header('mLogin');
	}

	function login($email, $password) {
		//Globalize
		global $header;
		global $security;
		global $session;
		global $db;

		//logic
		if($security->plausibilitycheck($email,1)!=1) {
			$session->putData('emailmessage',0);
		} else {
			$session->putData('emailmessage',1);
		}

		if($security->plausibilitycheck_custom_password($password)==0) {
			$session->putData('passwordmessage',0);
		} else {
			$session->putData('passwordmessage',1);
		}

		//EVERYTHING OK??? ONE
		if($session->getData('emailmessage')==1 AND $session->getData('passwordmessage')==1) {
			$var="true";
		} else {
			$session->putData('loginattemptmessage',0);
			$header->header('mLogin');
		}

		$result = $db->checkCredentials($email, $password);

		//EVERYTHING OK STEP 2
		if(mysql_num_rows($result)==0) {
			//user not found
			$session->putData('loginattemptmessage',1);
			$header->header('mLogin');
		} else {
			//user found
			$session->unsetData('emailmessage');
			$session->unsetData('passwordmessage');
			$session->unsetData('loginattemptmessage');
			$result = $db->getUserId($email);
			$session->putData('userId', $result);
			$session->putData('userEmail', $email);
			$header->header('mLogin');
		}
	}

	function createDocument(){
		global $db;
		global $session;
		global $header;
		$title = $_REQUEST["title"];
		$db->createDocument($title, $session->getData('userId'));
		$documentId = mysql_insert_id();
		$count = 0;
		while (isset($_REQUEST["user_" . $count])) {
			$personemail = $_REQUEST["user_" . $count];
			$userId = $db->getUserId($personemail);
			if(isset($userId)){
				$db->giveAccess($userId, $documentId);
			}
			$count++;
		}
		$header->header('mDocuments');
	}

	function giveAccess($documentId, $email){
		global $db;
		global $header;
		$personId = $db->getUserId($email);
		if(isset($personId)){
			$db->giveAccess($personId, $documentId);
		}
		$header->header('mManagePermissions&documentId=' . $documentId);
	}

	function denyAccess($documentId, $userId)
	{
		global $db;
		global $header;
		$db->denyAccess($_POST["documentId"], $_POST["personId"]);
		$header->header('mManagePermissions&documentId=' . $documentId);
	}

	function deleteDocument($documentId){
		global $db;
		global $header;
		global $session;
		$documentOwnerId = $db->getOwnerId($documentId);
		if($documentOwnerId == $session->getData("userId")){
			$db->deleteDocument($documentId);
		}
		$header->header('mDocuments');
	}

}
$actionObj = new Action($_REQUEST['action']);
?>
