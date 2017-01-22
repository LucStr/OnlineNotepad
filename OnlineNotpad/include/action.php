<?php
class Action {
	var $action;

	function Action($action) { // CLASS CONSTRUCTOR (HANDLER)
		global $security;

		//ACTION REQUEST
		if($action=="aLogin") {
			if($security->dataintegrity($_REQUEST)==1) {
				$this->Login($_POST["email"], $_POST["password"]);
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aLogOut") {
			if($security->dataintegrity($_REQUEST)==1) {
			$this->LogOut();
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aRegister"){
			if($security->dataintegrity($_REQUEST)==1) {
			$this->Register($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password']);
			}  else { echo "XSS Attack"; exit; }
		}
		if($action=="aChangeDocumentContent"){
			if($security->dataintegrity($_REQUEST)==1) {
			$db->UpdateContent($_POST["documentId"], $_POST["content"]);
			}  else { echo "XSS Attack"; exit; }
		}
		if($action=="aChangeDocumentName"){
			if($security->dataintegrity($_REQUEST)==1) {
			$db->AlterNameOfDocument($_POST["documentId"], $_POST["documentName"]);
			}  else { echo "XSS Attack"; exit; }
		}
	}


	function Register($lastname, $firstname, $email, $password){
		global $db;
		$db->AddUser($firstname, $lastname, $email, $password);
	}

	function LogOut() {
		global $session;
		global $header;
		$session->PutData('LOGGEDIN',"false");
		$session->unsetData('UserId');
		$header->Header('mSiteOne');
	}

	function Login($email, $password) {
		echo "Inside Login";
		//Globalize
		global $header;
		global $security;
		global $session;
		global $db;


		//logic
		if($security->plausibilitycheck($email,1)!=1) {
			$session->PutData('emailmessage',0);
		} else {
			$session->PutData('emailmessage',1);
		}

		if($security->plausibilitycheck_custom_password($password)==0) {
			$session->PutData('passwordmessage',0);
		} else {
			$session->PutData('passwordmessage',1);
		}

		//EVERYTHING OK??? ONE
		if($session->getData('emailmessage')==1 AND $session->getData('passwordmessage')==1) {
			$var="true";
		} else {
			$session->PutData('loginattemptmessage',0);
			$header->Header('mSiteOne');
		}

		$iffound = $db->CheckCredentials($email, $password);

		//EVERYTHING OK STEP 2
		if($iffound=="false") {
			//user not found
			$session->PutData('loginattemptmessage',1);
			$session->PutData('LOGGEDIN',"false");
			$header->Header('mSiteOne');
		} else {
			//user found
			echo "User Found";
			$session->PutData('LOGGEDIN',"true"); //PASSPORT
			$session->unsetData('emailmessage');
			$session->unsetData('passwordmessage');
			$session->unsetData('loginattemptmessage');
			$result = $db->GetUserId($email);
			$session->PutData('UserId', $result[0][0]);
			$header->Header('mSiteOne');
		}

	}



}
$actionObj = new Action($_REQUEST['action']);









?>
