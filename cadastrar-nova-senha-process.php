<?php

	session_start();
	require_once("inc_dbConexao.php");
	require_once("inc/funcoes.php");
	
	
	$DATA_ATUAL = date("Y-m-d H:i:s");
	
	$token_recupera      = $_POST['token_recupera'];
	$nova_senha          = $_POST['nova_senha'];
	$confirma_nova_senha = $_POST['confirma_nova_senha'];
	
	if($nova_senha != $confirma_nova_senha){
		
		$_SESSION['msg_erro_senha'] = 'As senhas informadas não coincidem';
		header('Location: cadastrar-nova-senha.php?token='.$token_recupera);
		exit;
		
	}else{
		
	
		if(isset($_GET['ac']) && $_GET['ac'] == "nova"){
			
			
			$sql_ape = " 
			select
				apelido,
				email
			from
				tbl_usuario
			WHERE 
				token = '$token_recupera' and bloqueado = 'F' and situacao = 'CADASTRADO'
			";
			$qry_ape = mysql_query($sql_ape) or die('Erro:  '.$sql_ape);
			$reg_ape = mysql_fetch_array($qry_ape);
			
			$APELIDO = $reg_ape['apelido'];
			$EMAIL   = $reg_ape['email'];
			
			$EXISTE_TOKEN = mysql_num_rows($qry_ape);
		
			if($EXISTE_TOKEN > 0){
				
				$sql_ns = "		
				UPDATE tbl_usuario SET 
				senha = md5('$nova_senha'),		
				token = NULL,
				data_token = NULL		
				WHERE email = '$EMAIL' and bloqueado = 'F' and situacao = 'CADASTRADO'
				";
				$qry_ns = mysql_query($sql_ns) or die ("Erro 1: ".mysql_error());
				
				
				////////////////////////////////////////
				
				$assunto = "SENHA ALTERADA";	
							
					
				/* Medida preventiva para evitar que outros domínios sejam remetente da sua mensagem. */
				if (preg_match('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
						$emailsender='contato@cmgbskills.com.br'; // Substitua essa linha pelo seu e-mail@seudominio
				} else {
						$emailsender = "contato@cmgbskills.com.br";
						// Na linha acima estamos forçando que o remetente seja 'webmaster@seudominio',
						// você pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
				}
				 
				/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
				if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
				elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
				else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
						 
				/* Montando a mensagem a ser enviada no corpo do e-mail. */
				$mensagemHTML = '
				
				<div style="margin: 10px 200px;">
				
					<div style="margin-bottom: 20px; margin-top: 20px; border-bottom: 1px solid #e0e0e0; border-top: 3px solid #983153; padding-top: 15px; padding-bottom: 15px; text-align: center;"><img src="https://app.cmgbskills.com.br/imagens/cmgb_skills.png" height="90"></div>
				
					<div style="font-size:12px; color:#666; margin-bottom: 20px;">
					Olá, '.$APELIDO.',<br/><br/>
					
					Sua senha de login foi alterada. Se você acha que isso seja um erro, 
					entre em contato com o nossa equipe de suporte.
					
					<br/><br/>
					
					<b>WhatsApp:</b> (85) 99653-1189<br/>
					<b>Email:</b> gestao.ti@cmgb.com.br
					
					</div>
					
					Atenciosamente,<br/>
					<b>CMGB SKILLS</b>
				
				</div>
					
				
				';
				
				
				/* Montando o cabeçalho da mensagem */
				$headers = "MIME-Version: 1.1".$quebra_linha;
				$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
				// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
				$headers .= "From: CMGB SKILLS<contato@cmgbskills.com.br>";
				//$headers .= "Cc: ".$comcopia.$quebra_linha;
				//$headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
				//$headers .= "Reply-To: ".$emailsender.$quebra_linha;
				// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
				 
				/* Enviando a mensagem */
				//Verificando qual é o MTA que está instalado no servidor e efetuamos o ajuste colocando o paramentro -r caso seja Postfix
				
				if(!mail($EMAIL, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
					$headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
					mail($EMAIL, $assunto, $mensagemHTML, $headers );
					
				}
				
				
				
				////////////////////////////////////////
				
				
				$_SESSION['msg_altera_senha'] = 'Senha alterada com sucesso!';
				header('Location: login.php');
				exit;
			
			}else{
				
				$_SESSION['msg_sem_email'] = 'Senha não alterada. Solicite uma nova alteração de senha.';
				header('Location: login.php');
				exit;
				
			}
				
		}else{
					
			header('Location: login.php');
			exit;	
			
		}
		
	}
	
?>