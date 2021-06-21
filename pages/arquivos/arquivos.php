<?php
	
	session_start();
	
	$ID_ARQUIVO_PASTA = $_POST['id_pasta'];
	$ID_USUARIO       = $_POST['id_usuario'];
		
	//////////////// INCLUIR ARQUIVO
	if(isset($_POST['upload'])){
		
		foreach($_FILES["anexar_documento"]["name"] as $key => $valor){
			
			$ID_USUARIO       = $_POST['modal_id_usuario'];
			$ID_ARQUIVO_PASTA = $_POST['modal_id_pasta'];
			
			$NOME_ARQUIVO = $_POST['modal_nome_arquivo'];
			$NOME_PASTA   = $_POST['modal_nome_pasta'];
			
			$pasta = 'arquivos/'.$NOME_PASTA.'/';		
			//$pasta = 'documentos/pagamentos/';
			
			$tmp_name   = $_FILES["anexar_documento"]["tmp_name"][$key];
	 		$nome       = $_FILES["anexar_documento"]["name"][$key];
			$uploadfile = $pasta . basename($nome);
			
			$sql_cf = " 
			select
				ID_ARQUIVO
			from
				tbl_arquivo
			where
				ID_ARQUIVO_PASTA = '$ID_ARQUIVO_PASTA' and
				ID_USUARIO = '$ID_USUARIO' and
				ARQUIVO = '$nome'
			";
			$qry_cf = mysql_query($sql_cf) or die ("Erro 01: ".mysql_error());
			$reg_cf = mysql_fetch_array($qry_cf);
			
			$EXISTE_ARQUIVO = $reg_cf['ID_ARQUIVO'];
			
			if($EXISTE_ARQUIVO == ""){
			
		 		if(move_uploaded_file($tmp_name, $uploadfile)){
							
					//cadastra arquivo no banco
					$sql_cadar = " 
					INSERT INTO tbl_arquivo	( ID_ARQUIVO, ID_ARQUIVO_PASTA, ID_USUARIO, NOME_ARQUIVO, ARQUIVO, SITUACAO, ID_USUARIO_CADASTRO, DATA_CADASTRO ) 
					VALUES ( null, '$ID_ARQUIVO_PASTA', '$ID_USUARIO', '$NOME_ARQUIVO', '$nome', 'CADASTRADO', '$ID_USUARIO', now() ) ";
					$qry_cadar = mysql_query($sql_cadar) or die ("Erro ao realizar cadastro do arquivo: ".mysql_error());	
											
				}
				
				$_SESSION['msg_novo_arquivo'] = 'Novo arquivo cadastrado com sucesso.';
			
			}else{
			
				$_SESSION['msg_existe_arquivo'] = 'O arquivo informado já encontra-se cadastrado.';
			
			}

		}
													
	}
	
	
	
	////////////////
	$sql_cf = " 
	select
		tbl_arquivo_pasta.ID_ARQUIVO_PASTA,
		tbl_arquivo_pasta.ID_USUARIO,
		tbl_arquivo_pasta.NOME_PASTA,
		
		(select COUNT(tbl_arquivo.ID_ARQUIVO_PASTA) from tbl_arquivo where tbl_arquivo_pasta.ID_ARQUIVO_PASTA = tbl_arquivo.ID_ARQUIVO_PASTA and tbl_arquivo.SITUACAO = 'CADASTRADO') as QTDE_ARQUIVOS
		
	from
		tbl_arquivo_pasta
		
	where
		tbl_arquivo_pasta.ID_ARQUIVO_PASTA = '$ID_ARQUIVO_PASTA' and
		tbl_arquivo_pasta.ID_USUARIO = '$ID_USUARIO' and
		tbl_arquivo_pasta.SITUACAO = 'CADASTRADO'
		
	";
	$qry_cf = mysql_query($sql_cf) or die ("Erro 01: ".mysql_error());
	$reg_cf = mysql_fetch_array($qry_cf);
		
	$ID_ARQUIVO_PASTA = $reg_cf['ID_ARQUIVO_PASTA'];
	$ID_USUARIO       = $reg_cf['ID_USUARIO'];
	$NOME_PASTA       = $reg_cf['NOME_PASTA'];
	$QTDE_ARQUIVOS    = $reg_cf['QTDE_ARQUIVOS'];
		
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Arquivos <?php echo $EXISTE_ARQUIVO; ?></h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=pastas">Pastas</a></li>
              <li class="breadcrumb-item active">Arquivos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php
    
    if(isset($_SESSION['msg_novo_arquivo'])){
		$msg_novo_arquivo = $_SESSION['msg_novo_arquivo'];
		unset($_SESSION['msg_novo_arquivo']);
	}
	
	if(isset($_SESSION['msg_existe_arquivo'])){
		$msg_existe_arquivo = $_SESSION['msg_existe_arquivo'];
		unset($_SESSION['msg_existe_arquivo']);
	}
    
    ?>
	
	<?php if(isset($msg_novo_arquivo)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_novo_arquivo; ?>
	</div>
	<?php endif; ?>
		
	<?php if(isset($msg_existe_arquivo)): ?>
	<div class="alert alert-dismissable alert-danger">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_existe_arquivo; ?>
	</div>
	<?php endif; ?>
	
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="row">
          		<div class="col-xs-12 col-md-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title"><?php echo $NOME_PASTA."<br/><span style='color: #666; font-size: 14px;'>Esta pasta contém ".$QTDE_ARQUIVOS." arquivo(s)</span>"; ?></h3>
			            	<h3 class="card-title" style="float: right; color: #666;"><a href='index.php?pg=pastas' class="btn btn-info btn-xs" style="padding: 5px 20px; margin-left: 10px;">PASTAS</a></h3>
			            	<h3 class="card-title" style="float: right; color: #666;">
			            		<?php
			            		echo "<a href='#novo-arquivo' class='btn btn-info btn-xs' data-toggle='modal' onclick='novoArquivo(".$ID_USUARIO.",".$ID_ARQUIVO_PASTA.",\"".$NOME_PASTA."\")' style='padding: 5px 20px;'>NOVO ARQUIVO</a>";
			            		?>
			            </div>
				            
			            <div class="card-body">
			            	
			            	<div class="row">
			            		
			            		<?php
				
								$sql_cf = " 
								select
									ID_ARQUIVO,
									ID_USUARIO,
									NOME_ARQUIVO,
									ARQUIVO
								from
									tbl_arquivo
									
								where
									ID_ARQUIVO_PASTA = '$ID_ARQUIVO_PASTA' and
									ID_USUARIO = '$Fun_Id' and
									SITUACAO = 'CADASTRADO'
									
								order by
									tbl_arquivo.NOME_ARQUIVO asc
								
								";
								$qry_cf = mysql_query($sql_cf) or die ("Erro 01: ".mysql_error());
								
								while($reg_cf = mysql_fetch_array($qry_cf)){
									
									$ID_ARQUIVO 	= $reg_cf['ID_ARQUIVO'];
									$ID_USUARIO     = $reg_cf['ID_USUARIO'];
									$NOME_ARQUIVO   = $reg_cf['NOME_ARQUIVO'];
									$ARQUIVO		= $reg_cf['ARQUIVO'];
									
									
									echo "<div class='col-xs-12 col-md-3'>";          							
	          							echo "<div class='card'>";  
	          								echo "<div class='card-body'>";
								            	echo "<div style='color: #666;'>".$NOME_ARQUIVO."</div>";
								            echo "</div>"; 
								            echo "<div class='card-footer' style='background: #f1f2f4; border-top: 2px solid #c5ccd3;;'>";
								            	echo "<h3 class='card-title'>";												
													echo "<a href='arquivos/".$NOME_PASTA."/".$ARQUIVO."' target='_blank' class='btn btn-primary btn-xs bt-ds'>DOWNLOAD</a>";
								            	echo "</h3>";
								            	echo "<h3 class='card-title'>";
								            		echo "<a href='#deletar-arquivo' class='btn btn-danger btn-xs bt-ds' data-toggle='modal' onclick='deletaArquivo(".$ID_USUARIO.",".$ID_ARQUIVO.",\"Excluir o arquivo ".$NOME_ARQUIVO." da pasta ".$NOME_PASTA." \")' style='margin-left: 5px;'>EXCLUIR</a>";								            	
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
			<div class="modal fade" id="novo-arquivo">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-agenda">
	              			<h4 class="modal-title">NOVO ARQUIVO</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_id_usuario" name="modal_id_usuario">
	            			<input type="hidden" class="form-control" id="modal_id_pasta" name="modal_id_pasta">
	            				            			
			            	<div class="modal-body">
			            		
			            		<p style="margin-bottom: 0px; font-size: 16px;"><b>Incluir um novo arquivo</b></p>
			            		
			            		<div class="row" style="margin: 15px 0;">
									<div class="col-xs-12 col-md-12" style="padding: 2px;">
										<label for="modal_nome_pasta">Pasta</label>
										<input class="input-modal" name="modal_nome_pasta" id="modal_nome_pasta" readonly style="margin-bottom: 0;">
										<div id="modal_nome_pasta"></div>
			              			</div>
			              		</div>
			              					              		
			              		<div class="row" style="margin: 15px 0;">
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="nome_arquivo">Nome do arquivo</label> 
											<input type="text" name="modal_nome_arquivo" id="nome_arquivo" class="form-control" required />
										</div>
									</div>
								</div>
								
								<div class="row" style="margin: 15px 0;">
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="id_equipamento">Selecione o arquivo</label> 
											<input type="file" name="anexar_documento[]" id="anexar_documento" class="form-control multi input" accept="doc|docx|txt|jpeg|jpg|png|gif|pdf" style="font-size: 12px;" />
										</div>
									</div>
								</div>
			              		
			            	</div>
			            	<div class="modal-footer justify-content-between">
			              		<button type="button" class="btn btn-default" data-dismiss="modal">SAIR</button>
			              		<button type="submit" name="upload" class="btn btn-primary">CONFIRMAR</a>
			            	</div>
			            	
			            </form>
			            
	          		</div>
	          		<!-- /.modal-content -->
	        	</div>
	        <!-- /.modal-dialog -->
	      	</div>
	      	
	      	<script type="text/javascript">
				function novoArquivo (idUsuario,idPasta,nomePasta){
				    //seta o caminho para quando clicar em "Apagar".
				    //var href = 'excluir-contrato.php?id=' + idDado + '&ac=excluir';
				    //var href = $('#confirmaDelecao')[0].baseURI + '/deletar/' + idDado;
				    
				    //adiciona atributo de delecao ao link
				    //$('#confirmaDelecao').prop("href", href);
				    
				    var modal_id_usuario = idUsuario;
					$("#modal_id_usuario").val(modal_id_usuario);
					
					var modal_id_pasta = idPasta;
					$("#modal_id_pasta").val(modal_id_pasta);
					
					var modal_nome_pasta = nomePasta;
					$("#modal_nome_pasta").val(modal_nome_pasta);
										
				}
			</script>
			
			
    		<!-- EXCLUIR PASTA -->
          	<div class="modal fade" id="deletar-arquivo">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-excluir">
	              			<h4 class="modal-title">EXCLUIR ARQUIVO</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='excluir-arquivo-process.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_id_usuario_" name="modal_id_usuario">
	            			<input type="hidden" class="form-control" id="modal_id_arquivo" name="modal_id_arquivo">
	            			
			            	<div class="modal-body">
			            		
			            		<p style="margin-bottom: 0px; font-size: 16px;"><b>Confirmar a exclusão do arquivo</b></p>
			            		
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
				function deletaArquivo (idUsuario,idArquivo,descricao){
				    //seta o caminho para quando clicar em "Apagar".
				    //var href = 'excluir-contrato.php?id=' + idDado + '&ac=excluir';
				    //var href = $('#confirmaDelecao')[0].baseURI + '/deletar/' + idDado;
				    
				    //adiciona atributo de delecao ao link
				    //$('#confirmaDelecao').prop("href", href);
				    
				    var modal_id_usuario = idUsuario;
					$("#modal_id_usuario_").val(modal_id_usuario);
					
				    var modal_id_arquivo = idArquivo;
					$("#modal_id_arquivo").val(modal_id_arquivo);
										
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