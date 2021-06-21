<?php

	session_start();
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");
	
	$id_grupo       = $_POST['id_grupo_teste'];
	$nome_grupo     = $_POST['nome_grupo'];
	$descricao      = $_POST['descricao_grupo'];
	
	if(isset($_GET['ac']) && $_GET['ac'] == "alterar"){
	
		//UPDATE BLOQUEIO
		$sql_alt_pro = " 
		UPDATE tbl_grupo_teste SET 		
		grupo_teste = '$nome_grupo', 
		descricao = '$descricao' 		
		WHERE id_grupo_teste = '$id_grupo' 
		";
		$qry_alt_pro = mysql_query($sql_alt_pro) or die ("Erro 1: ".mysql_error());	
		
		$_SESSION['msg_edita_teste'] = 'Edição do grupo realizada com sucesso!';
		header('Location: index.php?pg=grupo-inventario');
		exit;
		
	}else{
		
		header('Location: index.php?pg=grupo-inventario');
		exit;
		
	}
	
	
?>