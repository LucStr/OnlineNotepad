<?php
class Action {
	var $action;

	function action($action) { // CLASS CONSTRUCTOR (HANDLER)
		global $security;
		global $db;

		//ACTION REQUEST
		if($action=="aLogin") {
			if($security->dataintegrity($_REQUEST)==1) {
				$this->login($_POST["theveryspecialemail"], $_POST["theveryspecialpassword"]);
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aLogOut") {
			if($security->dataintegrity($_REQUEST)==1) {
			$this->logOut();
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aRegister"){
			if($security->dataintegrity($_REQUEST)==1) {
			$this->register($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password']);
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aChangeDocumentContent"){
			if($security->dataintegrity($_REQUEST)==1) {
			$db->updateContent($_POST["documentId"], $_POST["content"]);
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aChangeDocumentName"){
			if($security->dataintegrity($_REQUEST)==1) {
			$db->alterNameOfDocument($_POST["documentId"], $_POST["documentName"]);
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aGetContent"){
			if($security->dataintegrity($_REQUEST)==1) {
			echo $db->getDocumentsById($_REQUEST["documentId"])[0][3];
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aCreateDocument"){
			if($security->dataintegrity($_REQUEST)==1) {
			echo $this->createDocument();
			}  else { echo "XSS Attack"; exit; }
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
			$session->putData('userId', $result[0][0]);
			$header->header('mLogin');
		}
	}

	function createDocument(){
		global $db;
		global $session;
		$title = $_REQUEST["title"];
		$db->createDocument($title, $session->getData('userId'));
		$documentId = mysql_insert_id();
		$count = 0;
		while (isset($_REQUEST["user_" . $count])) {
			$personemail = $_REQUEST["user_" . $count];
			$userId = $db->getUserId($personemail)[0][0];
			if(is_numeric($userId)){
				$db->givePermission($userId, $documentId);
			}
			$count++;
		}
	}

}
$actionObj = new Action($_REQUEST['action']);
?>
