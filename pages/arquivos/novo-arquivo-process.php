<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$ID_USUARIO = $_POST['modal_id_usuario'];
	$ID_PASTA   = $_POST['modal_id_pasta'];
	
	$NOME_PASTA = strtoupper($_POST['modal_nome_pasta']);
	
	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		$sql_cf = " 
		select
			ID_ARQUIVO_PASTA,
			NOME_PASTA
		from
			tbl_arquivo_pasta
		where
			ID_ARQUIVO_PASTA = '$ID_PASTA' and
			ID_USUARIO = '$ID_USUARIO'	
		";
		$qry_cf = mysql_query($sql_cf) or die ("Erro 01: ".mysql_error());
		$reg_cf = mysql_fetch_array($qry_cf);
			
		$ID_ARQUIVO_PASTA = $reg_cf['ID_ARQUIVO_PASTA'];
		$NOME_PASTA = $reg_cf['NOME_PASTA'];
		
		
		if(isset($_POST['upload'])){	
			foreach($_FILES["anexar_documento"]["name"] as $key => $valor){
				
				$ID_USUARIO   = $_POST['id_usuario'];
				$ID_PASTA     = $_POST['id_pasta'];
				$NOME_ARQUIVO = $_POST['nome_arquivo'];
				
				$pasta = 'arquivos/'.$NOME_PASTA.'/';		
				//$pasta = 'documentos/pagamentos/';
				
				$tmp_name   = $_FILES["anexar_documento"]["tmp_name"][$key];
		 		$nome       = $_FILES["anexar_documento"]["name"][$key];
				$uploadfile = $pasta . basename($nome);
				
		 		if(move_uploaded_file($tmp_name, $uploadfile)){
							
					//cadastra arquivo no banco
					$sql_cadar = " 
					INSERT INTO tbl_arquivo	( ID_ARQUIVO, ID_ARQUIVO_PASTA, ID_USUARIO, NOME_ARQUIVO, ARQUIVO, SITUACAO, ID_USUARIO_CADASTRO, DATA_CADASTRO ) 
					VALUES ( null, '$ID_PASTA', '$ID_USUARIO', '$NOME_ARQUIVO', '$nome', 'CADASTRADO', '$ID_USUARIO', now() ) ";
					$qry_cadar = mysql_query($sql_cadar) or die ("Erro ao realizar cadastro do arquivo: ".mysql_error());	
											
				}
			
			}				
		}
				
						
		$_SESSION['msg_novo_arquivo'] = 'Novo arquivo cadastrado com sucesso.';
		header('Location: index.php?pg=pastas');
		exit;

	}else{
				
		header('Location: index.php?pg=pastas');
		exit;	
		
	}


?>
		