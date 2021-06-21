<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_pergunta       = $_GET['id'];
	$id_grupo_pergunta = $_GET['idg'];
	$bloqueado         = $_GET['blq'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "alterar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_pergunta SET 		
		bloqueado = '$bloqueado'		
		WHERE id_pergunta = '$id_pergunta' ";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_edit_bloq_pergunta'] = 'Bloqueio da pergunta alterado com sucesso!';
		header('Location: index.php?pg=listar-perguntas&id='.$id_grupo_pergunta);
		exit;
		
	}
	
	
?>