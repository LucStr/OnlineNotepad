<?php
class Security {

		function plausibilitycheck($value,$check) {
			if($check==1) { //email
				if(filter_var($value, FILTER_VALIDATE_EMAIL)!=true) { return 0; } else { return 1; }
			}
			if($check==2) { //boolean
				if(filter_var($value, FILTER_VALIDATE_BOOLEAN)!=true) { return 0; } else { return 1; }
			}
			if($check==3) { //numeric
				if(filter_var($value, FILTER_VALIDATE_INT)!=true) { return 0; } else { return 1; }
			}
			if($check==4) { //url
				if(filter_var($value, FILTER_VALIDATE_URL)!=true) { return 0; } else { return 1; }
			}
			if($check==5) { //double
				if(filter_var($value, FILTER_VALIDATE_FLOAT)!=true) { return 0; } else { return 1; }
			}
		}

		function plausibilitycheck_custom_password($value) {
			/*
			Must be a minimum of 8 characters
			Must contain at least 1 number
			Must contain at least one uppercase character
			Must contain at least one lowercase character
			*/
			$uppercase = preg_match('@[A-Z]@', $value);
			$lowercase = preg_match('@[a-z]@', $value);
			$number    = preg_match('@[0-9]@', $value);
			if(!$uppercase || !$lowercase || !$number || strlen($value) < 8) {
				return 0;
			} else {
				return 1;
			}
		}

		function dataintegrity($data) {

	    	$datakey=array_values($data);
			// alert("Hello! I am an alert box!!");
			$datacount=count($datakey);
			$count=0;
			while($count<=$datacount-1) {
				if($datakey[$count]!="") {
				if(!preg_match('/^[\pL\pN\pZ\p{Pc}\p{Pd}\p{Po}]++$/uD', $datakey[$count])) { return 0; } 	}
				$count++;
			}
			return 1;
		}
}
$security = new Security;
?>
