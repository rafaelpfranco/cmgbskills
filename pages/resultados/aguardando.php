<?php
	
	session_start();
	
	if(isset($_SESSION['msg_autoriza_teste'])){
		$msg_autoriza_teste = $_SESSION['msg_autoriza_teste'];
		unset($_SESSION['msg_autoriza_teste']);
	}
	
	
	if(isset($_SESSION['msg_exclui_teste'])){
		$msg_exclui_teste = $_SESSION['msg_exclui_teste'];
		unset($_SESSION['msg_exclui_teste']);
	}
		
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Aguardando Autorização</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Aguardando Autorização</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_autoriza_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_autoriza_teste; ?>
	</div>
	<?php endif; ?>
		
	
	<?php if(isset($msg_exclui_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_exclui_teste; ?>
	</div>
	<?php endif; ?>
			
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		    		
          	<!-- LISTA DE INGREDIENTES CADASTRADOS -->
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title">LISTA DE TESTES AGUARDANDO AUTORIZAÇÃO</h3>
			            </div>
				            
			            <div class="card-body">
			            
			            	<table id="example1" style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
								    <tr id="title_table">
							            <th width="10%" style="text-align: center !important;"><strong>DATA</strong></th>	
							            <th width="15%" style="text-align: center !important;"><strong>CPF</strong></th>
							            <th width="69%" style="text-align: center !important;"><strong>NOME</strong></th>	
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							        </tr>
						        </thead>
						        
						        <?php
						        
						        $sql_lis_con = "
						        select									
									tbl_candidato_teste.id_candidato_teste, 
									tbl_candidato_teste.id_candidato, 
									date_format(tbl_candidato_teste.data_contratado, '%d/%m/%Y') as data_contratado, 
									
									tbl_candidato.cpf, 
									tbl_candidato.nome 
									
								from
									tbl_candidato_teste
									
									left join tbl_candidato 
									on tbl_candidato_teste.id_candidato = tbl_candidato.id_candidato 
																									
								where
									tbl_candidato_teste.situacao = 'AGUARDANDO' and 
									tbl_candidato_teste.situacao_teste = 'CADASTRADO' 
																	        					
								";
							    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
							    					    
								echo "<tbody>";
								
									while($reg_lis_con = mysql_fetch_array($qry_lis_con)){
							
										$id_candidato_teste = $reg_lis_con['id_candidato_teste'];
										$id_candidato		= $reg_lis_con['id_candidato'];
										$data_contratado  	= $reg_lis_con['data_contratado'];
										
										$cpf  	= $reg_lis_con['cpf'];
										$nome  	= $reg_lis_con['nome'];
										
										$nome_candidato = $cpf." ".$nome;
																																																	
										echo "<tr style='font-size: 14px;'>";
									
											echo "<td align='center'>".$data_contratado."</td>";
											echo "<td align='center'>".$cpf."</td>";
											echo "<td align='left'>".$nome."</td>";
																				
											echo "<td align='center'>";											
												echo "<a href='index.php?pg=autorizar-teste&id=".$id_candidato_teste."'><i class='far fa-check-circle'></i></a>";
											echo "</td>";
											
											echo "<td align='center'>";
												echo "<a href='#deletar-teste' data-toggle='modal' onclick='deletaTeste(".$id_candidato_teste.",\"".$nome_candidato."\")' class='deletar'><i class='fas fa-times-circle' style='color: #dc4d40;'></i></a>";
											echo "</td>";
										
										echo "</tr>";
																		
									}
									
								echo "</tbody>";
								
								?>
						        
							</table>
			            
			            </div>
			            
			            <div class="card-body" style="font-size: 12px; border-top: 1px solid #ccc; text-align: right;">
			            	
			            	<i class='far fa-check-circle' style="font-size: 12px; margin-left: 10px;"></i> autorizar 
			            	<i class='fas fa-times-circle' style="font-size: 12px; margin-left: 10px; color: #dc4d40;"></i> excluir
			            	
			            </div>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	<div class="modal fade" id="deletar-teste">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-agenda">
	              			<h4 class="modal-title">EXCLUIR TESTE</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='excluir-teste-process.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_exclui_id_teste" name="modal_exclui_id_teste">
	            			
			            	<div class="modal-body">
			            		
			            		<div class="row">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										<label for="modal_motivo">Teste</label> 
										<input class="form-control" id="modal_exclui_teste" name="modal_exclui_teste" readonly>
			              			</div>
			              		</div>
			              					              		
			            	</div>
			            	<div class="modal-footer justify-content-between">
			              		<button type="button" class="btn btn-default" data-dismiss="modal">SAIR</button>
			              		<button type="submit" class="btn btn-primary">EXCLUIR</a>
			            	</div>
			            	
			            </form>
			            
	          		</div>
	          		<!-- /.modal-content -->
	        	</div>
	        <!-- /.modal-dialog -->
	      	</div>
	      	
	      	<script type="text/javascript">
				function deletaTeste (idTeste,teste){
				    //seta o caminho para quando clicar em "Apagar".
				    //var href = 'excluir-contrato.php?id=' + idDado + '&ac=excluir';
				    //var href = $('#confirmaDelecao')[0].baseURI + '/deletar/' + idDado;
				    
				    //adiciona atributo de delecao ao link
				    //$('#confirmaDelecao').prop("href", href);
				    
				    var modal_id_teste = idTeste;
					$("#modal_exclui_id_teste").val(modal_id_teste);
					
				    var modal_teste = teste;
					$("#modal_exclui_teste").val(modal_teste);
										
				}
			</script>
          	
          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>