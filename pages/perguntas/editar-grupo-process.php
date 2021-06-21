<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$modal_edita_id_grupo  = $_POST['modal_edita_id_grupo'];
	$modal_edita_grupo     = $_POST['modal_edita_grupo'];
	$modal_edita_descricao = $_POST['modal_edita_descricao'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "editar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_grupo_pergunta SET 		
		grupo_pergunta = '$modal_edita_grupo', 
		descricao = '$modal_edita_descricao' 		
		WHERE id_grupo_pergunta = '$modal_edita_id_grupo' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_edit_grupo'] = 'Edição do grupo realizada com sucesso!';
		header('Location: index.php?pg=grupo-pergunta');
		exit;
		
	}
	
	
?>