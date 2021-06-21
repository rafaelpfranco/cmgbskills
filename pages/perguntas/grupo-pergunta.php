<?php
	
	session_start();
	
	if(isset($_SESSION['msg_edit_bloq_grupo'])){
		$msg_edit_bloq_grupo = $_SESSION['msg_edit_bloq_grupo'];
		unset($_SESSION['msg_edit_bloq_grupo']);
	}
	
	if(isset($_SESSION['msg_edit_grupo'])){
		$msg_edit_grupo = $_SESSION['msg_edit_grupo'];
		unset($_SESSION['msg_edit_grupo']);
	}
	
	if(isset($_SESSION['msg_exc_grupo'])){
		$msg_exc_grupo = $_SESSION['msg_exc_grupo'];
		unset($_SESSION['msg_exc_grupo']);
	}
	
	if(isset($_SESSION['msg_novo_grupo'])){
		$msg_novo_grupo = $_SESSION['msg_novo_grupo'];
		unset($_SESSION['msg_novo_grupo']);
	}
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Grupo Pergunta</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=perguntas">Perguntas</a></li>
              <li class="breadcrumb-item active">Grupo Pergunta</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_edit_bloq_grupo)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edit_bloq_grupo; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_edit_grupo)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edit_grupo; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_exc_grupo)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_exc_grupo; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_novo_grupo)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_novo_grupo; ?>
	</div>
	<?php endif; ?>
    		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		    		
          	<!-- LISTA DE INGREDIENTES CADASTRADOS -->
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<form id='LancamentoForm' method='post' role='form' action='novo-grupo-process.php?ac=incluir' enctype='multipart/form-data'>
          			
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
						
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">NOVO GRUPO</h3>
				            </div>
				                
				            <div class="card-body">
				            	
				            	<div class="row">									
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="nome_grupo">Grupo<span style="color: #f08080;">*</span></label> 
											<input type="text" class="form-control" required id="nome_grupo" name="nome_grupo" />
									  	</div>
									</div>																							
							    </div>
					  			
							    <div class="row">
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="descricao_grupo">Descrição</label>
											<textarea type="text" rows="3" class="form-control" id="descricao_grupo" name="descricao_grupo" ></textarea>
									  	</div>									  	
									</div>						
								</div>
							    
				            </div>
				            
				            <div class="card-footer" style="text-align: center;">
	                  			<button type="submit" class="btn-primary">CADASTRAR</button>
	                		</div>
				            					        	          				
	          			</div>
	          			
          			</form>
          			
          		</div>
          	</div>
          	
          	<!-- LISTA GRUPO -->
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title">LISTA DE GRUPOS CADASTRADOS</h3>
			            </div>
				            
			            <div class="card-body">
			            
			            	<table id="example1" style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
								    <tr id="title_table">
							            <th width="5%" style="text-align: center !important;"><strong>CÓDIGO</strong></th>
							            <th width="86%" style="text-align: center !important;"><strong>GRUPO</strong></th>	
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>	
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							        </tr>
						        </thead>
						        <?php
						        
						        $sql_lis_con = "
						        select	
						        	tbl_grupo_pergunta.id_grupo_pergunta, 								
									tbl_grupo_pergunta.grupo_pergunta, 
									tbl_grupo_pergunta.descricao, 
									tbl_grupo_pergunta.bloqueado 
									
								from
									tbl_grupo_pergunta
																
								where
									tbl_grupo_pergunta.SITUACAO = 'CADASTRADO'
																	        					
								";
							    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
							    					    
								echo "<tbody>";
								
									while($reg_lis_con = mysql_fetch_array($qry_lis_con)){
							
										$grp_id_grupo_pergunta = $reg_lis_con['id_grupo_pergunta'];
										$grp_grupo_pergunta	   = $reg_lis_con['grupo_pergunta'];
										$grp_descricao         = $reg_lis_con['descricao'];
										$grp_bloqueado         = $reg_lis_con['bloqueado'];
																																																		
										echo "<tr style='font-size: 14px;'>";
									
											echo "<td align='center'>".str_pad($grp_id_grupo_pergunta, 5, "0", STR_PAD_LEFT)."</td>";
											echo "<td align='left'>".$grp_grupo_pergunta."</td>";
											
											echo "<td align='center'>";
											
												if($grp_bloqueado == "F"){
													echo "<a href='altera_bloqueio_grupo_pergunta.php?id=".$grp_id_grupo_pergunta."&blq=T&ac=alterar'><i class='fas fa-lock-open'></i></a>";
												}elseif($grp_bloqueado == "T"){
													echo "<a href='altera_bloqueio_grupo_pergunta.php?id=".$grp_id_grupo_pergunta."&blq=F&ac=alterar'><i class='fas fa-lock' style='color:#EF6456;'></i></a>";
												}
											
											echo "</td>";
											
											echo "<td align='center'>";
												echo "<a href='index.php?pg=editar-grupo-pergunta&id=".$grp_id_grupo_pergunta."'><i class='fas fa-pencil-alt'></i></a>";
											echo "</td>";
											
											echo "<td align='center'>";
												echo "<a href='#deletar-grupo' data-toggle='modal' onclick='deletaGrupo(".$grp_id_grupo_pergunta.",\"".$grp_grupo_pergunta."\",\"".$grp_descricao."\")' class='deletar'><i class='fas fa-times-circle' style='color: #dc4d40;'></i></a>";
											echo "</td>";
										
										echo "</tr>";
																		
									}
									
								echo "</tbody>";
								
								?>
						        
							</table>
			            
			            </div>
			            
			            <div class="card-body" style="font-size: 12px; border-top: 1px solid #ccc; text-align: right;">
			            	
			            	<i class='fas fa-pencil-alt' style="font-size: 12px; margin-left: 10px;"></i> editar 
			            	<i class='fas fa-times-circle' style="font-size: 12px; margin-left: 10px; color: #dc4d40;"></i> excluir
			            	
			            </div>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	<!-- EXCLUIR GRUPO -->
          	<div class="modal fade" id="deletar-grupo">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-agenda">
	              			<h4 class="modal-title">EXCLUIR GRUPO</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='excluir-grupo-process.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_exclui_id_grupo" name="modal_exclui_id_grupo">
	            			
			            	<div class="modal-body">
			            		
			            		<div class="row">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										<label for="modal_motivo">Grupo</label> 
										<input class="form-control" id="modal_exclui_grupo" name="modal_exclui_grupo" readonly>
			              			</div>
			              		</div>
			              		
			              		<div class="row">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										<label for="modal_motivo">Descrição</label> 
										<textarea type="text" rows="3" class="form-control" id="modal_exclui_descricao" name="modal_exclui_descricao" readonly ></textarea>
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
				function deletaGrupo (idGrupo,grupo,descricao){
				    //seta o caminho para quando clicar em "Apagar".
				    //var href = 'excluir-contrato.php?id=' + idDado + '&ac=excluir';
				    //var href = $('#confirmaDelecao')[0].baseURI + '/deletar/' + idDado;
				    
				    //adiciona atributo de delecao ao link
				    //$('#confirmaDelecao').prop("href", href);
				    
				    var modal_id_grupo = idGrupo;
					$("#modal_exclui_id_grupo").val(modal_id_grupo);
					
				    var modal_grupo = grupo;
					$("#modal_exclui_grupo").val(modal_grupo);
										
					var modal_descricao = descricao;
					$("#modal_exclui_descricao").val(modal_descricao);
					
				}
			</script>
          	<!-- FIM EXCLUIR GRUPO -->
          	
          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>