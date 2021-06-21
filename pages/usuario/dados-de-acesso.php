
<div class="card-titulo-form">Dados de Acesso</div>

<form id="LancamentoForm" method="post" role="form" action="acesso-process.php?ac=cadastrar" enctype="multipart/form-data">
	
	<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
				            	
	<div class="row">
											
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<label for="usuario">Usuário</label> 
				<input type="text" class="form-control" readonly value="<?php echo $LOGIN; ?>" />
		  	</div>
		</div>
		
		<div class="col-xs-12 col-md-3">
			<div class="form-group">
				<label for="nova_senha">Nova senha <span style="color: #f08080;">*</span></label> 
				<input type="password" class="form-control" id="nova_senha" name="nova_senha" style="text-align: center;" required >
			</div>
		</div>
		<div class="col-xs-12 col-md-3">
			<div class="form-group">
				<label for="repetir_nova_senha">Repetir nova senha <span style="color: #f08080;">*</span></label> 
				<input type="password" class="form-control" id="repetir_nova_senha" name="repetir_nova_senha" style="text-align: center;" required >
			</div>
		</div>
		
	</div>
	
	<div class="form-footer">
		<button type="submit" class="btn-primary">ATUALIZAR</button>		
	</div>
	
</form>       		