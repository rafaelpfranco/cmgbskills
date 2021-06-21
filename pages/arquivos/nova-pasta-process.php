<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$ID_USUARIO = $_POST['modal_id_usuario'];
	$NOME_PASTA = strtoupper($_POST['modal_nome_pasta']);
	
	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		
		if(is_dir(arquivos.'/'.$NOME_PASTA.'/')){ }else{	mkdir(arquivos.'/'.$NOME_PASTA.'/', 0777, true); }
		
		$sql_ins = "
		INSERT INTO tbl_arquivo_pasta ( ID_ARQUIVO_PASTA, ID_USUARIO, NOME_PASTA, SITUACAO, ID_USUARIO_CADASTRO, DATA_CADASTRO )
		VALUES ( null, '$ID_USUARIO', '$NOME_PASTA', 'CADASTRADO', '$ID_USUARIO', now() )
		";
		$qry_ins = mysql_query($sql_ins) or die ("Erro 1: ".mysql_error());
				
						
		$_SESSION['msg_nova_pasta'] = 'Nova pasta criada com sucesso.';
		header('Location: index.php?pg=pastas');
		exit;

	}else{
				
		header('Location: index.php?pg=pastas');
		exit;	
		
	}


?>
		