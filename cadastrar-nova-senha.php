<?php
	
	session_start();
	
	if(isset($_SESSION['msg_erro_senha'])){
		$msg_erro_senha = $_SESSION['msg_erro_senha'];
		unset($_SESSION['msg_erro_senha']);
	}
	
	require_once("inc_dbConexao.php");       
    require_once("inc/valida.class.php");
		
	$TOKEN = $_GET['token'];
	
	$sql_lis_con = "
    select									
		token
		
	from
		tbl_usuario
											
	where
		token = '$TOKEN' and
		data_token IS NOT null and
		situacao = 'CADASTRADO'
										        					
	";
    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
    $reg_lis_con = mysql_fetch_array($qry_lis_con);

	$VERTOKEN = $reg_lis_con['token'];
    	
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
				
				<?php if($VERTOKEN != ""){ ?>
					
					
					<div style="font-size: 20px; margin-bottom: 1px; text-align: left; color: #476b6b;"><strong>Recuperar senha</strong></div>
       			
       				<div style="font-size: 14px; margin-bottom: 15px; text-align: left; color: #476b6b;">Preencha os campos abaixo para cadastrar uma nova senha no sistema.</div>
				
					<?php if(isset($msg_nova_senha)): ?>
					<div class="alert alert-dismissable alert-success" style="margin: 0 0 20px 0;">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <?php echo $msg_nova_senha; ?>
					</div>
					<?php endif; ?>
					
					<?php if(isset($msg_sem_email)): ?>
					<div class="alert alert-dismissable alert-danger" style="margin: 0 0 20px 0;">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <?php echo $msg_sem_email; ?>
					</div>
					<?php endif; ?>
					
					<form id="defaultForm" method="post" class="form-horizontal" action="cadastrar-nova-senha-process.php?ac=nova">
				
						<input type="hidden" class="form-control" name="token_recupera" value="<?php echo $VERTOKEN; ?>" >
	            		
	            		<div class="row">            			
				            <div class="col-xs-12 col-md-12">
				            	<div class="form-group">
									<label>Nova Senha <span style="color: #ff8080;">*</span></label><br/>
					          		<input type="password" class="form-control input-lg" name="nova_senha" required style="border: 1px solid #e0e0e0 !important;" />
					          	</div>		            	
					        </div>				    
					    </div>
					    
					    <div class="row">            			
				            <div class="col-xs-12 col-md-12">
				            	<div class="form-group">
									<label>Confirma Nova Senha <span style="color: #ff8080;">*</span></label><br/>
					          		<input type="password" class="form-control input-lg" name="confirma_nova_senha" required style="border: 1px solid #e0e0e0 !important;" />
					          	</div>		            	
					        </div>				    
					    </div>
				        
				        <div class="row" style="margin-top: 10px;"> 
					        <div class="col-xs-12 col-md-12">		           					
					            <div class="form-group">
					                <div class="col-lg-12" style="text-align: center; padding: 0;">
					                    <input type="submit" name="enviar" class="btn btn-primary btn-block" value="CADASTRAR"  style="margin-bottom: 20px;">
					                </div>
					            </div>
					  		</div>
					  	</div>
			            
			    	</form>
		    	
				<?php }else{ ?>
    	
			    	<div style="font-size: 14px; text-align: center; line-height: 18px; margin-bottom: 20px;">
			      		Solicitação expirada.
			      	</div>
			    	    	
			    	<p class="mb-0" style="text-align: center; font-size: 14px;">
				        <a href="login.php" name="enviar" class="btn btn-default btn-block"  style="margin-bottom: 20px;">Cancelar</a>
				    </p>
			    
			    <?php } ?>
							    
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