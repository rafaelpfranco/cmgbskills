<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");

	

	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		$sql_del = " delete from tbl_cargo_permissao ";
		$qry_del = mysql_query($sql_del) or die ("Erro 1: ".mysql_error());	
		
		if(!empty($_POST['permissao']) && is_array($_POST['permissao'])){
			foreach($_POST['permissao'] as $item) {
				
		 		if($item['id_permissao'] != ""){
		   				
		   			//echo $item['selecionado']. ' - '. $item['id_parametro']. ' - '. $item['parametro']. ' - '. $item['unidade']. '<br />'. PHP_EOL;
					
					$id_cargo     = $item['id_cargo'];
					$id_permissao = $item['id_permissao'];
					$selecao      = $item['selecao'];
					
										
					if($selecao == "SIM"){
					//echo $id_grupo_pergunta." - ".$id_pergunta." - ".$selecao."<br/>";
								
					
						
						$sql_ins = "
						INSERT INTO tbl_cargo_permissao (			
						id_cargo, id_permissao  		 
						)
						
						VALUES ( 
						'$id_cargo', '$id_permissao' 
						
						)";
						$qry_ins = mysql_query($sql_ins) or die ("Erro 5: ".mysql_error());	
					
					}
					
				}

		 	}
		}

		
		$_SESSION['msg_edita_controle_acesso'] = 'Controle de acesso atualizado com sucesso!';
		header('Location: index.php?pg=controle-de-acesso');
		exit;
		

	}
	
	


?>
	