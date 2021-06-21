<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$DATA_ATUAL = date("Y-m-d H:i:s");
	
	$modal_id_usuario_cadastro = $_POST['modal_id_usuario_cadastro'];
	$modal_id_usuario          = $_POST['modal_id_usuario'];
		
	if(isset($_GET['ac']) && $_GET['ac'] == "excluir"){
	
		$sql_alt_pro = " 
		UPDATE tbl_usuario SET 
		
		situacao = 'CANCELADO'  
				
		WHERE id_usuario = '$modal_id_usuario' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_exclui_usuario'] = 'Usuário excluído com sucesso!';
		header('Location: index.php?pg=usuarios');
		exit;
		
	}
	
	
?>