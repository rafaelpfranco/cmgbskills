<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$DATA_ATUAL = date("Y-m-d H:i:s");
	
	$modal_id_usuario    = $_POST['modal_id_usuario'];
	$modal_id_candidato  = $_POST['modal_id_candidato'];
		
	if(isset($_GET['ac']) && $_GET['ac'] == "excluir"){
	
		$sql_alt_pro = " 
		UPDATE tbl_candidato SET 
		
		id_usuario_cancelamento = '$modal_id_usuario', 	
		data_cancelamento = '$DATA_ATUAL', 	
		situacao = 'CANCELADO'  
				
		WHERE id_candidato = '$modal_id_candidato' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_exclui_candidato'] = 'Candidato excluído com sucesso!';
		header('Location: index.php?pg=listar-candidatos');
		exit;
		
	}
	
	
?>