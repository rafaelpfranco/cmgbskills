<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_usuario      = $_POST['id_usuario'];		
	$id_teste        = $_POST['id_teste'];
	
	$id_grupo_teste  = $_POST['id_grupo_teste'];
	
	$dt_inicio	 = $_POST['data_inicio'];
	$arr1        = explode('/',$dt_inicio);
	$data_inicio = $arr1[2].'-'.$arr1[1].'-'.$arr1[0];
			
	$dt_fim	     = $_POST['data_fim'];
	$arr2        = explode('/',$dt_fim);
	$data_fim    = $arr2[2].'-'.$arr2[1].'-'.$arr2[0];
		
	$nome_teste  = $_POST['nome_teste'];
	$observacao  = $_POST['observacao'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "alterar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_teste SET 		
		
		id_grupo_teste = '$id_grupo_teste',
		nome_teste = '$nome_teste',
		data_inicio = CASE WHEN '$dt_inicio' <> '' THEN '$data_inicio' ELSE null END, 
		data_fim = CASE WHEN '$dt_fim' <> '' THEN '$data_fim' ELSE null END, 
		observacao = '$observacao'	
		
		WHERE id_teste = '$id_teste' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_edita_teste'] = 'Edição do inventário realizada com sucesso!';
		header('Location: index.php?pg=inventario');
		exit;
		
	}else{
		
		header('Location: index.php?pg=inventario');
		exit;
		
	}
	
	
?>