<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_grupo_pergunta  = $_POST['id_grupo_pergunta'];
	$id_pergunta 		= $_POST['id_pergunta'];
	$editar_pergunta    = $_POST['editar_pergunta'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "editar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_pergunta SET 		
		pergunta = '$editar_pergunta'		
		WHERE id_pergunta = '$id_pergunta' and id_grupo_pergunta = '$id_grupo_pergunta' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_edit_pergunta'] = 'Edição da pergunta realizada com sucesso!';
		header('Location: index.php?pg=listar-perguntas&id='.$id_grupo_pergunta);
		exit;
		
	}
	
	
?>