<?php 
class myHeader {
	
	function Header($menu) {
		$this->host= $_SERVER['HTTP_HOST'];
		$this->uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$this->host$this->uri/index.php?menu=$menu");
		exit;
	}
	
}
$header = new myHeader();
?>