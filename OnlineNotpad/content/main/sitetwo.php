<?php

echo "with functions acces site 3<br>";

echo "<h1>MULTIQUERY</h1>";
echo "<span>used to make multiple querys in one ressource.</span><br><br>";
$db = @new mysqli( 'localhost', 'root', '', 'm133a100' );



	$var    = $db->real_escape_string('FirstName');
	$sql= sprintf("SELECT %s from detail;", $var);
	$var2    = $db->real_escape_string('ID');
	$sql .= sprintf("SELECT %s from detail;", $var2);
	// INSERT INTO putin (data,description) VALUES ('multidata','multidescription'); 
    $sql .= "SELECT Firstname, Lastname from detail WHERE ID=1; SELECT Firstname, Lastname from detail; SELECT * FROM detail; SELECT d.Lastname, s.information FROM someinfo as s LEFT JOIN detail as d ON s.ID=d.ID; SELECT City from detail;";
	$sql .="SELECT ID, Address from detail;";

    	
   	$db->set_charset("utf8"); // umlaute 
	if ($db->multi_query($sql)) { //prüft ob eine gültige mysqli multiquery resource übergeben wurde
	
		do {
			$stmt = $db->store_result(); //resultate werden gespeichert jedoch NUR ERSTE, so ist die syntax aufgebaut
			//print_r($stmt); // rahmenbedingungen werden ausgegeben
			
			while ($row = $stmt->fetch_array(MYSQLI_NUM)) { //ein fetch damit es für php lesbar ist 
			// $row["FirstName"] $row[0]
			//print_r($row);  echo "<br>";
			$fields = $stmt->field_count; // wieviele felder sind da
				$count=0;
				//echo ">>" . $fields;
				while($count<=$fields-1) {
					//echo "Datensatz" . $count . ">>" . $row[$count] . "<br>";
					//echo "counter" . $count;
					echo " Datensatz $count> " . $row[$count];
					$count++;
				}
				//echo "FIRST: " . $row[0]. " SECOND: " . $row["FirstName"] .  "<br>";
				echo "<br>";
			}
			$stmt->free(); //resource für das statement das an der reihe ist freigeben
	
		
			/* nun kümmert man sich auf darauffolgende ergebnisse hier stellt sich die frage:
			1) gibts noch mehr resultate ?
			2) wie geb ich diese aus
			3) WICHTIG : MYSQLI ist nicht in der lage querys zu überspringen es nimmmt sie der reihenfolge nach
			*/
			if ($db->more_results()) { //prüft ala : sind da echt noch mehr results vorhanden ?
				echo "<br><br>";
			}
		} while($db->next_result());
	} 
	$stmt->close();     // Resourcen freigeben
			

echo "<br>===================================================================================<br>";

echo "<h1>Single Query</h1>";
echo "<span>used to make one simple query </span><br><br>";


    $stmt = $db->query('SELECT * FROM someinfo as s LEFT JOIN detail as d ON s.ID=d.ID;'); //query
    //echo "Eintrage: " .$stmt->num_rows; //zählen der zeilen
	//print_r($stmt); //meta rahmen
	$fields = $stmt->field_count; 
	
    while ($row = $stmt->fetch_array(MYSQLI_NUM))
    {
		$count=0;
		while($count<=$fields-1) {
					//echo "Datensatz" . $count . ">>" . $row[$count] . "<br>";
					//echo "counter" . $count;
					echo " Datensatz $count> " . $row[$count];
					$count++;
				}
				echo "<br>";
    }
	$stmt->close();     // Resourcen freigeben
	
echo "<br>===================================================================================<br>";	

    
echo "<h1>Prepared Statements</h1>";
echo "<span>used for single query preparation. for later execution</span><br><br>";

$stmt = $db->prepare('SELECT Lastname, Firstname FROM detail;');     // Statement vorbereiten
    $stmt->execute();     // an die DB schicken
    $stmt->bind_result($var1, $var2);
    while ($stmt->fetch())
    {
        echo "Lastname " . $var1 . " / " . "Firstname " . $var2 . "<br>";
    }
 	$stmt->close();     // Resourcen freigeben
	
echo "<br>===================================================================================<br>";	
echo "<h1>Bind Param Statements</h1>";
echo "<span>used for single query preparation. Also contains Encryption of all values</span><br><br>";

	$data="Ivica";
	$description="a simple description";
        $stmt = $db->prepare('INSERT INTO putin (`data`,`description`) VALUES (?, ?);');
        $stmt->bind_param( 'ss', $data, $description); // s i 
        $stmt->execute();
        echo "Affected Insert : " . $stmt->affected_rows . "<br>"; //true bei 1
	$stmt->close();     // Resourcen freigeben
	
	$one=1;
	$two="Brnic";
	$stmt = $db->prepare('SELECT Address, City FROM detail WHERE id=? AND LastName=?');
	
	$stmt->bind_param( 'ss', $one, $two);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($var1,$var2);
	$troll = $stmt->fetch(); 
	print_r($troll);
	echo "Adress:" . $var1 . " City " . $var2;
echo "<br>===================================================================================<br>";	
	

$db->close(); //hier schliessen wir das erste query. und geben die ressourcen frei
?>