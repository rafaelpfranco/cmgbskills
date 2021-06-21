<?php
	
	session_start();
	
	if(isset($_SESSION['msg_novo_usuario'])){
		$msg_novo_usuario = $_SESSION['msg_novo_usuario'];
		unset($_SESSION['msg_novo_usuario']);
	}
	
	if(isset($_SESSION['msg_bloq_usuario'])){
		$msg_bloq_usuario = $_SESSION['msg_bloq_usuario'];
		unset($_SESSION['msg_bloq_usuario']);
	}
	
	if(isset($_SESSION['msg_exclui_usuario'])){
		$msg_exclui_usuario = $_SESSION['msg_exclui_usuario'];
		unset($_SESSION['msg_exclui_usuario']);
	}
		
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuários</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Usuários</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_novo_usuario)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_novo_usuario; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_bloq_usuario)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_bloq_usuario; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_exclui_usuario)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_exclui_usuario; ?>
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
			            	<h3 class="card-title">LISTA DE USUÁRIOS CADASTRADOS</h3>
			            	<h3 class="card-title" style="float: right; color: #666;"><a href="index.php?pg=novo-usuario" class="btn btn-info btn-xs" style="padding: 5px 20px;">NOVO USUÁRIO</a></h3>
			            </div>
				            
			            <div class="card-body">
			            
			            	<table id="example1" style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
								    <tr id="title_table">
							            <th width="12%" style="text-align: center !important;"><strong>CPF</strong></th>	
							            <th width="41%" style="text-align: center !important;"><strong>NOME</strong></th>	
							            <th width="26%" style="text-align: center !important;"><strong>EMAIL</strong></th>
							            <th width="12%" style="text-align: center !important;"><strong>TELEFONE</strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							        </tr>
						        </thead>
						        <?php
						        
						        $sql_lis_con = "
						        select									
									id_usuario,
									cpf, 
									nome, 
									email, 
									telefone_1, 
									bloqueado   
									
								from
									tbl_usuario
																									
								where
									situacao = 'CADASTRADO'
																	        					
								";
							    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
							    					    
								echo "<tbody>";
								
									while($reg_lis_con = mysql_fetch_array($qry_lis_con)){
							
										$id_usuario     = $reg_lis_con['id_usuario'];
										$cpf			= $reg_lis_con['cpf'];
										$nome			= $reg_lis_con['nome'];
										$email     		= $reg_lis_con['email'];
										$telefone_1 	= $reg_lis_con['telefone_1'];
										$bloqueado   	= $reg_lis_con['bloqueado'];
										
										$nome_usuario = $cpf." ".$nome;
																																																	
										echo "<tr style='font-size: 14px;'>";
									
											//echo "<td align='center'>".str_pad($id_candidato, 5, "0", STR_PAD_LEFT)."</td>";
											echo "<td align='center'>".$cpf."</td>";
											echo "<td align='left'>".$nome."</td>";
											echo "<td align='left'>".$email."</td>";
											echo "<td align='center'>".$telefone_1."</td>";
											
											echo "<td align='center'>";											
												echo "<a href='index.php?pg=editar-usuario&id=".$id_usuario."'><i class='fas fa-pencil-alt'></i></a>";
											echo "</td>";
																				
											echo "<td align='center'>";
											
												if($bloqueado == "F"){
													echo "<a href='altera_bloqueio_usuario.php?id=".$id_usuario."&blq=T&ac=alterar'><i class='fas fa-lock-open'></i></a>";
												}elseif($bloqueado == "T"){
													echo "<a href='altera_bloqueio_usuario.php?id=".$id_usuario."&blq=F&ac=alterar'><i class='fas fa-lock' style='color:#EF6456;'></i></a>";
												}
											
											echo "</td>";
																						
											echo "<td align='center'>";
												echo "<a href='#deletar-usuario' data-toggle='modal' onclick='deletaUsuario(".$Fun_Id.",".$id_usuario.",\"".$nome_usuario."\")' class='deletar'><i class='fas fa-times-circle' style='color: #dc4d40;'></i></a>";
											echo "</td>";
										
										echo "</tr>";
																		
									}
									
								echo "</tbody>";
								
								?>
						        
							</table>
			            
			            </div>
			            
			            <div class="card-body" style="font-size: 12px; border-top: 1px solid #ccc; text-align: right;">
			            	
			            	<i class='fas fa-pencil-alt' style="font-size: 12px; margin-left: 10px;"></i> editar 
			            	<i class='fas fa-lock' style="font-size: 12px; margin-left: 10px;"></i> bloqueio  
			            	<i class='fas fa-times-circle' style="font-size: 12px; margin-left: 10px; color: #dc4d40;"></i> excluir
			            	
			            </div>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	
          	<div class="modal fade" id="deletar-usuario">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-excluir">
	              			<h4 class="modal-title">EXCLUIR USUÁRIO</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='excluir-usuario.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_id_usuario_cadastro" name="modal_id_usuario_cadastro">
	            			<input type="hidden" class="form-control" id="modal_id_usuario" name="modal_id_usuario">
	            			
			            	<div class="modal-body">
			            		
			            		<p style="margin-bottom: 0px; font-size: 16px;"><b>Confirmar a exclusão do usuário</b></p>
			            		
			            		<div class="row">
									<div class="col-xs-12 col-md-12">
			              				<input class="input-modal" id="modal_usuario">
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
				function deletaUsuario (idUsuarioCadastro,idUsuario,usuario){
				    
				    var modal_id_usuario_cadastro = idUsuarioCadastro;
					$("#modal_id_usuario_cadastro").val(modal_id_usuario_cadastro);
					
				    var modal_id_usuario = idUsuario;
					$("#modal_id_usuario").val(modal_id_usuario);
										
					var modal_usuario = usuario;
					$("#modal_usuario").val(modal_usuario);
					
				}
			</script>
			    	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>