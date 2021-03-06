<?php 
session_start();
if($_SESSION['login'] == "metrics") {
	header("Location: https://kluch.me/kluch_metrics/views/main.php");
}	
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kluch Metrics</title>

	<link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets/css/login.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="form-box">
					<img src="assets/img/logo.svg">
					<form action="modules/login.php" method="POST">
						<input type="password" name="password" id="password" placeholder="Пароль" class="login-input">
						<button id="send" type="submit" class="login-btn">Вперёд</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="assets/js/jquery.js" type="text/javascript"></script>
	<script src="controllers/js/login.js" type="text/javascript"></script>
</body>
</html>