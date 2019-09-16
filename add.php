<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
	$descr = $_POST['descr'];
	$pric = $_POST['pric'];
	$quan = $_POST['quan'];
		
	// checking empty fields
	if(empty($name) || empty($descr) || empty($pric) || empty($quan)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		if(empty($descr)) {
			echo "<font color='red'>Descrioption field is empty.</font><br/>";
		}
		if(empty($pric)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}
		if(empty($quan)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}
		

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO users(name, descr, pric, quan) VALUES(:name, :descr, :pric, :quan)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':name', $name);
		$query->bindparam(':descr', $descr);
		$query->bindparam(':pric', $pric);
		$query->bindparam(':quan', $quan);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
