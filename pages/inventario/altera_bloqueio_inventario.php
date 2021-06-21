<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_teste   = $_GET['id'];
	$bloqueado  = $_GET['blq'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "alterar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_teste SET 		
		bloqueado = '$bloqueado'		
		WHERE id_teste = '$id_teste' ";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_edit_bloq_teste'] = 'Bloqueio do inventário alterado com sucesso!';
		header('Location: index.php?pg=inventario');
		exit;
		
	}
	
	
?>