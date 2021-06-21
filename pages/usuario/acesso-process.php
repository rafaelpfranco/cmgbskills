<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$DATA_ATUAL = date("Y-m-d");
	
	$id_usuario = $_POST['id_usuario'];
	
	$nova_senha 	    = md5($_POST['nova_senha']);
	$repetir_nova_senha	= md5($_POST['repetir_nova_senha']);	
	
	
	
	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		
		if($nova_senha == $repetir_nova_senha){
		
			$sql_ins_cont = "
			
			UPDATE tbl_usuario SET 
			
			senha = CASE WHEN '$nova_senha' <> '' THEN '$nova_senha' ELSE null END
								
			WHERE id_usuario = '$id_usuario'
			
			";
			$qry_ins_cont = mysql_query($sql_ins_cont) or die ("Erro 1: ".mysql_error());
		
		}else{
			
			$_SESSION['msg_edita_senha_erro'] = 'Os campos NOVA SENHA e REPETIR NOVA SENHA não conferem. Por favor, cadastre novamente.';
			header('Location: index.php?pg=meus-dados');
			exit;
			
		}		
		
		$_SESSION['msg_edita_senha'] = 'Senha de acesso atualizada com sucesso no sistema.';
		header('Location: index.php?pg=meus-dados');
		exit;
				
		
	}else{
				
		header('Location: index.php?pg=meus-dados');
		exit;	
		
	}
	

?>