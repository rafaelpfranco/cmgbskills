<?php
	
	session_start();
	
	if(isset($_SESSION['msg_novo_plano'])){
		$msg_novo_plano = $_SESSION['msg_novo_plano'];
		unset($_SESSION['msg_novo_plano']);
	}
	
	$sql_upla = " SELECT ID_PLANO, SITUACAO, DIA_VENCIMENTO, date_format(DATA_ADESAO, '%d/%m/%Y') as DATA_ADESAO FROM tbl_usuario_plano WHERE ID_USUARIO = '$Fun_Id' ORDER BY ID_USUARIO_PLANO DESC LIMIT 1 ";
	$qry_upla = mysql_query($sql_upla) or die ("Erro 02: ".mysql_error());
	$reg_upla = mysql_fetch_array($qry_upla);
	
	$UPLANO_ID_PLANO       = $reg_upla['ID_PLANO'];
	$UPLANO_SITUACAO       = $reg_upla['SITUACAO'];
	$UPLANO_DIA_VENCIMENTO = $reg_upla['DIA_VENCIMENTO'];
	$UPLANO_DATA_ADESAO    = $reg_upla['DATA_ADESAO'];
	
	$sql_pla = " SELECT ID_PLANO, NOME_PLANO, DESCRICAO, MSG_COBRANCA, LIMITE_APRENDENTE, PRECO FROM tbl_plano WHERE ID_PLANO = '$UPLANO_ID_PLANO' ";
	$qry_pla = mysql_query($sql_pla) or die ("Erro 02: ".mysql_error());
	$reg_pla = mysql_fetch_array($qry_pla);
	
	$PLANO_ID_PLANO          = $reg_pla['ID_PLANO'];
	$PLANO_NOME_PLANO        = $reg_pla['NOME_PLANO'];
	$PLANO_DESCRICAO         = $reg_pla['DESCRICAO'];
	$PLANO_MSG_COBRANCA      = $reg_pla['MSG_COBRANCA'];
	$PLANO_LIMITE_APRENDENTE = $reg_pla['LIMITE_APRENDENTE'];
	$PLANO_PRECO             = "R$ ".formata_valor($reg_pla['PRECO']);
	
	if($PLANO_ID_PLANO == "1" ){
		$PLANO_PRECO = "GRATUITO";
	}
		
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Plano Contratado</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Plano Contratado</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_novo_plano)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_novo_plano; ?>
	</div>
	<?php endif; ?>
   		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="row">		
				<div class="col-xs-12 col-md-12">
    				
    				<div class="card">
	          					
						<div class="card-header">
			            	<h3 class="card-title">PLANO CONTRATADO</h3>
			            </div>
			            
			            <div class="card-body" style="padding: 10px;">
			            	<div class="row" style="margin-bottom: 0; margin-top: 0;">		
								
								<div class="col-xs-12 col-md-3" style="text-align: center; padding: 10px;">							
									<div style="font-size: 12px; color: #888; margin-bottom: 10px;">Plano Contratado</div>
									<div style="font-size: 24px; color: #666;">
										<?php echo $PLANO_NOME_PLANO; ?>
									</div>			
								</div>
								
								<div class="col-xs-12 col-md-3" style="text-align: center; border-left: 1px solid #e0e0e0; padding: 10px;">							
									<div style="font-size: 12px; color: #888; margin-bottom: 10px;">Status</div>
									<div style="font-size: 24px; color: #666;">
										<?php echo $UPLANO_SITUACAO; ?>
									</div>			
								</div>
								
								<div class="col-xs-12 col-md-3" style="text-align: center; border-left: 1px solid #e0e0e0; padding: 10px;">							
									<div style="font-size: 12px; color: #888; margin-bottom: 10px;">Valor Mensalidade</div>
									<div style="font-size: 24px; color: #666;">
										<?php echo $PLANO_PRECO; ?>
									</div>			
								</div>
								
								<div class="col-xs-12 col-md-3" style="text-align: center; border-left: 1px solid #e0e0e0; padding: 10px;">							
									<div style="text-align: center; padding: 10px;">
										<a href="../../pages/administrativo/index.php?pg=alterar-plano" class="btn btn-primary btn-block">ALTERAR PLANO</a>
									</div>			
								</div>			
							</div>		            
			            </div>
			            
			     	</div>
    			
    			</div>
    		</div>
    		
    		<div class="row">		
				<div class="col-xs-12 col-md-4">
    				
    				<div class="card">
	          					
						<div class="card-header">
			            	<h3 class="card-title">FUNCIONALIDADES</h3>
			            </div>
			            
			            <div class="card-body" style="padding: 20px;">
					            				
							<?php
							
							$sql_dpla = " SELECT TIPO, DESCRICAO FROM tbl_plano_detalhe WHERE ID_PLANO = '$PLANO_ID_PLANO' ORDER BY ORDEM ASC ";
							$qry_dpla = mysql_query($sql_dpla) or die ("Erro 02: ".mysql_error());
							
							while($reg_dpla = mysql_fetch_array($qry_dpla)){
							
								$DET_TIPO      = $reg_dpla['TIPO'];
								$DET_DESCRICAO = $reg_dpla['DESCRICAO'];
								
								if($DET_TIPO == "DISPONIVEL"){
									$ICONE = "<i class='fas fa-check' style='font-size: 12px; color: #00cc99; margin-right: 5px;'></i>";
								}elseif($DET_TIPO == "LIMITADO"){
									$ICONE = "<i class='fas fa-exclamation-triangle' style='font-size: 12px; color: #ffcc00; margin-right: 5px;'></i>";
								}else{
									$ICONE = "<i class='fas fa-times' style='font-size: 14px; color: #ff0080; margin: 0 7px 0 3px;'></i>";
								}
								
								echo "<div class='row'>";											
									echo "<div class='col-xs-12 col-md-12' style='font-size: 12px; color: #666;'>";							
										echo "<div style='padding: 5px 0; border-bottom: 1px solid #e0e0e0; vertical-align: middle;'>".$ICONE." ".$DET_DESCRICAO."</div>";
									echo "</div>";
								echo "</div>";
								
							}
							
							?>
									            
			            </div>
			            
			     	</div>
    			
    			</div>
    			
    			<div class="col-xs-12 col-md-8">
    				
    				<div class="row">		
						<div class="col-xs-12 col-md-12">
							
							<div class="card">
	          					
								<div class="card-header">
					            	<h3 class="card-title">MAIS DETALHES</h3>
					            </div>
					            
					            <div class="card-body" style="padding: 20px;">
					            	
					            	<div class="row" style="margin-bottom: 0; margin-top: 0;">									
										<div class="col-xs-12 col-md-6">
											
											<div style="font-size: 16px; margin-bottom: 20px; background: #f4f4f4; padding: 20px;">
												Data de adesão: 
												<span style="background: #9999ff; margin-left: 10px; color: #fff; padding: 5px 20px; border-radius: 4px;"><?php echo $UPLANO_DATA_ADESAO; ?></span>
											</div>
											
										</div>
										
										<div class="col-xs-12 col-md-6">
											
											<div style="font-size: 16px; margin-bottom: 20px; background: #f4f4f4; padding: 20px;">
												Dia vencimento: 
												<span style="background: #9999ff; margin-left: 10px; color: #fff; padding: 5px 20px; border-radius: 4px;"><?php echo $UPLANO_DIA_VENCIMENTO; ?></span>
											</div>
											
										</div>
									</div>
									
									<div class="row" style="margin-bottom: 0; margin-top: 0;">									
										<div class="col-xs-12 col-md-12">
											
											<div style="font-size: 18px; margin-bottom: 2px; color: #444;"><?php echo $PLANO_DESCRICAO; ?></div>
											<div style="font-size: 16px; color: #777;"><?php echo $PLANO_MSG_COBRANCA; ?></div>
										
										</div>
										
									</div>
					            	
					            </div>
					            
					     	</div>
							
						</div>
					</div>
    				<!--
    				<div class="row">		
						<div class="col-xs-12 col-md-12">
							
							<div class="card">
	          					
								<div class="card-header">
					            	<h3 class="card-title">TERMOS DE USO E POLÍTICA DE PRIVACIDADE</h3>
					            </div>
					            
					            <div class="card-body" style="padding: 20px 10px;">
					            	
					            	<div class="row" style="margin-bottom: 0; margin-top: 0;">									
										<div class="col-xs-12 col-md-12">
											
											<div style="font-size: 14px;">Documento atualizado em </div>
											<div style="font-size: 14px;">Clique aqui para visualizar.</div>
										
										</div>
									</div>
									
					            </div>
					            
					     	</div>
							
						</div>
					</div>
					-->
    			
    			</div>
    		</div>
    			          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>