<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$modal_exclui_id_candidato  = $_POST['modal_exclui_id_teste'];
		
	if(isset($_GET['ac']) && $_GET['ac'] == "excluir"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_candidato_teste SET 		
		situacao_teste = 'CANCELADO' 		
		WHERE id_candidato_teste = '$modal_exclui_id_candidato' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_exclui_teste'] = 'Teste excluído com sucesso!';
		header('Location: index.php?pg=aguardando');
		exit;
		
	}
	
	
?>