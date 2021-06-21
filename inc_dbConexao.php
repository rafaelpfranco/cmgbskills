<?php

	$host        = "appcmgbskills.mysql.dbaas.com.br";
	$username    = "appcmgbskills";
	$password    = "Cmgb@#3110";
	$banco_dados = "appcmgbskills";
	
	$conexao = mysql_connect($host,$username,$password) or die ("Erro na Conexao: ".mysql_error());
	$banco   = mysql_select_db($banco_dados,$conexao) or die ("Erro ao Selecionar Banco: ".mysql_error());
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	
	//$conexao = mysqli_connect($host,$username,$password,$banco_dados) or die ("Erro na Conexao: ".mysql_error());

?>
