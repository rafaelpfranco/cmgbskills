<?php
	
	session_start();
	
	if(isset($_SESSION['msg_novo_teste'])){
		$msg_novo_teste = $_SESSION['msg_novo_teste'];
		unset($_SESSION['msg_novo_teste']);
	}
	
	if(isset($_SESSION['msg_edita_teste'])){
		$msg_edita_teste = $_SESSION['msg_edita_teste'];
		unset($_SESSION['msg_edita_teste']);
	}
	
	if(isset($_SESSION['msg_exclui_teste'])){
		$msg_exclui_teste = $_SESSION['msg_exclui_teste'];
		unset($_SESSION['msg_exclui_teste']);
	}
	
	if(isset($_SESSION['msg_edit_bloq_teste'])){
		$msg_edit_bloq_teste = $_SESSION['msg_edit_bloq_teste'];
		unset($_SESSION['msg_edit_bloq_teste']);
	}
		
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Listar Inventário</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Listar Inventário</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_novo_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_novo_teste; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_edita_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edita_teste; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_exclui_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_exclui_teste; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_edit_bloq_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edit_bloq_teste; ?>
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
			            	<h3 class="card-title">LISTA DE INVENTÁRIO</h3>
			            	<h3 class="card-title" style="float: right; color: #666; margin-left: 10px;"><a href="index.php?pg=grupo-inventario" class="btn btn-info btn-xs" style="padding: 5px 20px;">GRUPOS</a></h3>
			            	<h3 class="card-title" style="float: right; color: #666; margin-left: 10px;"><a href="index.php?pg=novo-inventario" class="btn btn-info btn-xs" style="padding: 5px 20px;">NOVO INVENTÁRIO</a></h3>
			            </div>
				            
			            <div class="card-body">
			            
			            	<table id="example1" style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
								    <tr id="title_table">
							            <th width="5%" style="text-align: center !important;"><strong>CÓDIGO</strong></th>
							            <th width="30%" style="text-align: center !important;"><strong>GRUPO</strong></th>	
							            <th width="43%" style="text-align: center !important;"><strong>INVENTÁRIO</strong></th>	
							            <th width="10%" style="text-align: center !important;"><strong>INÍCIO</strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							        </tr>
						        </thead>
						        <?php
						        
						        $sql_lis_con = "
						        select									
									tbl_teste.id_teste,
									tbl_teste.nome_teste,
									date_format(tbl_teste.data_inicio, '%d/%m/%Y') as data_inicio,
									tbl_teste.bloqueado,
																		
									tbl_grupo_teste.grupo_teste
									
								from
									tbl_teste
									
									left join tbl_grupo_teste 
									on tbl_teste.id_grupo_teste = tbl_grupo_teste.id_grupo_teste
																
								where
									tbl_teste.SITUACAO = 'CADASTRADO'
																	        					
								";
							    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
							    					    
								echo "<tbody>";
								
									while($reg_lis_con = mysql_fetch_array($qry_lis_con)){
							
										$CONT_ID_TESTE      	= $reg_lis_con['id_teste'];
										$CONT_NOME_TESTE		= $reg_lis_con['nome_teste'];
										$CONT_DATA_INICIO   	= $reg_lis_con['data_inicio'];
										$CONT_BLOQUEADO     	= $reg_lis_con['bloqueado'];
										
										$CONT_GRUPO_TESTE		= $reg_lis_con['grupo_teste'];
																																																	
										echo "<tr style='font-size: 14px;'>";
									
											echo "<td align='center'>".str_pad($CONT_ID_TESTE, 5, "0", STR_PAD_LEFT)."</td>";
											echo "<td align='left'>".$CONT_GRUPO_TESTE."</td>";
											echo "<td align='left'>".$CONT_NOME_TESTE."</td>";
											echo "<td align='center'>".$CONT_DATA_INICIO."</td>";
																				
											echo "<td align='center'>";											
												echo "<a href='index.php?pg=editar-inventario&id=".$CONT_ID_TESTE."'><i class='fas fa-pencil-alt'></i></a>";
											echo "</td>";
											
											echo "<td align='center'>";											
												echo "<a href='index.php?pg=perguntas-do-inventario&id=".$CONT_ID_TESTE."'><i class='fas fa-list'></i></a>";
											echo "</td>";
																						
											echo "<td align='center'>";
											
												if($CONT_BLOQUEADO == "F"){
													echo "<a href='altera_bloqueio_inventario.php?id=".$CONT_ID_TESTE."&blq=T&ac=alterar'><i class='fas fa-lock-open'></i></a>";
												}elseif($CONT_BLOQUEADO == "T"){
													echo "<a href='altera_bloqueio_inventario.php?id=".$CONT_ID_TESTE."&blq=F&ac=alterar'><i class='fas fa-lock' style='color:#EF6456;'></i></a>";
												}
											
											echo "</td>";
											
											echo "<td align='center'>";
												echo "<a href='#deletar-teste' data-toggle='modal' onclick='deletaTeste(".$CONT_ID_TESTE.",\"".$CONT_NOME_TESTE."\")' class='deletar'><i class='fas fa-times-circle' style='color: #dc4d40;'></i></a>";
											echo "</td>";
										
										echo "</tr>";
																		
									}
									
								echo "</tbody>";
								
								?>
						        
							</table>
			            
			            </div>
			            
			            <div class="card-body" style="font-size: 12px; border-top: 1px solid #ccc; text-align: right;">
			            	
			            	<i class='fas fa-pencil-alt' style="font-size: 12px; margin-left: 10px;"></i> editar 
			            	<i class='fas fa-list' style="font-size: 12px; margin-left: 10px;"></i> perguntas 
			            	<i class='fas fa-lock' style="font-size: 12px; margin-left: 10px;"></i> bloqueio
			            	<i class='fas fa-times-circle' style="font-size: 12px; margin-left: 10px; color: #dc4d40;"></i> excluir
			            	
			            </div>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	
          	<div class="modal fade" id="deletar-teste">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-agenda">
	              			<h4 class="modal-title">EXCLUIR INVENTÁRIO</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='excluir-inventario-process.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_exclui_id_teste" name="modal_exclui_id_teste">
	            			
			            	<div class="modal-body">
			            		
			            		<div class="row">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										<label for="modal_motivo">Inventário</label> 
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