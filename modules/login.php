<?php
require 'globals.php';

if($_POST['password'] == PASSWORD) {
	session_start();
	$_SESSION['login'] = "metrics";
	header("Location: https://kluch.me/kluch_metrics/views/main.html");
}
