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
		break 1;
		case "mLogin":
			$title="Login";
			$content = PATH_CONTENT . "login.php";
		break 1;
		case "mRegister":
			$title="Register";
			$content = PATH_CONTENT . "register.php";
		break 1;
		case "mDocuments":
			$title="Documents";
			$content = PATH_CONTENT . "documentOverview.php";
		break 1;
		case "mDocumentDetails":
			$title="Document";
			$content = PATH_CONTENT . "documentDetails.php";
		break 1;
		case "mCreateDocument":
			$title="Document";
			$content = PATH_CONTENT . "documentCreate.php";
		break 1;
		case "mManagePermissions":
			$title="Document";
			$content = PATH_CONTENT . "documentPermissions.php";
		break 1;
		default:
			$title="Welcome !";
			$content = PATH_CONTENT . "registration.php";
		}
		$GLOBALS['title']=$title;
		$GLOBALS['content']=$content;
	}
}
$menuObj = new Menu($_GET['menu']);
?>
