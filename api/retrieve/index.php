<?require($_SERVER['DOCUMENT_ROOT'].'/config.php');?>
<?
echo "<h1>";
if(ctype_digit($_GET['id'])){
	$tablename = TABLE_NAME;
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

	if($connection){
		mysqli_select_db($connection, DB_NAME);

		$query = "SELECT random_value FROM $tablename WHERE id = " . $_GET['id'];
		if($res = mysqli_query($connection, $query)){
			
			if($val = mysqli_fetch_assoc($res)){
				echo $val['random_value'];
			}
			else{
				echo "Invalid ID";
			}
		}
	}
	mysqli_close($connection);
}
else
	echo "Invalid ID";

echo "</h1>";
?>
