<?php
class Menu {
	var $menu;

	function menu($menu) {
		if($menu!="" and !is_numeric($menu) and substr($menu, 0, 1)=="m") {
			$this->buildNavigation($menu);
		} else {
			$this->buildNavigation('mHome');
		}
	}

	public function buildNavigation($menu) {
		switch ($menu) {
		case "mHome":
			$title="Welcome This is my Website";
			$content = PATH_CONTENT . "home.php";
			$leftbox = PATH_LEFTBOX . "home.php";
			$rightbox = PATH_RIGHTBOX . "home.php";
			$footer = PATH_FOOTER . "footer1.php";
		break 1;
		case "mLogin":
			$title="Login";
			$content = PATH_CONTENT . "login.php";
			$leftbox = PATH_LEFTBOX . "login.php";
			$rightbox = PATH_RIGHTBOX . "login.php";
			$footer = PATH_FOOTER . "footer1.php";
		break 1;
		case "mRegister":
			$title="Register";
			$content = PATH_CONTENT . "register.php";
			$leftbox = PATH_LEFTBOX . "register.php";
			$rightbox = PATH_RIGHTBOX . "register.php";
			$footer = PATH_FOOTER . "footer1.php";
		break 1;
		case "mDocuments":
			$title="Documents";
			$content = PATH_CONTENT . "documentOverview.php";
			$leftbox = PATH_LEFTBOX . "documentOverview.php";
			$rightbox = PATH_RIGHTBOX . "documentOverview.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		case "mDocumentDetails":
			$title="Document";
			$content = PATH_CONTENT . "documentDetails.php";
			$leftbox = PATH_LEFTBOX . "documentDetails.php";
			$rightbox = PATH_RIGHTBOX . "documentDetails.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		case "mCreateDocument":
			$title="Document";
			$content = PATH_CONTENT . "documentCreate.php";
			$leftbox = PATH_LEFTBOX . "documentDetails.php";
			$rightbox = PATH_RIGHTBOX . "documentDetails.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		case "mManagePermissions":
			$title="Document";
			$content = PATH_CONTENT . "documentPermissions.php";
			$leftbox = PATH_LEFTBOX . "documentDetails.php";
			$rightbox = PATH_RIGHTBOX . "documentDetails.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		default:
			$title="Welcome !";
			$content = PATH_CONTENT . "registration.php";
			$leftbox = PATH_LEFTBOX . "registration.php";
			$rightbox = PATH_RIGHTBOX . "registration.php";
			$footer = PATH_FOOTER . "footer1.php";
		}
		$GLOBALS['title']=$title;
		$GLOBALS['content']=$content;
		$GLOBALS['leftbox']=$leftbox;
		$GLOBALS['rightbox']=$rightbox;
		$GLOBALS['footer']=$footer;
	}
}
$menuObj = new Menu($_GET['menu']);
?>
