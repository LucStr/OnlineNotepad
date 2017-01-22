<?php
class Action {
	var $action;

	function Action($action) { // CLASS CONSTRUCTOR (HANDLER)
		global $security;

		//ACTION REQUEST
		if($action=="aLogin") {
			if($security->dataintegrity($_REQUEST)==1) {
			$this->Login($_POST['email'],$_POST['password']);
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aLogOut") {
			if($security->dataintegrity($_REQUEST)==1) {
			$this->LogOut();
			}  else { echo "XSS Attack"; exit; }
		}

		if($action=="aRegister"){
			if($security->dataintegrity($_REQUEST)==1) {
			$this->Register($_POST["email"], $_POST["password"]);
			}  else { echo "XSS Attack"; exit; }
		}




	}

	function Register($email, $password){
		$password = md5($password);
		echo "bini dinne!";
		$db->singlequery_dynamic("INSERT INTO logindata VALUES($email, $password)");
	}

	function LogOut() {
		global $session;
		global $header;
		$session->PutData('LOGGEDIN',"false");
		$header->Header('mSiteOne');
	}

	function Login($email,$password) {
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

		$encryptet_pw = md5($password);

		//print_r($_SESSION);
		$iffound = $db->singlequery_dynamic("SELECT ID from logindata WHERE email='$email' AND password='$encryptet_pw'");

		//EVERYTHING OK STEP 2
		if($iffound=="false") {
			//user not found
			$session->PutData('loginattemptmessage',1);
			$session->PutData('LOGGEDIN',"false");
			$header->Header('mSiteOne');
		} else {
			//user found
			$session->PutData('LOGGEDIN',"true"); //PASSPORT
			$session->unsetData('emailmessage');
			$session->unsetData('passwordmessage');
			$session->unsetData('loginattemptmessage');
			$header->Header('mSiteOne');
		}

	}



}
$actionObj = new Action($_REQUEST['action']);









?>
