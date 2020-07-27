<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Page_B</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<main>
			<h2>This is Page B.</h2>
		</main>
		<?php
			setcookie('current_page', '/page_b', time()+3600);
		?>
	</body>
</html>