<h1> This is the Site 3</h1>




<?php


echo "<h2>Singlequery Dynamic</h2>";
$result_singlequery_dynamic = $db->singlequery_dynamic('SELECT * FROM detail');
$fields = $result_singlequery_dynamic[1]['con'][0];
//print_r($result_singlequery_dynamic);
echo "<table border='1'>";
foreach ($result_singlequery_dynamic[0] as $row) {
	$count=0;
	echo "<tr>";
	while($count<=$fields-1) {
		echo "<td>" . $row[$count] . "</td>";
		$count++;
	}
	echo "</tr>";
}
echo "</table>";



echo "<h2>Singlequery Dynamic WITH prepared (SELECTS)</h2>";
$result_prepared_dynamic_select = $db->prepared_dynamic_select('SELECT ID, Firstname, LastName FROM detail',1);
print_r($result_prepared_dynamic_select);


echo "<h2>Singlequery Dynamic WITH prepared (UPDATE INSERT DELETE ETC. SQLCOMMANDS)</h2>";
$result_prepared_dynamic_sqlcommands = $db->prepared_dynamic_sqlcommands("INSERT INTO putin (`data`,`description`) VALUES ('datatest','desctest');",2); 
echo "Affected Rows: " . $result_prepared_dynamic_sqlcommands;


echo "<h2>Multiquery SELECT</h2>";
$result_multiquery_dynamic_select = $db->multiquery_dynamic_select("SELECT * from detail; SELECT Firstname, Lastname from detail WHERE ID=1; SELECT Firstname, Lastname from detail; SELECT * FROM detail; SELECT d.Lastname, s.information FROM someinfo as s LEFT JOIN detail as d ON s.ID=d.ID; SELECT City from detail; SELECT ID from putin LIMIT 10;");
print_r($result_multiquery_dynamic_select);




echo "<h2>Multiquery SQL COMMANDS</h2>";
$result_multiquery_dynamic_sqlcommand= $db->multiquery_dynamic_sqlcommand("INSERT INTO putin (`data`,`description`) VALUES ('ONEDATA','ONEDESC'); INSERT INTO putin (`data`,`description`) VALUES ('TWODATA','TWODESC'); INSERT INTO putin (`data`,`description`) VALUES ('threed','threedesct'); INSERT INTO putin (`data`,`description`) VALUES ('fourdata','desc4');");
echo "Affected Rows: " . $result_multiquery_dynamic_sqlcommand . "<br>";

?>