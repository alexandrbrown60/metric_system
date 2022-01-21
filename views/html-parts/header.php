<?php 
session_start();
if($_SESSION['login'] != 'metrics') {
	header("Location: https://kluch.me/kluch_metrics/index.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kluch Metrics</title>

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
	<nav class="navbar navbar-dark dark-background flex-md-nowrap p-3">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><img src="../assets/img/logo.svg"></a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Выйти</a>
        </li>
      </ul>
    </nav>