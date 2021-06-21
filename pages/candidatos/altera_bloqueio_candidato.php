<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_candidato      = $_GET['id'];
	$bloqueado         = $_GET['blq'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "alterar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_candidato SET 		
		bloqueado = '$bloqueado'		
		WHERE id_candidato = '$id_candidato' ";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_bloq_candidato'] = 'Bloqueio do candidato alterado com sucesso!';
		header('Location: index.php?pg=listar-candidatos');
		exit;
		
	}
	
	
?>