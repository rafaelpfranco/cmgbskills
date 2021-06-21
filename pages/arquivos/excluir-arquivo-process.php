<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$DATA_ATUAL = date("Y-m-d");
	
	$ID_ARQUIVO       = $_POST['modal_id_arquivo'];
	$ID_USUARIO       = $_POST['modal_id_usuario'];
	$MOTIVO           = $_POST['modal_motivo'];
	
		
	if(isset($_GET['ac']) && $_GET['ac'] == "excluir"){
		
		// EXCLUI PERMISSAO
		$sql_del = " 
			update 
				tbl_arquivo 
			
			set 
				ID_USUARIO_CANCELAMENTO = '$ID_USUARIO', 
				MOTIVO_CANCELAMENTO = '$MOTIVO', 
				DATA_CANCELAMENTO = '$DATA_ATUAL', 
				SITUACAO = 'CANCELADO' 
			
			where 
				ID_ARQUIVO = '$ID_ARQUIVO' and 
				ID_USUARIO = '$ID_USUARIO' 
			
			";
		$qry_del = mysql_query($sql_del) or die ("Erro 1: ".mysql_error());	
		
		//unlink("arquivos/servico/".$ARQUIVO);
		
		$_SESSION['msg_excluir_arquivo'] = 'Arquivo excluído com sucesso!';
		header('Location: index.php?pg=pastas');
		exit;
		
	}
	
	
?>