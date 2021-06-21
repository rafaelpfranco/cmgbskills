<?php session_start(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Listar Candidaturas</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Listar Candidaturas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_novo_candidato)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_novo_candidato; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_bloq_candidato)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_bloq_candidato; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_exclui_candidato)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_exclui_candidato; ?>
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
			            	<h3 class="card-title">LISTA DE CANDIDATURAS</h3>
			            </div>
				            
			            <div class="card-body">
			            
						<table class="table table-bordered" id="example1" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Id</th>
									<th>Nome</th>
									<th>CPF</th>
									<th>Email</th>
									<th>Telefone</th>
									<th>Vaga</th>
									<th>Data</th>
									<th>Currículo</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($candidatura_table as $pushCandidatura){ ?>    
								
								<?php
								$data_registro  = htmlspecialchars($pushCandidatura['data']); 
								$data_registro  = explode("-", $data_registro);
								$data_registro =  $data_registro[2]."/".$data_registro[1]."/".$data_registro[0];
								?>


								<tr>
									<td><?php echo htmlspecialchars($pushCandidatura['id']); ?></td>
									<td><?php echo htmlspecialchars($pushCandidatura['nome']); ?></td>
									<td><?php echo htmlspecialchars($pushCandidatura['cpf']); ?></td>
									<td><?php echo htmlspecialchars($pushCandidatura['email']); ?></td>
									<td><?php echo htmlspecialchars($pushCandidatura['telefone']); ?></td>
									<td><?php echo htmlspecialchars($pushCandidatura['vaga']); ?></td>
									<td><?php echo $data_registro; ?></td>
									<td><a class="btn btn-primary" href="https://portal.cmgb.com.br/curriculo/<?=$pushCandidatura['curriculo']?>" target="_blank">Ver Currículo</a></td>
								</tr>
							<?php } ?> 
							</tbody>
						</table>
			            
			            </div>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	
          	<div class="modal fade" id="deletar-candidato">
	        	<div class="modal-dialog">
	          		<div class="modal-content">
	            		<div class="modal-header modal-excluir">
	              			<h4 class="modal-title">EXCLUIR CANDIDATO</h4>
	              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	              			</button>
	            		</div>
	            		
	            		<form id='LancamentoForm' method='post' role='form' action='excluir-candidato.php?ac=excluir' enctype='multipart/form-data' style='margin-bottom: 0;'>
	            			
	            			<input type="hidden" class="form-control" id="modal_id_usuario" name="modal_id_usuario">
	            			<input type="hidden" class="form-control" id="modal_id_candidato" name="modal_id_candidato">
	            			
			            	<div class="modal-body">
			            		
			            		<p style="margin-bottom: 0px; font-size: 16px;"><b>Confirmar a exclusão do candidato:</b></p>
			            		
			            		<div class="row">
									<div class="col-xs-12 col-md-12">
			              				<input class="input-modal" id="modal_candidato">
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
				function deletaCandidato (idUsuario,idCandidato,candidato){
				    
				    var modal_id_usuario = idUsuario;
					$("#modal_id_usuario").val(modal_id_usuario);
					
				    var modal_id_candidato = idCandidato;
					$("#modal_id_candidato").val(modal_id_candidato);
										
					var modal_candidato = candidato;
					$("#modal_candidato").val(modal_candidato);
					
				}
			</script>
			    	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>