<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$DATA_ATUAL = date("Y-m-d");
	
	$id_usuario = $_POST['id_usuario'];
	
	$apelido 	= $_POST['apelido'];
	$registro_abpp 	= $_POST['registro_abpp'];	
	$secao_abpp     = $_POST['secao_abpp'];
	$aniversario    = $_POST['aniversario'];
	
	$cep       			= $_POST['cep'];
	$endereco       	= $_POST['endereco'];
	$numero_endereco    = $_POST['numero_endereco'];
	$complemento       	= $_POST['complemento'];
	$bairro       		= $_POST['bairro'];
	$cidade       		= $_POST['cidade'];
	$uf       			= $_POST['uf'];
	
	$email       = $_POST['email'];
	$telefone_1  = $_POST['telefone_1'];
	$telefone_2  = $_POST['telefone_2'];
		
	
	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		
		$sql_ins_cont = "
		
		UPDATE tbl_usuario SET 
		
		
		
		email = CASE WHEN '$email' <> '' THEN '$email' ELSE null END,
		telefone_1 = CASE WHEN '$telefone_1' <> '' THEN '$telefone_1' ELSE null END,
		telefone_2 = CASE WHEN '$telefone_2' <> '' THEN '$telefone_2' ELSE null END,
		
		apelido = CASE WHEN '$apelido' <> '' THEN '$apelido' ELSE null END,
		aniversario = CASE WHEN '$aniversario' <> '' THEN '$aniversario' ELSE null END
							
		WHERE id_usuario = '$id_usuario'
		
		";
		$qry_ins_cont = mysql_query($sql_ins_cont) or die ("Erro 1: ".mysql_error());
		
				
		
		$_SESSION['msg_edita_dados'] = 'Dados pessoais atualizados com sucesso no sistema.';
		header('Location: index.php?pg=meus-dados');
		exit;
				
		
	}else{
				
		header('Location: index.php?pg=meus-dados');
		exit;	
		
	}
	

?>