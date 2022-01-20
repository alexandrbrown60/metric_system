<?php
require 'globals.php';

if($_POST['password'] == PASSWORD) {
	session_start();
	$_SESSION['login'] = "metrics";
	header("Location: https://kluch.me/kluch_metrics/views/main.php");
} else {
	sleep(3);
	print_r("Неверный пароль");
	header("Location: https://kluch.me/kluch_metrics/index.php");
	exit();
}
