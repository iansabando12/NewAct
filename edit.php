<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name=$_POST['name'];
	$descr=$_POST['descr'];
	$pric=$_POST['pric'];
	$quan=$_POST['quan'];

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
	} else {	
		//updating the table
		$sql = "UPDATE users SET name=:name, descr=:descr, pric=:pric, quan=:quan WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':name', $name);
		$query->bindparam(':descr', $descr);
		$query->bindparam(':pric', $pric);
		$query->bindparam(':quan', $quan);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM users WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$name = $row['name'];
	$descr = $row['descr'];
	$pric = $row['pric'];
	$quan = $row['quan'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Description</td>
				<td><input type="text" name="descr" value="<?php echo $descr;?>"></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="text" name="pric" value="<?php echo $pric;?>"></td>
			</tr>
				<tr> 
				<td>Quantity</td>
				<td><input type="text" name="quan" value="<?php echo $quan;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
