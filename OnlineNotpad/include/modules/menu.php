<?php
$menu   = $_GET['menu'];
//echo ">>>>" . $menu;






switch ($menu) {
	
	case "mHome":
		$title="Welcome This is my Website";
		$content = PATH_CONTENT . "home.php";
	break 1; 
	
	case "mAboutUs":
		$title="About me and my Project";
		$content = PATH_CONTENT . "aboutus.php";
	break 1; 
	
	default:
		$title="Welcome !";
		$content = PATH_CONTENT . "home.php";
	
}



?>