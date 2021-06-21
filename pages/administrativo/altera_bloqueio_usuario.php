<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_usuario        = $_GET['id'];
	$bloqueado         = $_GET['blq'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "alterar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_usuario SET 		
		bloqueado = '$bloqueado'		
		WHERE id_usuario = '$id_usuario' ";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_bloq_usuario'] = 'Bloqueio do usuário alterado com sucesso!';
		header('Location: index.php?pg=usuarios');
		exit;
		
	}
	
	
?>