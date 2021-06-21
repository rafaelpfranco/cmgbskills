<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	
	$id_usuario      = $_POST['id_usuario'];		
	$id_grupo_teste  = $_POST['id_grupo_teste'];
	
	$dt_inicio	 = $_POST['data_inicio'];
	$arr1        = explode('/',$dt_inicio);
	$data_inicio = $arr1[2].'-'.$arr1[1].'-'.$arr1[0];
			
	$dt_fim	     = $_POST['data_fim'];
	$arr2        = explode('/',$dt_fim);
	$data_fim    = $arr2[2].'-'.$arr2[1].'-'.$arr2[0];
		
	$nome_teste  = $_POST['nome_teste'];
	$observacao  = $_POST['observacao'];
	
	
	if(isset($_GET['ac']) && $_GET['ac'] == "incluir"){
	
		$sql_apr = "
		INSERT INTO tbl_teste (
		id_teste, id_grupo_teste, nome_teste, data_inicio, data_fim, observacao, 
		bloqueado, situacao, id_usuario_cadastro, data_cadastro 
		)
		VALUES ( 
		null, '$id_grupo_teste', '$nome_teste', '$data_inicio', CASE '$dt_fim' WHEN '' THEN NULL ELSE '$data_fim' END, '$observacao', 
		'F', 'CADASTRADO', '$id_usuario', now()  
		)
		";
		$qry_apr = mysql_query($sql_apr) or die ("Erro 1: ".mysql_error());
		
		
		$_SESSION['msg_novo_teste'] = 'Inventário cadastrado com sucesso no sistema.';
		header('Location: index.php?pg=inventario');
		exit;
		
		
	}else{
				
		header('Location: index.php?pg=inventario');
		exit;	
		
	}
	
	
	
?>