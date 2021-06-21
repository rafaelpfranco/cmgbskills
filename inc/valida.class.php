<?php

	class validar{
	
		# OBJETOS DO BANCO DE DADOS
		var $tabela;
		var $campo_login;
		var $campo_senha;
				
		# OBJETOS DAS P�GINAS
		var $pag_login;
		var $pag_error;
		var $input_login;
		var $input_senha;
		
		# SETANDO O DIRET�RIO DO BANCO E A TABELA
		function Conexao($tabela, $login, $senha){
		
			$this->tabela      = $tabela;
			$this->campo_login = $login;
			$this->campo_senha = $senha;
		
		}
				
		# SETANDO OS INPUTS TEXTS QUE VIR�O DO FORMUL�RIO
		function Inputs($login, $senha){
		
			$this->input_login = $login;
			$this->input_senha = $senha;
		
		}
		
		# SETANDO AS P�GINAS DE REDIRECIONAMENTO
		function Redirecionamento($pag_login, $pag_erro){
		
			$this->pag_login = $pag_login;
			$this->pag_error = $pag_erro;
		
		}
		
		# ATIVANDO A VALIDA��O
		function Logar(){
			
			$tabela      = $this->tabela;
			$campo_login = $this->campo_login;
			$campo_senha = $this->campo_senha; 
			$input_login = mysql_real_escape_string($this->input_login);
			$input_senha = mysql_real_escape_string($this->input_senha);
			
			$pag_login = $this->pag_login;
			$pag_error = $this->pag_error;
			
			$sql = "SELECT * FROM $tabela WHERE $campo_login = '$input_login' AND $campo_senha = '$input_senha'";
			$qry = mysql_query($sql) or die('<b>Erro ao Executar Query: </b>' . mysql_error());
			$num = mysql_num_rows($qry);
				
			if ($num == 0) {
				session_start();
				$_SESSION['error'] = "Usuário ou senha inválidos. Tente novamente.";				
				header("Location: ".$pag_error."");
			
			} else {
		
				session_start();
				
				unset($_SESSION['error']);
				
				$_SESSION['sessao_sistema'] = md5($_SERVER['HTTP_USER_AGENT']);			
				$_SESSION['login'] = $input_login;
				$_SESSION['senha'] = $input_senha;
			
				header("Location: ".$pag_login."");
			
			}
			
		}
		
	}		

?>