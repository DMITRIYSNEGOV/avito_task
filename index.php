<html>
<head>
</head>
<body>
	<form action="/api/generate/index.php" method="POST" id="generate">
		<select name="type">
			<option value="string">Строка</option>
			<option value="number">Число</option>
			<option value="guid">guid</option>
			<option value="mixed">Цифробуквенное</option>
			<option value="custom">Заданные значения</option>
		</select><br>
		<input type="text" name="custom" placeholder="Заданные значения"><br>
		<input type="number" name="length" placeholder="Длина" min="1" max="100"><br>
		<input type="submit" value="Generate">
	</form>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="main.js"></script>
</body>
</html>