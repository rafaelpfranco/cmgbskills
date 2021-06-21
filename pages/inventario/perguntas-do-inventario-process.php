<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");

	$id_usuario = $_POST['id_usuario_cadastro'];
	$id_teste   = $_POST['id_teste'];

	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		$sql_del = " delete from tbl_teste_pergunta where id_teste = '$id_teste' ";
		$qry_del = mysql_query($sql_del) or die ("Erro 1: ".mysql_error());	
		
		if(!empty($_POST['permissao']) && is_array($_POST['permissao'])){
			foreach($_POST['permissao'] as $item) {
				
		 		if($item['id_pergunta'] != ""){
		   				
		   			//echo $item['selecionado']. ' - '. $item['id_parametro']. ' - '. $item['parametro']. ' - '. $item['unidade']. '<br />'. PHP_EOL;
					
					$id_grupo_pergunta = $item['id_grupo_pergunta'];
					$id_pergunta       = $item['id_pergunta'];
					$selecao           = $item['selecao'];
					
										
					if($selecao == "SIM"){
					//echo $id_grupo_pergunta." - ".$id_pergunta." - ".$selecao."<br/>";
								
					
						
						$sql_ins = "
						INSERT INTO tbl_teste_pergunta (			
						id_teste, id_grupo_pergunta, id_pergunta, data_inicio, id_usuario_cadastro, data_cadastro 		 
						)
						
						VALUES ( 
						'$id_teste', '$id_grupo_pergunta', '$id_pergunta', now(), '$id_usuario', now()
						
						)";
						$qry_ins = mysql_query($sql_ins) or die ("Erro 5: ".mysql_error());	
					
					}
					
				}

		 	}
		}

		
		$_SESSION['msg_edita_perguntas'] = 'Perguntas do inventário atualizadas com sucesso!';
		header('Location: index.php?pg=perguntas-do-inventario&id='.$id_teste);
		exit;
		

	}
	
	


?>
	