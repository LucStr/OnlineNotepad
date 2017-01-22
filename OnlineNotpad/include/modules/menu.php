<?php
class Menu {
	var $menu;

	function Menu($menu) {
		if($menu!="" and !is_numeric($menu) and substr($menu, 0, 1)=="m") {
			$this->BuildNavigation($menu);
		} else {
			$this->BuildNavigation('mHome');
		}
	}

	public function BuildNavigation($menu) {

		switch ($menu) {
		case "mHome":
			$title="Welcome This is my Website";
			$content = PATH_CONTENT . "home.php";
			$leftbox = PATH_LEFTBOX . "home.php";
			$rightbox = PATH_RIGHTBOX . "home.php";
			$footer = PATH_FOOTER . "footer1.php";
		break 1;
		case "mAboutUs":
			$title="About me and my Project";
			$content = PATH_CONTENT . "aboutus.php";
			$leftbox = PATH_LEFTBOX . "aboutus.php";
			$rightbox = PATH_RIGHTBOX . "aboutus.php";
			$footer = PATH_FOOTER . "footer1.php";
		break 1;
		case "mSiteOne":
			$title="This is the site one title";
			$content = PATH_CONTENT . "siteone.php";
			$leftbox = PATH_LEFTBOX . "siteone.php";
			$rightbox = PATH_RIGHTBOX . "siteone.php";
			$footer = PATH_FOOTER . "footer1.php";
		break 1;
		case "mSiteTwo":
			$title="Site two ist good";
			$content = PATH_CONTENT . "sitetwo.php";
			$leftbox = PATH_LEFTBOX . "sitetwo.php";
			$rightbox = PATH_RIGHTBOX . "sitetwo.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		case "mSiteThree":
			$title="Site Three";
			$content = PATH_CONTENT . "sitethree.php";
			$leftbox = PATH_LEFTBOX . "sitethree.php";
			$rightbox = PATH_RIGHTBOX . "sitethree.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		case "mSiteFour":
			$title="Title Site Four";
			$content = PATH_CONTENT . "sitefour.php";
			$leftbox = PATH_LEFTBOX . "sitefour.php";
			$rightbox = PATH_RIGHTBOX . "sitefour.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		case "mImpressum":
			$title="Impressum";
			$content = PATH_CONTENT . "impressum.php";
			$leftbox = PATH_LEFTBOX . "impressum.php";
			$rightbox = PATH_RIGHTBOX . "impressum.php";
			$footer = PATH_FOOTER . "footer2.php";
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
			$leftbox = PATH_LEFTBOX . "documentOverview.php";
			$rightbox = PATH_RIGHTBOX . "documentOverview.php";
			$footer = PATH_FOOTER . "footer2.php";
		break 1;
		default:
			$title="Welcome !";
			$content = PATH_CONTENT . "home.php";
			$leftbox = PATH_LEFTBOX . "home.php";
			$rightbox = PATH_RIGHTBOX . "home.php";
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
