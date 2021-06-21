<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	
	$id_usuario        = $_POST['id_usuario'];
		
	$id_grupo_pergunta = $_POST['id_grupo_pergunta'];
	$pergunta_grupo    = $_POST['pergunta_grupo'];
	
	
	if(isset($_GET['ac']) && $_GET['ac'] == "incluir"){
	
		$sql_apr = "
		INSERT INTO tbl_pergunta (
		id_pergunta, id_grupo_pergunta, pergunta, bloqueado, situacao, id_usuario_cadastro, data_cadastro   
		)
		VALUES ( 
		null, '$id_grupo_pergunta', '$pergunta_grupo', 'F', 'CADASTRADO', '$id_usuario', now()  
		)
		";
		$qry_apr = mysql_query($sql_apr) or die ("Erro 1: ".mysql_error());
		
		
		$_SESSION['msg_nova_pergunta'] = 'Pergunta cadastrada com sucesso no sistema.';
		header('Location: index.php?pg=listar-perguntas&id='.$id_grupo_pergunta);
		exit;
		
		
	}else{
				
		header('Location: index.php?pg=listar-perguntas&id='.$id_grupo_pergunta);
		exit;	
		
	}
	
	
	
?>