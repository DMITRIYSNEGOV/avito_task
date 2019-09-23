<?require($_SERVER['DOCUMENT_ROOT'].'/config.php');?>
<?
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

function generate_guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }
    else{
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = chr(123)
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);
        return $uuid;
    }
}

function generateRandomString($length, $type, $custom_characters='') {
	switch ($type) {
		case 'number':
			$characters = '0123456789';
			break;
		case 'string':
			$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
		case 'guid':
			return generate_guid();
			break;
		case 'mixed':
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
		case 'custom':
			$characters = $custom_characters;
	}
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    if($type = 'number'){
    	return ltrim($randomString, '0');
    }
    return $randomString;
}
?>

<?

if( (!empty($_POST['type']) && $_POST['length'] > 0) || ($_POST['type'] == 'custom' && !empty($_POST['custom']) && $_POST['length'] > 0) )
{
	$tablename = TABLE_NAME;
	$dbname = DB_NAME;
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

	if ($connection->connect_error) {
    	die("Connection failed: " . $connection->connect_error);
	}

	if(!(mysqli_select_db($connection, DB_NAME))){
		$create_db = "CREATE DATABASE $dbname";
		mysqli_query($connection, $create_db);

		mysqli_select_db($connection, DB_NAME);

		$create_table = "CREATE TABLE $tablename (
							id INT AUTO_INCREMENT PRIMARY KEY,
							random_value VARCHAR(100) NOT NULL)";
		mysqli_query($connection, $create_table);

	}
	else{

		mysqli_select_db($connection, DB_NAME);
		$create_table = "CREATE TABLE IF NOT EXISTS $tablename (
							id INT AUTO_INCREMENT PRIMARY KEY,
							random_value VARCHAR(100) NOT NULL)";
		mysqli_query($connection, $create_table);
	}

	$random_value = generateRandomString($length = $_POST['length'], $type = $_POST['type'], $custom_characters = $_POST['custom']);

	$create_row = "INSERT INTO $tablename VALUES (NULL, '".$random_value."')";
	mysqli_query($connection, $create_row);

	mysqli_close($connection);
}
?>
