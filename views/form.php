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
				<table>
					<tbody>
						<tr>
							<td><label for="meetings">Встреч:</label></td>
							<td><input type="number" name="meetings" id="meetings" required></td>
						</tr>
						<tr>
							<td><label for="calls">Исходящих:</label></td>
							<td><input type="number" name="calls" id="calls" required></td>
						</tr>
						<tr>
							<td><label for="pres">Показы:</label></td>
							<td><input type="number" name="presentations" id="pres" required></td>
						</tr>
						<tr>
							<td><label for="adds">Доп. показы:</label></td>
							<td><input type="number" name="additional" id="pres" required></td>
						</tr>
						<tr>
							<td><label for="zadatki">Задатки:</label></td>
							<td><input type="number" name="zadatki" id="zadatki" required></td>
						</tr>
						<tr>
							<td><label for="sdelki">Сделки:</label></td>
							<td><input type="number" name="sdelki" id="sdelki" required></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
				<input type="hidden" value="<?php echo $id;?>" name="agent-id">
				<div class="form-group">
					<button type="submit">Отправить</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>