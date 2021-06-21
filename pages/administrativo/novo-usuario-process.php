<?php

	session_start();
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/funcoes.php");

	$id_usuario_cadastro = $_POST['id_usuario'];
	$data_fim_completa   = date("Y-m-d H:i:s");
	
	$cpf        = $_POST['cpf'];
	$nome       = $_POST['nome'];
	
	$email      = $_POST['email'];
	$telefone_1 = $_POST['telefone_1'];
	$telefone_2 = $_POST['telefone_2'];

	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		$sql_cpf = " select cpf from tbl_usuario where cpf = '$cpf' ";
	    $qry_cpf = mysql_query($sql_cpf) or die ("Erro 1: ".mysql_error());
		$existe_cpf = mysql_num_rows($qry_cpf);
		
		if($existe_cpf != ""){
		
			$_SESSION['msg_existe_cpf'] = 'O CPF informado já possui cadastro.';
			header('Location: index.php?pg=novo-usuario');
			exit;
	
		}
		
		
		$sql_apr = "
		INSERT INTO tbl_usuario (
		  
		id_usuario, cpf, nome, email, telefone_1, telefone_2, apelido, login, senha, 
		primeiro_acesso, bloqueado, situacao, id_usuario_cadastro, data_cadastro 
		
		)
		VALUES ( 
		
		null, '$cpf', '$nome', '$email', '$telefone_1', '$telefone_2', '$nome', '$email', '202cb962ac59075b964b07152d234b70',  
		'F', 'F', 'CADASTRADO', '$id_usuario_cadastro', now()
		  
		)
		";
		$qry_apr = mysql_query($sql_apr) or die ("Erro 1: ".mysql_error());

		
		$sql_cand = " select id_usuario from tbl_usuario where cpf = '$cpf' order by id_usuario desc limit 1 ";
	    $qry_cand = mysql_query($sql_cand) or die ("Erro 1: ".mysql_error());
	    $reg_cand = mysql_fetch_array($qry_cand);
	    
	    $id_usuario = $reg_cand['id_usuario'];
		
		
		
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

		
		$_SESSION['msg_novo_usuario'] = 'Usuário cadastrado com sucesso!';
		header('Location: index.php?pg=usuarios');
		exit;
		

	}else{
	
		header('Location: index.php?pg=usuarios');
		exit;

	}

?>
	