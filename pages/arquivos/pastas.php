<?php
	
	session_start();
	
	if(isset($_SESSION['msg_nova_pasta'])){
		$msg_nova_pasta = $_SESSION['msg_nova_pasta'];
		unset($_SESSION['msg_nova_pasta']);
	}
	
	if(isset($_SESSION['msg_excluir_pasta'])){
		$msg_excluir_pasta = $_SESSION['msg_excluir_pasta'];
		unset($_SESSION['msg_excluir_pasta']);
	}
	
	if(isset($_SESSION['msg_excluir_arquivo'])){
		$msg_excluir_arquivo = $_SESSION['msg_excluir_arquivo'];
		unset($_SESSION['msg_excluir_arquivo']);
	}	
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pastas</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Pastas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
	<?php if(isset($msg_nova_pasta)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_nova_pasta; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_excluir_pasta)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_excluir_pasta; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_excluir_arquivo)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_excluir_arquivo; ?>
	</div>
	<?php endif; ?>
	
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="row">
          		<div class="col-xs-12 col-md-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title">PASTAS</h3>
			            	<h3 class="card-title" style="float: right; color: #666;"><a href='#nova-pasta' class="btn btn-info btn-xs" data-toggle="modal" onclick="novaPasta(<?php echo "$Fun_Id"; ?>)" style="padding: 5px 20px;">NOVA PASTA</a></h3>
			            </div>
				            
			            <div class="card-body">
			            	
			            	<div class="row">
			            		
			            		<?php
				
								$sql_cf = " 
								select
									tbl_arquivo_pasta.ID_ARQUIVO_PASTA,
									tbl_arquivo_pasta.ID_USUARIO,
									tbl_arquivo_pasta.NOME_PASTA,
									
									(select COUNT(tbl_arquivo.ID_ARQUIVO_PASTA) from tbl_arquivo where tbl_arquivo_pasta.ID_ARQUIVO_PASTA = tbl_arquivo.ID_ARQUIVO_PASTA and tbl_arquivo.SITUACAO = 'CADASTRADO') as QTDE_ARQUIVOS
									
								from
									tbl_arquivo_pasta
									
								where
									tbl_arquivo_pasta.ID_USUARIO = '$Fun_Id' and
									tbl_arquivo_pasta.SITUACAO = 'CADASTRADO'
									
								order by
									tbl_arquivo_pasta.NOME_PASTA asc
								
								";
								$qry_cf = mysql_query($sql_cf) or die ("Erro 01: ".mysql_error());
								
								while($reg_cf = mysql_fetch_array($qry_cf)){
									
									$ID_ARQUIVO_PASTA = $reg_cf['ID_ARQUIVO_PASTA'];
									$ID_USUARIO       = $reg_cf['ID_USUARIO'];
									$NOME_PASTA       = $reg_cf['NOME_PASTA'];
									$QTDE_ARQUIVOS    = $reg_cf['QTDE_ARQUIVOS'];
									
									
									echo "<div class='col-xs-12 col-md-3'>";          							
	          							echo "<div class='card'>";  
	          								echo "<div class='card-body' style='padding: 20px 20px 5px 20px'>";
								            	echo "<div style='color: #666;'>".$NOME_PASTA."</div>";
								            echo "</div>"; 
								            echo "<div class='card-body' style='padding: 0 20px 10px 20px'>";
								            	echo "<h3 class='card-title' style='color: #444; font-size: 18px;'><b>".$QTDE_ARQUIVOS."</b> <span style='font-size: 12px;'>arquivo(s)</span></h3>";
								            echo "</div>";
								            echo "<div class='card-footer' style='background: #f1f2f4; border-top: 2px solid #c5ccd3;;'>";
								            	echo "<h3 class='card-title'>";
								            		echo "<form id='LancamentoForm' method='post' role='form' action='index.php?pg=arquivos' enctype='multipart/form-data' style='margin: 0; padding: 0;'>";
														
														echo "<input type='hidden' id='id_pasta' name='id_pasta' value='".$ID_ARQUIVO_PASTA."' />";
														echo "<input type='hidden' id='id_usuario' name='id_usuario' value='".$ID_USUARIO."' />";
														
														echo "<button type='submit' class='btn btn-primary btn-xs bt-ds'>ABRIR</button>";
														
													echo "</form>";	
								            	echo "</h3>";
								            	echo "<h3 class='card-title'>";
								            		echo "<a href='#deletar-pasta' class='btn btn-danger btn-xs bt-ds' data-toggle='modal' onclick='deletaPasta(".$ID_USUARIO.",".$ID_ARQUIVO_PASTA.",\"Excluir a pasta ".$NOME_PASTA." com ".$QTDE_ARQUIVOS." arquivos\")' style='margin-left: 5px;'>EXCLUIR</a>";								            	
								            	echo "</h3>";
								            echo "</div>"; 
								    	echo "</div>";       							
	          						echo "</div>";
									
								}
								
								?>
			            		          						
          					</div>
			            	
			            </div>
			            
					</div>
					
				</div>
			</div>
			
			<!-- NOVA PASTA -->
			<div class="modal fade" id="nova-pasta">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-agenda">
	              			<h4 class="modal-title">NOVA PASTA</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='nova-pasta-process.php?ac=cadastrar' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_id_usuario" name="modal_id_usuario">
	            				            			
			            	<div class="modal-body">
			            		
			            		<p style="margin-bottom: 0px; font-size: 16px;"><b>Incluir uma nova pasta</b></p>
			            		
			              		<div class="row" style="margin: 15px 0;">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										<label for="modal_nome_pasta">Nome da pasta</label> 
										<input class="form-control" name="modal_nome_pasta">
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
				function novaPasta (idUsuario){
				    //seta o caminho para quando clicar em "Apagar".
				    //var href = 'excluir-contrato.php?id=' + idDado + '&ac=excluir';
				    //var href = $('#confirmaDelecao')[0].baseURI + '/deletar/' + idDado;
				    
				    //adiciona atributo de delecao ao link
				    //$('#confirmaDelecao').prop("href", href);
				    
				    var modal_id_usuario = idUsuario;
					$("#modal_id_usuario").val(modal_id_usuario);
										
				}
			</script>
			
			
    		<!-- EXCLUIR PASTA -->
          	<div class="modal fade" id="deletar-pasta">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-excluir">
	              			<h4 class="modal-title">EXCLUIR PASTA</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='excluir-pasta-process.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_id_usuario_" name="modal_id_usuario">
	            			<input type="hidden" class="form-control" id="modal_id_pasta" name="modal_id_pasta">
	            			
			            	<div class="modal-body">
			            		
			            		<p style="margin-bottom: 0px; font-size: 16px;"><b>Confirmar a exclusão da pasta</b></p>
			            		
			            		<div class="row">
									<div class="col-xs-12 col-md-12">
			              				<input class="input-modal" id="modal_descricao">
			              			</div>
			              		</div>
			              		
			              		<div class="row" style="margin: 15px 0;">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										<label for="modal_motivo">Motivo</label> 
										<input class="form-control" name="modal_motivo">
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
				function deletaPasta (idUsuario,idPasta,descricao){
				    //seta o caminho para quando clicar em "Apagar".
				    //var href = 'excluir-contrato.php?id=' + idDado + '&ac=excluir';
				    //var href = $('#confirmaDelecao')[0].baseURI + '/deletar/' + idDado;
				    
				    //adiciona atributo de delecao ao link
				    //$('#confirmaDelecao').prop("href", href);
				    
				    var modal_id_usuario = idUsuario;
					$("#modal_id_usuario_").val(modal_id_usuario);
					
				    var modal_id_pasta = idPasta;
					$("#modal_id_pasta").val(modal_id_pasta);
										
					var modal_descricao = descricao;
					$("#modal_descricao").val(modal_descricao);
					
				}
			</script>
			
          	<!-- FIM LISTA DE INGREDIENTES CADASTRADOS -->
          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>