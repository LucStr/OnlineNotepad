<?php
class Database {

		function opendb() {
			$this->condb = $db = @new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			$db->set_charset("utf8");
		}

		function simpleSelectQueryCall($sql){
			$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			$sql = mysql_query($sql);
			$table = array();
			while ($row = mysql_fetch_assoc($sql))
		    $table[] = $row;
			return $table;
		}

		function multiquery_dynamic_select($sql) {
			$this->opendb();
			if ($this->condb->multi_query($sql)) {
				$querynumber=0; $numcount=0;
				do {
					$stmt = $this->condb->store_result();

					$numrows = $stmt->num_rows-1;
						while ($row = $stmt->fetch_array(MYSQLI_NUM)) {
							$fields = $stmt->field_count;
							$count=0;
							while($count<=$fields-1) {
								$all_arr[$querynumber][$numcount][]=$row[$count];
								$count++;
							}
							while($numcount<=$numrows) {
								$numcount++;
							}
						}
					$stmt->free();
					if ($this->condb->more_results()) {
						$querynumber++;
					}
				} while($this->condb->next_result());
			}
			$stmt->close();
			return $all_arr;
		}

		function multiquery_dynamic_sqlcommand($sql) {
			$this->opendb();
			$affcounter=1;
			if ($this->condb->multi_query($sql)) {
				do {
					$affected=$affcounter;
					$affcounter++;
				} while($this->condb->next_result());
			}
			return $affected;
		}

		function singlequery_dynamic($sql) {
			$this->opendb();
			$stmt =$this->condb->query($sql);
			$conditions['con'][0] = $stmt->field_count;
			while ($all = $stmt->fetch_array(MYSQLI_NUM)){
				$all_arr[]=$all;
    		}
			$stmt->close();
			if(!isset($all_arr)) {
				return "false";
			}
			return array($all_arr,$conditions);
		}

		function prepared_dynamic_select($sql,$exenumber=1) {
			$this->opendb();
			$stmt = $this->condb->prepare($sql);
			$fields = $stmt->field_count;
			$count=0;
			while($count<=$fields-1) {
        		$fieldss[$count]=&$$count;
				$count++;
    		}
			call_user_func_array(array($stmt,'bind_result'),$fieldss);
			$exec=1;
			while($exec<=$exenumber) {
				$stmt->execute();
				while ($stmt->fetch()) {
					$all_arr[]=$fieldss;
				}
			$exec++;
			}
 			return $all_arr;
 			$stmt->close();
		}

		function prepared_dynamic_sqlcommands($sql,$exenumber=1) {
			$this->opendb();
			$stmt = $this->condb->prepare($sql);
			$exec=1;
			while($exec<=$exenumber) {
				$stmt->execute();
				$exec++;
			}
			return $exenumber;
		}

		function easyConnect(){
			mysql_connect(DB_SERVER, DB_USER, DB_PASS) or
				die("Could not connect: " . mysql_error());
			mysql_select_db(DB_NAME);
		}

		function easySelect($query){
			$this->easyConnect();
			$result = mysql_query($query);
			$all_arr = array();
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$all_arr[] = $row;
			}
			mysql_free_result($result);
			return $all_arr;
		}

		function easyQuery($query){
			$this->easyConnect();
			if(mysql_query($sql)){
				return 1;
			}else{
				echo "Error: " . $sql . "<br>" . mysql_error();
				return 0;
			}
		}

		function getDocumentsFromPerson($personid){
			return $this->easySelect("SELECT document.Name, document.Content FROM person LEFT JOIN person_document ON person_document.PersonId = person.ID LEFT JOIN document ON person_document.DocumentID = document.ID WHERE person.ID = $personid");
		}

		function GetUserId($email){
			$query = "SELECT ID FROM person WHERE email='$email'";
			$result = $this->easySelect($query);
			return $result;
		}

		function AddUser($firstname, $lastname, $email, $password){
			$encryptet_pw = md5($password);
			$query = "INSERT INTO person VALUES(NULL, '$firstname', ''$LastName', '$email', ''$encryptet_pw')";
			return $this->easyQuery($query);
		}

		function UpdateContent($documentId, $content){
			$query = "UPDATE document SET document.Content = '$content' WHERE document.ID = $documentId";
			return $this->easyQuery($query);
		}

		function CheckCredentials($email, $password){
			$encryptet_pw = md5($password);
			$query = "SELECT ID FROM person WHERE email='$email' AND password='$encryptet_pw'";
			return $this->easyQuery($query);
		}

		function CreateDocument($name){
			$query = "INSERT INTO document VALUES(NULL, '$name', '')";
			return $this->easyQuery($query);
		}

		function AlterNameOfDocument($id, $newName){
			$query = "UPDATE document SET document.Name = '$newName' WHERE document.ID = $id";
			return $this->easyQuery($query);
		}

		////////////////////////////////////////////////////////////////////////////////
		// static functions

		function getid_detail($condition) {
			//its a static prepared and encryptet sql SELECT
			$sql="SELECT id from detail where id=$condition";
		}

			function put_detail($condition) {
			//its a static prepared and encryptet sql INSERT
			$sql="SELECT id from detail where id=$condition";
		}





}
$db = new Database;


?>
