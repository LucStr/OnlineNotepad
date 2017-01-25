<?php
class Session {
	   function __construct(){
			$this->start();
		}

		function start() {
			session_start();
			session_regenerate_id();
		}

		function putData($ident,$wert) {
			print_r("key: " . $ident . "value: " . $wert);
			$_SESSION['public'][$ident] = $wert;
		}

		function getData($ident) {
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
