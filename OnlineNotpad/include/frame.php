

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<!-- Meta Key -->
<!-- Meta Key Ende -->

<!-- CSS -->
<link href="css/frame.css" rel="stylesheet" type="text/css">
<!-- CSS Ende-->
<title><?php echo $GLOBALS['title']; ?></title>
</head>

<body>
	<div id="header">
    	HEADER<br />
        <?php if($session->getData('LOGGEDIN')=="true") { ?>
			Guten Tag, Sie sind eingeloggt. <a href="?action=aLogOut">[AUSLOGGEN]</a><br /><br />
			
		<?php } ?>
    </div>
	<div id="navigation">
    <?php include (PATH_INC . "navigation.php"); ?>
    </div>
    <div id="middle">
        <div class="leftbox">
            <?php  include $GLOBALS['leftbox']; ?>
        </div>
        <div class="maincontent">
        <?php  include $GLOBALS['content']; ?>
        </div>
        <div class="rigthbox">
        <?php  include $GLOBALS['rightbox']; ?>
        </div>
    </div>
    <div id="footer">
     	<?php  include $GLOBALS['footer']; ?>
    </div>
</body>
</html>