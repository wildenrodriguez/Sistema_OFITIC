<?php 

	session_start();

	$page="login";

	if (!empty($_GET['page'])) {
		$page = $_GET['page'];
	}

	if (is_file("controller/".$page.".php")) {
		require_once "controller/$page.php";
	} else {
		require_once "view/404.php";
	}
	
?>