<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_usuario          = $_POST['id_usuario'];
	$id_candidato_teste  = $_POST['id_candidato_teste'];
	
	$DATA_ATUAL = date("Y-m-d H:i:s");
	
	if(isset($_GET['ac']) && $_GET['ac'] == "alterar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_candidato_teste SET 		
		
		situacao = 'LIBERADO', 
		id_usuario_liberado = '$id_usuario', 
		data_liberado = '$DATA_ATUAL' 		
		
		WHERE id_candidato_teste = '$id_candidato_teste' ";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_autoriza_teste'] = 'Teste autorizado com sucesso!';
		header('Location: index.php?pg=aguardando');
		exit;
		
	}
	
	
?>