<?php
	
	session_start();
	
	/////////////
	$sql_fsa = " SELECT count(ID_APRENDENTE) as QTDE_APRENDENTE FROM tbl_aprendente WHERE ID_USUARIO = '$Fun_Id' AND SITUACAO = 'CADASTRADO' ";
	$qry_fsa = mysql_query($sql_fsa) or die ("Erro 01: ".mysql_error());
	$reg_fsa = mysql_fetch_array($qry_fsa);
	
	$existe_usuario  = mysql_num_rows($qry_fsa);
	
	$QTDE_APRENDENTE = $reg_fsa['QTDE_APRENDENTE'];
	
	///////////////	
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
            <h1 class="m-0 text-dark">Alterar Plano Contratado</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=plano-contratado">Plano Contratado</a></li>
              <li class="breadcrumb-item active">Alterar Plano Contratado</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
   		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="row">									
									
				<div class="col-xs-12 col-md-12">
					
					<?php if($QTDE_APRENDENTE >= $PLANO_LIMITE_APRENDENTE){ ?>
			            
		            <div style="color: #fff; background: #ff8080; padding: 10px 20px; border-radius: 4px; margin-bottom: 10px;">
						Prezado(a) <?php echo $Fun_Apelido; ?>,<br/>Você atingiu o limite de aprendentes para o plano contratado. Escolha abaixo a opção que se encaixa melhor para você e faça a alteração do seu plano.
					</div>
					
					<?php } ?>
					
					<div style="padding: 10px; border: 1px solid #e0e0e0; background: #fff; color: #666; margin-bottom: 10px; border-radius: 4px;">
						<span>
							<i class='fas fa-angle-right' style='font-size:12px'></i> Plano Contratado: <?php echo $PLANO_NOME_PLANO; ?>
						</span>
						<span style="margin-left: 40px;">
							<i class='fas fa-angle-right' style='font-size:12px'></i> Dia Vencimento: <?php echo $UPLANO_DIA_VENCIMENTO; ?>
						</span>
					</div>
		            
		       	</div>
			
			</div>
			
			<div class="row"> 
				
		        <!-- 1 -->    
		    	<div class="col-xs-12 col-md-3">
		    		
		    		<div class="card">
		    			<div class="card-header"  style="background: #a7b9be; border-top: none;">
			            	<h3 class="card-title" style=" color: #fff; font-size: 24px;">INICIANTE</h3>
			            </div>
			            
			            <div class="card-body">
			            	
			            	<div class="row">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 14px; color: #888; border-bottom: 1px solid #ccc; padding-bottom: 10px;">Para quem está começando agora e já quer se organizar</div>
								</div>
							</div>	
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 48px; color: #385a7b;">GRATUITO</div>
									<div style="font-size: 14px; color: #888;">sem cobrança e sem mensalidade durante a vigência do plano</div>
								</div>
							</div>
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">
									<a href="#alterar-plano" data-toggle="modal" onclick="alterarPlano(<?php echo $Fun_Id.",'1','PLANO INICIANTE','0.00','".$UPLANO_DIA_VENCIMENTO."'"; ?>)" class="btn-primary btn-block" style="font-size: 24px; padding: 5px; text-align: center;">CONTRATAR</a>
								</div>
							</div>
							
							<div class="row">											
								<div class="col-xs-12 col-md-12" style="font-size: 12px; color: #666;">							
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0; vertical-align: middle;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> até <span style="background: #385a7b; border-radius: 10px; padding: 3px 10px; color: #fff;">2</span> pacientes/aprendentes</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> anamnese completa</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> diário de sessão</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> avaliação</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> devolutiva</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> intervenção</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-exclamation-triangle' style="font-size: 12px; color: #ffcc00; margin-right: 5px;"></i> contrato LIMITADO</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-exclamation-triangle' style="font-size: 12px; color: #ffcc00; margin-right: 5px;"></i> agenda LIMITADA</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-exclamation-triangle' style="font-size: 12px; color: #ffcc00; margin-right: 5px;"></i> financeiro LIMITADO</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-times' style="font-size: 14px; color: #ff0080; margin: 0 7px 0 3px;"></i> suporte técnico</div>
								</div>
							</div>		
			            
			            </div>
			            
		    		</div>
		    		
		    	</div>
				
				<!-- 2 --> 
				<div class="col-xs-12 col-md-3">
		    		<div class="card">
		    			<div class="card-header"  style="background: #a7b9be; border-top: none;">
			            	<h3 class="card-title" style=" color: #fff; font-size: 24px;">BÁSICO</h3>
			            </div>
			            
			            <div class="card-body">
			            	
			            	<div class="row">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 14px; color: #888; border-bottom: 1px solid #ccc; padding-bottom: 10px;">Mais controle e organização para quem já está atendendo</div>
								</div>
							</div>	
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 48px; color: #385a7b;"><span style="color: #999; font-size: 18px;">R$</span> 19,90 <span style="color: #999; font-size: 18px;">/mês</span></div>
									<div style="font-size: 14px; color: #888;">cobrado mensalmente no boleto ou cartão de crédito</div>
								</div>
							</div>
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">
									<a href="#alterar-plano" data-toggle="modal" onclick="alterarPlano(<?php echo $Fun_Id.",'2','PLANO BASICO','19.90','".$UPLANO_DIA_VENCIMENTO."'"; ?>)" class="btn-primary btn-block" style="font-size: 24px; padding: 5px; text-align: center;">CONTRATAR</a>
								</div>
							</div>
							
							<div class="row">											
								<div class="col-xs-12 col-md-12" style="font-size: 12px; color: #666;">							
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0; vertical-align: middle;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> até <span style="background: #385a7b; border-radius: 10px; padding: 3px 8px; color: #fff;">10</span> pacientes/aprendentes</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> anamnese completa</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> diário de sessão</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> avaliação</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> devolutiva</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> intervenção</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> contrato</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> agenda</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> financeiro</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 14px; color: #00cc99; margin-right: 5px;"></i> suporte técnico</div>
								</div>
							</div>
			            
			            </div>
			            
		    		</div>
		    	</div>
		    	
		    	<!-- 3 --> 
		    	<div class="col-xs-12 col-md-3">
		    		<div class="card">
		    			<div class="card-header"  style="background: #ffcc00; border-top: none;">
			            	<h3 class="card-title" style="color: #fff; font-size: 24px;">PROFISSIONAL</h3>
			            </div>
			            
			            <div class="card-body">
			            	
			            	<div class="row">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 14px; color: #888; border-bottom: 1px solid #ccc; padding-bottom: 10px;">Melhor opção para quem quer crescer e precisa melhorar a gestão</div>
								</div>
							</div>	
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 48px; color: #385a7b;"><span style="color: #999; font-size: 18px;">R$</span> 39,90 <span style="color: #999; font-size: 18px;">/mês</span></div>
									<div style="font-size: 14px; color: #888;">cobrado mensalmente no boleto ou cartão de crédito</div>
								</div>
							</div>
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">
									<a href="#alterar-plano" data-toggle="modal" onclick="alterarPlano(<?php echo $Fun_Id.",'3','PLANO PROFISSIONAL','39.90','".$UPLANO_DIA_VENCIMENTO."'"; ?>)" class="btn-warning btn-block" style="font-size: 24px; padding: 5px; text-align: center;">CONTRATAR</a>
								</div>
							</div>
							
							<div class="row">											
								<div class="col-xs-12 col-md-12" style="font-size: 12px; color: #666;">							
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0; vertical-align: middle;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> até <span style="background: #385a7b; border-radius: 10px; padding: 3px 8px; color: #fff;">20</span> pacientes/aprendentes</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> anamnese completa</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> diário de sessão</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> avaliação</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> devolutiva</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> intervenção</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> contrato</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> agenda</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> financeiro</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 14px; color: #00cc99; margin-right: 5px;"></i> suporte técnico</div>
								</div>
							</div>
			            
			            </div>
			            
		    		</div>
		    	</div>
		    	
		    	<!-- 4 --> 
		    	<div class="col-xs-12 col-md-3">
		    		<div class="card">
		    			<div class="card-header"  style="background: #a7b9be; border-top: none;">
			            	<h3 class="card-title" style=" color: #fff; font-size: 24px;">PREMIUM</h3>
			            </div>
			            
			            <div class="card-body">
			            	
			            	<div class="row">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 14px; color: #888; border-bottom: 1px solid #ccc; padding-bottom: 10px;">Para quem precisa de agilidade, controle e gestão com qualidade</div>
								</div>
							</div>	
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">							
									<div style="font-size: 48px; color: #385a7b;"><span style="color: #999; font-size: 18px;">R$</span> 59,90 <span style="color: #999; font-size: 18px;">/mês</span></div>
									<div style="font-size: 14px; color: #888;">cobrado mensalmente no boleto ou cartão de crédito</div>
								</div>
							</div>
							
							<div class="row" style="margin-bottom: 17px;">											
								<div class="col-xs-12 col-md-12">
									<a href="#alterar-plano" data-toggle="modal" onclick="alterarPlano(<?php echo $Fun_Id.",'4','PLANO PREMIUM','59.90','".$UPLANO_DIA_VENCIMENTO."'"; ?>)" class="btn-primary btn-block" style="font-size: 24px; padding: 5px; text-align: center;">CONTRATAR</a>
								</div>
							</div>
							
							<div class="row">											
								<div class="col-xs-12 col-md-12" style="font-size: 12px; color: #666;">							
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0; vertical-align: middle;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> até <span style="background: #385a7b; border-radius: 10px; padding: 3px 8px; color: #fff;">50</span> pacientes/aprendentes</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> anamnese completa</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> diário de sessão</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> avaliação</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> devolutiva</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> intervenção</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> contrato</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> agenda</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 12px; color: #00cc99; margin-right: 5px;"></i> financeiro</div>
									<div style="padding: 5px 0; border-bottom: 1px solid #e0e0e0;"><i class='fas fa-check' style="font-size: 14px; color: #00cc99; margin-right: 5px;"></i> suporte técnico</div>
								</div>
							</div>
			            
			            </div>
			            
		    		</div>
		    	</div>        
				
			</div>
			
			
			<!-- CONFIRMA ALTERACAO -->
			
			<div class="modal fade" id="alterar-plano">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header" style="background: #9999ff; color: #fff;">
	              			<h4 class="modal-title">ALTERAR PLANO</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id="LancamentoForm" method="post" role="form" action="alterar-plano-process.php?ac=cadastrar" enctype="multipart/form-data">

							<input type="hidden" id="modal_id_usuario" name="modal_id_usuario" />
							<input type="hidden" id="modal_id_plano" name="modal_id_plano" />
							<input type="hidden" id="modal_valor_plano" name="modal_valor_plano" />
							<input type="hidden" id="modal_dia_vencimento" name="modal_dia_vencimento" />
								
			            	<div class="modal-body">
			            		
			            		<p style="margin-bottom: 10px; font-size: 16px;">Deseja realmente confirmar a alteração do plano contratado?</p>
			            		
			            		<div class="row">
									<div class="col-xs-12 col-md-8">
										<label for="modal_documento">Plano selecionado</label> 										
										<div class="form-group">
											<input type="text" class="form-control" id="modal_nome_plano" name="modal_nome_plano" style="border: none;" readonly />
									  	</div>									  	
									</div>
			              		
									<div class="col-xs-12 col-md-4">
										<label for="modal_nome">Valor mensal (R$)</label> 										
										<div class="form-group">
											<input type="text" class="form-control" id="modal_valor_mensal" name="modal_valor_mensal" style="border: none; text-align: right;" readonly />
									  	</div>									  	
									</div>
			              		</div>
			              		
			            	</div>
			            	<div class="modal-footer justify-content-between">
			              		<button type="button" class="btn btn-default" data-dismiss="modal">SAIR</button>
			              		<button type="submit" class="btn btn-primary">CONFIRMAR</a>
			            	</div>
			            	
			            </form>
			            
	          		</div>
	          		<!-- /.modal-content -->
	        	</div>
	        <!-- /.modal-dialog -->
	      	</div>
	      	
	      	<script type="text/javascript">
				function alterarPlano (idUsuario,idPLano,nomePlano,valorPlano,diaVencimento){
				    				    
				    var modal_id_usuario = idUsuario;
					$("#modal_id_usuario").val(modal_id_usuario);
					
					var modal_id_plano = idPLano;
					$("#modal_id_plano").val(modal_id_plano);
					
					var modal_nome_plano = nomePlano;
					$("#modal_nome_plano").val(modal_nome_plano);
					
					var modal_valor_plano = valorPlano;
					$("#modal_valor_plano").val(modal_valor_plano);
					$("#modal_valor_mensal").val(modal_valor_plano);
					
					var modal_dia_vencimento = diaVencimento;
					$("#modal_dia_vencimento").val(modal_dia_vencimento);
					
				}
			</script>
			
			<!-- FIM CONFIRMA ALTERACAO -->
			  	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>