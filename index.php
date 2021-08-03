<?php
	require_once 'router/router.php';
	require_once 'router/action.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>2</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<a href="index.php?action=index">Home</a> |
	<a href="index.php?action=showCalendar">Show Calendar</a> |
	<a href="index.php?action=logout">Log Out</a> 

	<div class="content">
		<?php
			$index = new Router();
		?>
	</div>
	
</body>
</html>