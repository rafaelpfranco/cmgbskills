<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_grupo  = $_POST['id_grupo'];
	$nome_grupo     = $_POST['nome_grupo'];
	$descricao = $_POST['descricao_grupo'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "editar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_grupo_pergunta SET 		
		grupo_pergunta = '$nome_grupo', 
		descricao = '$descricao' 		
		WHERE id_grupo_pergunta = '$id_grupo' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_edit_grupo'] = 'Edição do grupo realizada com sucesso!';
		header('Location: index.php?pg=grupo-pergunta');
		exit;
		
	}else{
		
		header('Location: index.php?pg=grupo-pergunta');
		exit;
		
	}
	
	
?>