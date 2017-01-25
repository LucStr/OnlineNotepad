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

		function getOwnDocuments($personid){
			return $this->easySelect("SELECT document.ID, document.Name, document.Content FROM document WHERE document.OwnerId = $personid");
		}

		function getDocumentsById($documentid){
			$result = $this->easySelect("SELECT ID, OwnerId, Name, Content FROM document WHERE ID = $documentid");
			return $result[0];
		}

		function getUserId($email){
			$query = "SELECT ID FROM person WHERE email='$email'";
			return $this->easySelect($query)[0][0];
		}

		function getOwnerId($documentId){
			$query = "SELECT document.OwnerId FROM document WHERE ID=$documentId";
			return $this->easySelect($query)[0][0];
		}

		function deleteDocument($documentId){
			$query = "DELETE FROM document WHERE document.ID = $documentId";
			$this->easyQuery($query);
			$query = "DELETE FROM person_document WHERE person_document.DocumentId = $documentId";
			$this->easyQuery($query);
		}

		function addUser($firstname, $lastname, $email, $password){
			$encryptet_pw = md5($password);
			$query = "INSERT INTO person VALUES(NULL, '$firstname', ''$LastName', '$email', ''$encryptet_pw')";
			return $this->easyQuery($query);
		}

		function updateContent($documentId, $content){
			$query = "UPDATE document SET document.Content = '$content' WHERE document.ID = $documentId";
			$result =	$this->easyQuery($query);
			return $result;
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

		function giveAccess($personId, $documentId){
			$query = "INSERT INTO person_document VALUES(NULL, '$personId', '$documentId')";
			return $this->easyQuery($query);
		}

		function getUsersWithPermission($documentId){
			$query = "SELECT person.ID, person.Email FROM person_document LEFT JOIN person ON person_document.PersonId = person.ID WHERE person_document.DocumentID = $documentId";
			return $this->easySelect($query);
		}

		function denyAccess($documentId, $personId){
			$query = "DELETE FROM person_document WHERE person_document.PersonId = $personId AND person_document.DocumentID = $documentId";
			return $this->easyQuery($query);
		}
}
$db = new Database;
?>
