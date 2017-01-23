<?php


class Session {
	   function __construct(){
			$this->start();
		}

		function start() {
			session_start();
			//session_name ("myWebID");
			session_regenerate_id();
		}

		function putData($ident,$wert) {
			$_SESSION['public'][$ident] = $wert;
		}

		function getData($ident) {

			//debug this
			$resultat=$_SESSION['public'][$ident];
			return $resultat;
		}

		function unsetData($ident) {
			unset($_SESSION['public'][$ident]);
		}

		function unsetAll() {
			unset($_SESSION['public']);
		}
}
$session = new Session;
?>
