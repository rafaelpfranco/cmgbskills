<?php
	
	session_start();
	
	if(isset($_SESSION['msg_edita_dados'])){
		$msg_edita_dados = $_SESSION['msg_edita_dados'];
		unset($_SESSION['msg_edita_dados']);
	}
	
	if(isset($_SESSION['msg_edita_senha'])){
		$msg_edita_senha = $_SESSION['msg_edita_senha'];
		unset($_SESSION['msg_edita_senha']);
	}
	
	if(isset($_SESSION['msg_edita_senha_erro'])){
		$msg_edita_senha_erro = $_SESSION['msg_edita_senha_erro'];
		unset($_SESSION['msg_edita_senha_erro']);
	}
	
	
	$sql_passo_1 = " 
	SELECT 
		id_usuario,
		cpf,
		nome,
				
		email,
		telefone_1,
		telefone_2,
		apelido,
		aniversario,
		login
	
	from 
		tbl_usuario
	
	WHERE 
		id_usuario = '$Fun_Id' and
		situacao = 'CADASTRADO'
	
	";
	$qry_passo_1 = mysql_query($sql_passo_1) or die ("Erro 1: ".mysql_error());
	$reg_passo_1 = mysql_fetch_array($qry_passo_1);
	
	$ID_USUARIO		= $reg_passo_1['id_usuario'];
	$CPF			= $reg_passo_1['cpf'];
	$NOME			= $reg_passo_1['nome'];
	
	$EMAIL			= $reg_passo_1['email'];
	$TELEFONE_1		= $reg_passo_1['telefone_1'];
	$TELEFONE_2		= $reg_passo_1['telefone_2'];
	$APELIDO		= $reg_passo_1['apelido'];
	$ANIVERSARIO	= $reg_passo_1['aniversario'];
	$LOGIN       	= $reg_passo_1['login'];
	
	
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Meus Dados</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Meus Dados</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
   	<?php if(isset($msg_edita_dados)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edita_dados; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_edita_senha)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edita_senha; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_edita_senha_erro)): ?>
	<div class="alert alert-dismissable alert-danger">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edita_senha_erro; ?>
	</div>
	<?php endif; ?>
		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="row">									
									
				<div class="col-xs-12 col-md-12">
					
					<div class="card">
	          					
						<div class="card-header">
			            	<h3 class="card-title">MEUS DADOS</h3>
			            	<div class="card-tools">
			            		<div style="float: left; color: #666; margin-right: 20px;">selecione a opção: </div>
			            		<ul class="nav nav-pills ml-auto">
				                    <li class="nav-item">
				                      <a class="nav-link active menu-card" href="#form-anamnese" data-toggle="tab">Dados Pessoais</a>
				                    </li>
				                    <li class="nav-item">
				                      <a class="nav-link menu-card" href="#form-sessao" data-toggle="tab">Dados de Acesso</a>
				                    </li>
			                  	</ul>
			                </div>
			                
			            </div>
				                
			            <div class="card-body">
			            	
			            	<div class="tab-content p-0">
			            		
				            	<div class="chart tab-pane active" id="form-anamnese" style="position: relative;">
			                    	<?php include("dados-pessoais.php"); ?>  	                        
			                   	</div>
			                  
			                  	<div class="chart tab-pane" id="form-sessao" style="position: relative;">
			                    	<?php include("dados-de-acesso.php"); ?> 	                        
			                  	</div>
			                  	
			            	</div>  
			            	
			            </div>
				            		            
			    	</div>
				
				</div>
				
			</div>
			  	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>