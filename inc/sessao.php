<?php
	// Verificando se a sess�o � v�lida
	if (!isset($_SESSION)) session_start();
	
	if ((!isset($_SESSION['sessao_sistema']) ||	(isset($_SESSION['sessao_sistema']) != md5($_SERVER['HTTP_USER_AGENT'])))) {
		if (!isset($_SESSION)) session_start();
		session_destroy();
		header("Location: login.php");
	}
?>