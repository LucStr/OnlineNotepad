<?php
class Database {

		function easyConnect(){
			mysql_connect(DB_SERVER, DB_USER, DB_PASS) or
				die("Could not connect: " . mysql_error());
			mysql_select_db(DB_NAME);
		}

		function easySelect($query){
			$this->easyConnect();
			if(!($result = mysql_query($query))){
					echo "Error: " . $query . "<br>" . mysql_error();
			}
			$all_arr = array();
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$all_arr[] = $row;
			}
			mysql_free_result($result);
			return $all_arr;
		}

		function easyQuery($query){
			$this->easyConnect();
			if(!($result = mysql_query($query))){
					print_r("Error: " . $query . "<br>" . mysql_error());
			}
			return $result;
		}

		function getDocumentsFromPerson($personid){
			return $this->easySelect("SELECT document.ID, document.Name, document.Content FROM person LEFT JOIN person_document ON person_document.PersonId = person.ID LEFT JOIN document ON person_document.DocumentID = document.ID WHERE person.ID = $personid");
		}

		function getDocumentsById($documentid){
			return $this->easySelect("SELECT ID, OwnerId, Name, Content FROM document WHERE ID = $documentid");
		}

		function getUserId($email){
			$query = "SELECT ID FROM person WHERE email='$email'";
			$result = $this->easySelect($query);
			return $result;
		}

		function getOwnerId($documentId){
			$query = "SELECT document.OwnerId FROM document WHERE ID='$documentId'";
			$result = $this->easySelect($query);
		}

		function addUser($firstname, $lastname, $email, $password){
			$encryptet_pw = md5($password);
			$query = "INSERT INTO person VALUES(NULL, '$firstname', ''$LastName', '$email', ''$encryptet_pw')";
			return $this->easyQuery($query);
		}

		function updateContent($documentId, $content){
			$query = "UPDATE document SET document.Content = '$content' WHERE document.ID = $documentId";
			return $this->easyQuery($query);
		}

		function checkCredentials($email, $password){
			$encryptet_pw = md5($password);
			$query = "SELECT ID FROM person WHERE email='$email' AND password='$encryptet_pw'";
			return $this->easyQuery($query);
		}

		function createDocument($name, $owner){
			$query = "INSERT INTO document VALUES(NULL, $owner,'$name', '')";
			return $this->easyQuery($query);
		}

		function alterNameOfDocument($id, $newName){
			$query = "UPDATE document SET document.Name = '$newName' WHERE document.ID = $id";
			return $this->easyQuery($query);
		}

		function checkPermissions($personId, $documentId){
			$query = "SELECT ID FROM person_document WHERE personId='$personId' AND documentId='$documentId'";
			return $this->easyQuery($query);
		}

		function givePermission($personId, $documentId){
			$query = "INSERT INTO person_document VALUES(NULL, '$personId', '$documentId')";
			return $this->easyQuery($query);
		}
}
$db = new Database;
?>
