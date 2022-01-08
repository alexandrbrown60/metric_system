<?php
header("Content-type: text/html; charset=utf-8");
require '../modules/globals.php';
require '../modules/classes/crm/CrmManager.php';

$id = $_GET['id'];
$crm = new CrmManager();
$result = $crm->getAgentInfo($id);
$name = $result->$id->name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Форма отчета | Kluch Metrics</title>

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>Привет, <?php echo $name;?>👋<br>пришло время для отчета!</h2>
				<p>Укажи данные за прошедний день: <span id="date"></span></p>
			</div>
		</div>
		<div class="form-box">
			<form method="post" action="../controllers/send-agent-form.php">
				<div class="form-group">
					<input type="number" placeholder="Кол-во встреч" name="meetings" required>
				</div>
				<div class="form-group">
					<input type="number" name="calls" placeholder="Исходящих звонков" required>
				</div>
				<div class="form-group">
					<input type="number" name="presentations" placeholder="Показов" required>
				</div>
				<div class="form-group">
					<input type="number" name="additional" placeholder="Доп. показы" required>
				</div>
				<div class="form-group">
					<input type="number" name="zadatki" placeholder="Задатки" required>
				</div>
				<div class="form-group">
					<input type="number" name="sdelki" placeholder="Сделки" required>
				</div>
				<input type="hidden" value="<?php echo $id;?>" name="agent-id">
				<div class="form-group">
					<button type="submit">Отправить</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>