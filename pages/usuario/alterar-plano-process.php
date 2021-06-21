<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$DIA_ATUAL = date("d");
	$DATA_ATUAL = date("Y-m-d");
	$DATA_VALIDA = date("Y-m-d H:i:s");
	
	$id_usuario	    = $_POST['modal_id_usuario'];
	$id_plano 	    = $_POST['modal_id_plano'];
	$valor_plano    = $_POST['modal_valor_plano'];
	$dia_vencimento = $_POST['modal_dia_vencimento'];
	
			
	
	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
			
		
		$sql_ac = "
		INSERT INTO tbl_usuario_plano ( 
		
		ID_USUARIO_PLANO, ID_USUARIO, ID_PLANO, SITUACAO, DIA_VENCIMENTO, DATA_ADESAO   
		
		)
		VALUES ( 
				
		null, '$id_usuario', '$id_plano', 'ATIVO', '$dia_vencimento', now() 
							
		)
		";
		$qry_ac = mysql_query($sql_ac) or die ("Erro 4: ".mysql_error());	
			
			
	$_SESSION['msg_novo_plano'] = 'Plano contratado alterado com sucesso!';
		header('Location: index.php?pg=plano-contratado');
		exit;
				
		
	}else{
				
		header('Location: index.php?pg=plano-contratado');
		exit;	
		
	}
	

?>
		