<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$modal_exclui_id_grupo  = $_POST['modal_exclui_id_grupo'];
		
	if(isset($_GET['ac']) && $_GET['ac'] == "excluir"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_grupo_pergunta SET 		
		situacao = 'CANCELADO' 		
		WHERE id_grupo_pergunta = '$modal_exclui_id_grupo' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_exc_grupo'] = 'Grupo excluído com sucesso!';
		header('Location: index.php?pg=grupo-pergunta');
		exit;
		
	}
	
	
?>