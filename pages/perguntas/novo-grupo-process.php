<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	
	$id_usuario      = $_POST['id_usuario'];
		
	$nome_grupo      = $_POST['nome_grupo'];
	$descricao_grupo = $_POST['descricao_grupo'];
	
	
	if(isset($_GET['ac']) && $_GET['ac'] == "incluir"){
	
		$sql_apr = "
		INSERT INTO tbl_grupo_pergunta (
		id_grupo_pergunta, grupo_pergunta, descricao, bloqueado, situacao, id_usuario_cadastro, data_cadastro   
		)
		VALUES ( 
		null, '$nome_grupo', '$descricao_grupo', 'F', 'CADASTRADO', '$id_usuario', now()  
		)
		";
		$qry_apr = mysql_query($sql_apr) or die ("Erro 1: ".mysql_error());
		
		
		$_SESSION['msg_novo_grupo'] = 'Grupo cadastrado com sucesso no sistema.';
		header('Location: index.php?pg=grupo-pergunta');
		exit;
		
		
	}else{
				
		header('Location: index.php?pg=grupo-pergunta');
		exit;	
		
	}
	
	
	
?>