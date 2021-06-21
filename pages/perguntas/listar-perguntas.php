<?php
	
	session_start();
	
	if(isset($_SESSION['msg_edit_bloq_pergunta'])){
		$msg_edit_bloq_pergunta = $_SESSION['msg_edit_bloq_pergunta'];
		unset($_SESSION['msg_edit_bloq_pergunta']);
	}
	
	if(isset($_SESSION['msg_edit_pergunta'])){
		$msg_edit_pergunta = $_SESSION['msg_edit_pergunta'];
		unset($_SESSION['msg_edit_pergunta']);
	}
	
	if(isset($_SESSION['msg_exc_pergunta'])){
		$msg_exc_pergunta = $_SESSION['msg_exc_pergunta'];
		unset($_SESSION['msg_exc_pergunta']);
	}
	
	if(isset($_SESSION['msg_nova_pergunta'])){
		$msg_nova_pergunta = $_SESSION['msg_nova_pergunta'];
		unset($_SESSION['msg_nova_pergunta']);
	}
	
	$id_grupo_pergunta = $_GET['id'];
	
	$sql_grp = "
    select	
    	tbl_grupo_pergunta.id_grupo_pergunta, 
    	tbl_grupo_pergunta.grupo_pergunta, 
		tbl_grupo_pergunta.descricao 
		
	from
		tbl_grupo_pergunta
									
	where
		tbl_grupo_pergunta.id_grupo_pergunta = '$id_grupo_pergunta'
										        					
	";
    $qry_grp = mysql_query($sql_grp) or die ("Erro 4: ".mysql_error());
    $reg_grp = mysql_fetch_array($qry_grp);

	$grp_id_grupo_pergunta = $reg_grp['id_grupo_pergunta'];
	$grp_grupo_pergunta	   = $reg_grp['grupo_pergunta'];
	$grp_descricao         = $reg_grp['descricao'];
																																											
	
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Listar Perguntas</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=perguntas">Perguntas</a></li>
              <li class="breadcrumb-item active">Listar Perguntas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_edit_bloq_pergunta)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edit_bloq_pergunta; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_edit_pergunta)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edit_pergunta; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_exc_pergunta)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_exc_pergunta; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_nova_pergunta)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_nova_pergunta; ?>
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
			            	<h3 class="card-title">GRUPO PERGUNTA</h3>
			            </div>
          								                
			            <div class="card-body" style="padding: 10px 20px; padding-bottom: 0;">
			            	
			            	<div class="row">	
			            		<div class="col-xs-12 col-md-2">
									<div class="form-group">
										<label for="nome_grupo">Código</label><br/> 
										<?php echo str_pad($grp_id_grupo_pergunta, 5, "0", STR_PAD_LEFT); ?>
								  	</div>
								</div>									
								<div class="col-xs-12 col-md-10">
									<div class="form-group">
										<label for="nome_grupo">Grupo</label> <br/> 
										<?php echo $grp_grupo_pergunta; ?>
								  	</div>
								</div>																							
						    </div>
						    <?php if($grp_descricao != ""){ ?>
						    <div class="row">
								<div class="col-xs-12 col-md-12">
									<div class="form-group">
										<label for="pergunta_grupo">Descrição</label><br/> 
										<?php echo $grp_descricao; ?>
								  	</div>									  	
								</div>						
							</div>
				  			<?php } ?>
			            </div>
			            				        	          				
          			</div>
	          			          			
          		</div>
          	</div>
          	
          	<!-- LISTA GRUPO -->
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title">LISTA DE PERGUNTAS CADASTRADAS</h3>
			            	<h3 class="card-title" style="float: right; color: #666;">
			            		<a href="index.php?pg=nova-pergunta&id=<?php echo $id_grupo_pergunta; ?>" class="btn btn-info btn-xs" style="padding: 5px 20px; margin-left: 5px;">NOVA PERGUNTA</a>
			            	</h3>
			            </div>
				            
			            <div class="card-body">
			            
			            	<table id="example1" style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
								    <tr id="title_table">
							            <th width="5%" style="text-align: center !important;"><strong>CÓDIGO</strong></th>
							            <th width="86%" style="text-align: center !important;"><strong>PERGUNTA</strong></th>	
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>	
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							        </tr>
						        </thead>
						        <?php
						        
						        $sql_lis_per = "
						        select	
						        	tbl_pergunta.id_pergunta, 
						        	tbl_pergunta.id_grupo_pergunta, 								
									tbl_pergunta.pergunta, 
									tbl_pergunta.bloqueado 
									
								from
									tbl_pergunta
																
								where
									tbl_pergunta.id_grupo_pergunta = '$id_grupo_pergunta' and 
									tbl_pergunta.situacao = 'CADASTRADO'
									
																	        					
								";
							    $qry_lis_per = mysql_query($sql_lis_per) or die ("Erro 4: ".mysql_error());
							    					    
								echo "<tbody>";
								
									while($reg_lis_per = mysql_fetch_array($qry_lis_per)){
							
										$per_id_pergunta       = $reg_lis_per['id_pergunta'];
										$per_id_grupo_pergunta = $reg_lis_per['id_grupo_pergunta'];
										$per_pergunta	       = $reg_lis_per['pergunta'];
										$per_bloqueado         = $reg_lis_per['bloqueado'];
																																																		
										echo "<tr style='font-size: 14px;'>";
									
											echo "<td align='center'>".str_pad($per_id_pergunta, 5, "0", STR_PAD_LEFT)."</td>";
											echo "<td align='left'>".$per_pergunta."</td>";
											
											echo "<td align='center'>";
											
												if($per_bloqueado == "F"){
													echo "<a href='altera_bloqueio_pergunta.php?id=".$per_id_pergunta."&idg=".$per_id_grupo_pergunta."&blq=T&ac=alterar'><i class='fas fa-lock-open'></i></a>";
												}elseif($per_bloqueado == "T"){
													echo "<a href='altera_bloqueio_pergunta.php?id=".$per_id_pergunta."&idg=".$per_id_grupo_pergunta."&blq=F&ac=alterar'><i class='fas fa-lock' style='color:#EF6456;'></i></a>";
												}
											
											echo "</td>";
											
											echo "<td align='center'>";
												echo "<a href='index.php?pg=editar-pergunta&id=".$per_id_pergunta."&idgp=".$per_id_grupo_pergunta."' /><i class='fas fa-pencil-alt'></i></a>";
											echo "</td>";
											
											echo "<td align='center'>";
												echo "<a href='#deletar-pergunta' data-toggle='modal' onclick='deletaPergunta(".$per_id_pergunta.",".$per_id_grupo_pergunta.")' class='deletar'><i class='fas fa-times-circle' style='color: #dc4d40;'></i></a>";
											echo "</td>";
											
											//echo "<td align='center'>";
											//	echo "<a href='#editar-pergunta' data-toggle='modal' onclick='editaPergunta(".$per_id_pergunta.",".$per_id_grupo_pergunta.",\"".$per_pergunta."\")' class='editar'><i class='fas fa-pencil-alt'></i></a>";
											//echo "</td>";
											
											//echo "<td align='center'>";
											//	echo "<a href='#deletar-pergunta' data-toggle='modal' onclick='deletaPergunta(".$per_id_pergunta.",".$per_id_grupo_pergunta.",\"".$per_pergunta."\")' class='deletar'><i class='fas fa-times-circle'></i></a>";
											//echo "</td>";
										
										echo "</tr>";
																		
									}
									
								echo "</tbody>";
								
								?>
						        
							</table>
			            
			            </div>
			            
			            <div class="card-body" style="font-size: 12px; border-top: 1px solid #ccc; text-align: right;">
			            	
			            	<i class='fas fa-lock' style="font-size: 12px; margin-left: 10px;"></i> bloqueio
			            	<i class='fas fa-pencil-alt' style="font-size: 12px; margin-left: 10px;"></i> editar 
			            	<i class='fas fa-times-circle' style="font-size: 12px; margin-left: 10px; color: #dc4d40;"></i> excluir
			            	
			            </div>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	
          	
          	<!-- EXCLUIR PERGUNTA -->
          	<div class="modal fade" id="deletar-pergunta">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-agenda" style="background: #ff5050;">
	              			<h4 class="modal-title">EXCLUIR PERGUNTA</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm1' method='post' role='form' action='excluir-pergunta-process.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_exclui_id_pergunta" name="modal_exclui_id_pergunta">
	            			<input type="hidden" class="form-control" id="modal_exclui_id_grupo_pergunta" name="modal_exclui_id_grupo_pergunta">
	            			
			            	<div class="modal-body">
			            		
			              		<div class="row">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										Deseja realmente excluir a pergunta?
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
				function deletaPergunta (idPergunta,idGrupoPergunta){
				    				    
				    var modal_exclui_id_pergunta = idPergunta;
					$("#modal_exclui_id_pergunta").val(modal_exclui_id_pergunta);
					
				    var modal_exclui_id_grupo_pergunta = idGrupoPergunta;
					$("#modal_exclui_id_grupo_pergunta").val(modal_exclui_id_grupo_pergunta);
					
				}
			</script>
          	<!-- FIM EXCLUIR PERGUNTA -->
          	          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>