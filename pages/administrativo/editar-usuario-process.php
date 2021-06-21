<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");

	$id_usuario_cadastro = $_POST['id_usuario_cadastro'];
	$id_usuario          = $_POST['id_usuario'];
	
	$data_fim_completa   = date("Y-m-d H:i:s");
	
	$cpf        = $_POST['cpf'];
	$nome       = $_POST['nome'];
	
	$email      = $_POST['email'];
	$telefone_1 = $_POST['telefone_1'];
	$telefone_2 = $_POST['telefone_2'];

	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		
		$sql_ins_cont = "
		
		UPDATE tbl_usuario SET 
			
		nome = CASE WHEN '$nome' <> '' THEN '$nome' ELSE null END, 
		email = CASE WHEN '$email' <> '' THEN '$email' ELSE null END, 
		telefone_1 = CASE WHEN '$telefone_1' <> '' THEN '$telefone_1' ELSE null END, 
		telefone_2 = CASE WHEN '$telefone_2' <> '' THEN '$telefone_2' ELSE null END
			
		WHERE id_usuario = '$id_usuario'
		
		";
		$qry_ins_cont = mysql_query($sql_ins_cont) or die ("Erro 1: ".mysql_error());
		
		
		
		$sql_del = " delete from tbl_usuario_cargo where id_usuario = '$id_usuario' ";
		$qry_del = mysql_query($sql_del) or die ("Erro 1: ".mysql_error());	
		
		
		if(!empty($_POST['permissao']) && is_array($_POST['permissao'])){
			foreach($_POST['permissao'] as $item) {
				
		 		if($item['id_cargo'] != ""){
		   				
		   			//echo $item['selecionado']. ' - '. $item['id_parametro']. ' - '. $item['parametro']. ' - '. $item['unidade']. '<br />'. PHP_EOL;
					
					$id_cargo = $item['id_cargo'];
					$selecao  = $item['selecao'];
					
										
					if($selecao == "SIM"){
					//echo $id_grupo_pergunta." - ".$id_pergunta." - ".$selecao."<br/>";
													
						$sql_ins = "
						INSERT INTO tbl_usuario_cargo (			
						id_usuario, id_cargo   		 
						)
						
						VALUES ( 
						'$id_usuario', '$id_cargo'   						
						)";
						$qry_ins = mysql_query($sql_ins) or die ("Erro 5: ".mysql_error());	
					
					}
					
				}

		 	}
			
		}

		
		$_SESSION['msg_edita_usuario'] = 'Usuário editado com sucesso!';
		header('Location: index.php?pg=editar-usuario&id='.$id_usuario);
		exit;
		

	}else{
	
		header('Location: index.php?pg=editar-usuario&id='.$id_usuario);
		exit;

	}

?>
	