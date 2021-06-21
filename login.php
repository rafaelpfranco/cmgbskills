<?php
	
	session_start();
	
	if(isset($_SESSION['error'])){
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }
	
	if(isset($_SESSION['msg_altera_senha'])){
		$msg_altera_senha = $_SESSION['msg_altera_senha'];
		unset($_SESSION['msg_altera_senha']);
	}
	
	if(isset($_SESSION['msg_sem_email'])){
		$msg_sem_email = $_SESSION['msg_sem_email'];
		unset($_SESSION['msg_sem_email']);
	}
	
	if(isset($_SESSION['msg_novo_cadastro'])){
		$msg_novo_cadastro = $_SESSION['msg_novo_cadastro'];
		unset($_SESSION['msg_novo_cadastro']);
	}
	
	if(isset($_SESSION['msg_existe_cadastro'])){
		$msg_existe_cadastro = $_SESSION['msg_existe_cadastro'];
		unset($_SESSION['msg_existe_cadastro']);
	}
	
	require_once("inc_dbConexao.php");       
    require_once("inc/valida.class.php");
    
    if(isset($_GET['ac']) && $_GET['ac'] == "logar"){
    					
		//if($_SESSION['session_textoCaptcha'] == $_POST['captcha']){
		
			$login = $_POST['LOGIN'];
			
			$sql_l = " SELECT * FROM tbl_usuario WHERE login = '$login' ";
			$qry_l = mysql_query($sql_l) or die ("Erro ao identificar usuario: ".mysql_error());
			$reg_l = mysql_fetch_array($qry_l);
			
			if($reg_l['bloqueado'] == 'F'){
				
				$login = new validar();
					
				$login->Conexao("tbl_usuario", "login", "senha");             
				$login->Inputs($_POST['LOGIN'], md5($_POST['SENHA']));          
				$login->Redirecionamento("index.php", "login.php");  
				$login->Logar();
				
				$IdFuncionario = $reg_l['id_usuario'];
								
				if(!isset($_SESSION['error'])){
					$sql_log = "INSERT INTO tbl_log VALUES(null, now(), '$IdFuncionario')";
					$qry_log = mysql_query($sql_log) or die ("Erro ao cadastrar log: ".mysql_error());
				}
				
			}else{
				
				if($reg_l['login'] != ""){
				
					if($reg_l['bloqueado'] == 'F'){			
						$_SESSION['error'] = 'O usuario e/ou senha incorretos. Tente novamente!';
						header('Location: login.php');
						exit;
					}
					
					if($reg_l['bloqueado'] == 'T'){
						$_SESSION['error'] = 'Acesso não permitido. Entre em contato conosco.';
						header('Location: login.php');
						exit;	
					}
				
				}else{
					
					$_SESSION['error'] = 'Você não possui acesso ao sistema.';
					header('Location: login.php');
					exit;	
					
				}
				
			}
				
		//}else{
		
		//	$_SESSION['error'] = 'Código digitado errado. Tente novamente.';
		//	header('Location: login.php');
		//	exit;
					
		//}
		
	}
	
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CMGB CONSULTORIA E TREINAMENTO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <link rel="stylesheet" href="css/estilo-sistema.css">
  
  
  
  <!--===============================================================================================-->	
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
  
  
</head>


<div class="limiter">
		<div class="container-login100">
			
			

			<div class="wrap-login100 p-l-50 p-r-50 p-t-50 p-b-50">
				
				<span class="login100-form-title p-b-20">
					<img src="imagens/cmgb_skills.png" height="100" />
				</span>
				
				<div style="font-size: 20px; margin-bottom: 15px; text-align: left; color: #476b6b;"><strong>Informe seus dados abaixo</strong></div>
       				
				<?php if(isset($error) && $error != ''): ?>
		        <div style="color:#666; font-size:12px; border:1px solid #ffd2d2; border-radius: 4px; background:#ffefef; padding: 10px; margin: 0 0 15px 0;">
		        <?php echo $error; ?>
		        </div>
		        <?php endif; ?>
		        
		        <?php if(isset($msg_altera_senha)): ?>
				<div class="alert alert-dismissable alert-success" style="margin: 0 0 20px 0;">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <?php echo $msg_altera_senha; ?>
				</div>
				<?php endif; ?>
				
				<?php if(isset($msg_sem_email)): ?>
				<div class="alert alert-dismissable alert-danger" style="margin: 0 0 20px 0;">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <?php echo $msg_sem_email; ?>
				</div>
				<?php endif; ?>
				
				<?php if(isset($msg_novo_cadastro)): ?>
				<div class="alert alert-dismissable alert-success" style="margin: 0 0 20px 0;">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <?php echo $msg_novo_cadastro; ?>
				</div>
				<?php endif; ?>
				
				<?php if(isset($msg_existe_cadastro)): ?>
				<div class="alert alert-dismissable alert-danger" style="margin: 0 0 20px 0;">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <?php echo $msg_existe_cadastro; ?>
				</div>
				<?php endif; ?>
				
				
				<form id="defaultForm" method="post" class="form-horizontal" action="login.php?ac=logar">
            		
            		<div class="row">            			
			            <div class="col-xs-12 col-md-12">
			            	<div class="form-group">
								<label>Email <span style="color: #ff8080;">*</span></label><br/>
				          		<input type="email" class="form-control input-lg" required name="LOGIN" style="border: 1px solid #e0e0e0 !important;">
						  	</div>		            	
				        </div>				    
				    </div>
			        
			        <div class="row"> 
				        <div class="col-xs-12 col-md-12">
				        	<div class="form-group">
								<label>Senha <span style="color: #ff8080;">*</span></label><br/>
				          		<input type="password" class="form-control input-lg" required name="SENHA" style="border: 1px solid #e0e0e0 !important;">
						  	</div>
				        </div>
			        </div>
			        
			        <div class="row"> 
				        <div class="col-xs-12 col-md-12" style="margin-bottom: 15px;">
				        	<p class="mb-1" style="float: left; font-size: 14px;">
					        	<a href="esqueci-a-senha.php" class="alink">Esqueci a senha</a>
						    </p>
				        </div>
			        </div>
			        
			        <div class="row"> 
				        <div class="col-xs-12 col-md-12">		           					
				            <div class="form-group">
				                <div class="col-lg-12" style="text-align: center; padding: 0;">
				                    <input type="submit" name="enviar" class="btn btn-primary btn-lg btn-block" value="ENTRAR"  style="margin-bottom: 20px;">
				                </div>
				            </div>
				  		</div>
				  	</div>
		            
		    	</form>
				
				
							    
			</div>
			
			<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
				
				
				
			</div>
			
		</div>
	</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>


<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>