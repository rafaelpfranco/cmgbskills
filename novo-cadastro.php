<?php
	include("inc/mascaras.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GESTOR PSICOPEDAGOGIA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <link rel="stylesheet" href="css/estilo-sistema.css">
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<!--
  	<div class="login-logo">
		<div style="font-size: 36px; margin-bottom: 0px;"><img src="imagens/logomarca.png" height="70" /></div>
    	<div style="font-size: 24px; line-height: 18px; margin-bottom: 20px;">Sistema de gestão para consultório psicopedagógico</div>
      	<div style="font-size: 16px; line-height: 12px; margin-bottom: 20px;">	
      		Trabalhe de forma organizada. Controle do fluxo de atendimento do aprendente, agenda e financeiro em um só lugar.
      	</div>
  	</div>
  	-->
  	<div class="login-logo">
		<div style="font-size: 36px; margin-bottom: 0px;"><img src="imagens/logomarca.png" height="70" /></div>
  	</div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!--
      <div style="text-align: center;">
      	<i class="fas fa-user" style="font-size: 24px;"></i>
  	  </div>
	  -->	
	        
      <div style="font-size: 18px; margin-bottom: 5px; text-align: center; color: #666;"><b>Novo Cadastro</b></div>
      
      <div style="font-size: 13px; line-height: 16px; text-align: justify; margin-bottom: 20px;">
      	Preencha os dados abaixo e comece a utilizar agora mesmo o sistema GESTOR PSICOPEDAGOGIA.
      </div>
          		        
  		<form id="defaultForm" method="post" class="form-horizontal" action="novo-cadastro-process.php?ac=cadastrar">
  			
			<div class="row">	
				<div class="input-group mb-3" style="margin: 0px 7px 5px 7px;">
		          <input type="text" class="form-control input-lg" placeholder="Cpf" name="cpf" required onKeyUp="numcpf(this);" maxlength="14" />
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="far fa-id-card"></span>
		            </div>
		          </div>
		        </div>	
		    </div>
			
			<div class="row">	
				<div class="input-group mb-3" style="margin: 0px 7px 5px 7px;">
		          <input type="text" class="form-control input-lg" placeholder="Nome" name="nome" required />
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-user-alt"></span>
		            </div>
		          </div>
		        </div>	
		    </div>
			
			<div class="row">
				<div class="input-group mb-3" style="margin: 0px 7px 5px 7px;">
		          <input type="email" class="form-control input-lg" placeholder="Email" name="email" required />
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-at"></span>
		            </div>
		          </div>
		        </div>	
			</div>
			
			<div class="row">
				<div class="input-group mb-3" style="margin: 0px 7px 5px 7px;">
		          <input type="text" class="form-control input-lg" placeholder="Telefone" name="telefone" required onKeyUp="mtel(this);" maxlength="14" style="text-align: left;" />
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-mobile-alt"></span>
		            </div>
		          </div>
		        </div>	
			</div>
			
			<div class="row">
				<div class="input-group mb-3" style="margin: 0px 7px 5px 7px;">
		          <input type="password" class="form-control input-lg" placeholder="Senha" name="senha" required style="text-align: left;" />
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-key"></span>
		            </div>
		          </div>
		        </div>	
			</div>
			
			<div class="row" style="margin: 0 15px 15px 15px;">									
				<div class="col-xs-12 col-md-12">
					<input type="checkbox" class="form-check-input" checked="checked" id="exampleCheck1" name="termos_de_uso" value="CIENTE"  style="margin-top: 3px;" required >
                	<label class="form-check-label" for="exampleCheck1">Estou ciente dos <a href="documentos/termo-de-uso.pdf" target="_blank" class="text-center">Termos de Uso</a></label>
				</div>
			</div>
              				
            <div class="form-group">
                <div class="col-lg-12" style="text-align: center; padding: 0;">
                    <input type="submit" name="enviar" class="btn btn-primary btn-lg btn-block" value="AVANÇAR"  style="margin-bottom: 20px;">
                </div>
            </div>
            
    	</form>

	    <p class="mb-0" style="text-align: center; font-size: 14px;">
	        <a href="login.php" class="text-center">Já tenho uma conta</a>
	    </p>
	    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>