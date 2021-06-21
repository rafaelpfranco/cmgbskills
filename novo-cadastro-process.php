<?php

	session_start();
	require_once("inc_dbConexao.php");
	require_once("inc/funcoes.php");
	
	$DIA_ATUAL = date("d");
	$DATA_ATUAL = date("Y-m-d");
	$DATA_VALIDA = date("Y-m-d H:i:s");
	
	$cpf    		= $_POST['cpf'];
	$nome 			= $_POST['nome'];		
	$email 			= $_POST['email'];
	$telefone_1 	= $_POST['telefone'];
	$senha      	= md5($_POST['senha']);
	
	$plano 			= "PLANO INICIANTE";
	$valor_plano	= "0.00";		
	
	if(isset($_GET['ac']) && $_GET['ac'] == "cadastrar"){
		
		
		$sql_cpf = " SELECT CPF FROM tbl_usuario WHERE CPF = '$cpf' and SITUACAO = 'CADASTRADO' ";
		$qry_cpf = mysql_query($sql_cpf) or die ("Erro 2: ".mysql_error());
		$reg_cpf = mysql_fetch_array($qry_cpf);
		
		$EXISTE_CPF = $reg_cpf['CPF'];
		
		if($EXISTE_CPF != ""){
			
			$_SESSION['msg_existe_cadastro'] = 'O CPF informado já possui cadastro.';
			header('Location: login.php');
			exit;
			
		}else{
		
		
			/// CADASTRA USUARIO
			$sql_aa = "
			INSERT INTO tbl_usuario ( 
			
			ID_USUARIO, CPF, NOME, EMAIL, TELEFONE_1, APELIDO, LOGIN, SENHA, 
			DADOS_IMPRESSAO, TERMOS_DE_USO, ACESSO_APP, BLOQUEADO, PRIMEIRO_ACESSO, 
			SITUACAO, DATA_CADASTRO 
			
			)
			VALUES ( 
					
			null, '$cpf', '$nome', '$email', '$telefone_1', '$nome', '$email', '$senha', 
			'T', 'CIENTE', 'T', 'F', 'T', 
			'CADASTRADO', now() 
								
			)
			";
			$qry_aa = mysql_query($sql_aa) or die ("Erro 1: ".mysql_error());
		
		
			/// SELECIONA ID USUARIO
			$sql_f = " SELECT ID_USUARIO FROM tbl_usuario WHERE EMAIL = '$email' AND BLOQUEADO = 'F' order by ID_USUARIO desc limit 1 ";
			$qry_f = mysql_query($sql_f) or die ("Erro 2: ".mysql_error());
			$reg_f = mysql_fetch_array($qry_f);
			
			$ID_USUARIO = $reg_f['ID_USUARIO'];
		
		
			/// CADASTRA PERMISSAO
			$sql_ab = "
			INSERT INTO tbl_usuario_permissao ( 
			
			ID_USUARIO, ID_PERFIL, ID_PERMISSAO, DATA_VINCULO  
			
			)
			VALUES ( 
					
			'$ID_USUARIO', '1', '1', now() 
								
			)
			";
			$qry_ab = mysql_query($sql_ab) or die ("Erro 3: ".mysql_error());
		
		
			/// CADASTRA PLANO
			$sql_ac = "
			INSERT INTO tbl_usuario_plano ( 
			
			ID_USUARIO_PLANO, ID_USUARIO, ID_PLANO, SITUACAO, DIA_VENCIMENTO, DATA_ADESAO   
			
			)
			VALUES ( 
					
			null, '$ID_USUARIO', '1', 'ATIVO', '$DIA_ATUAL', now() 
								
			)
			";
			$qry_ac = mysql_query($sql_ac) or die ("Erro 4: ".mysql_error());
		
		
		
			/*
			$sql_ins_cont = "
			INSERT INTO tbl_cadastro ( 
			
			ID_CADASTRO, PLANO, VALOR_PLANO, CUPOM,    
			CPF, NOME, EMAIL, TELEFONE, SENHA,  
			SITUACAO_CADASTRO, ID_CONTA, IDENTIFICADOR, DATA_AUTORIZACAO, DIA_VENCIMENTO, ID_USUARIO_VALIDA, DATA_VALIDA, OBSERVACAO_VALIDA,        
			SITUACAO, DATA_CADASTRO
			
			)
			VALUES ( 
					
			null, '$plano', '$valor_plano', NULL,   
			'$cpf', '$nome', '$email', '$telefone_1', '$senha', 
			'APROVADO', NULL, NULL, NULL, NULL, NULL, NULL, NULL,  
			'CADASTRADO', now()
								
			)
			";
			$qry_ins_cont = mysql_query($sql_ins_cont) or die ("Erro 1: ".mysql_error());
			*/
		
			$_SESSION['msg_novo_cadastro'] = 'Cadastro realizado com sucesso. Obrigado por escolher o sistema GESTOR PSICOPEDAGOGIA!';
			header('Location: login.php');
			exit;
			
		}
				
		
	}else{
				
		header('Location: login.php');
		exit;	
		
	}
	

?>