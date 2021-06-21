
<div class="card-titulo-form">Dados Pessoais</div>

<form id="LancamentoForm" method="post" role="form" action="dados-pessoais-process.php?ac=cadastrar" enctype="multipart/form-data">
	
	<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
				            	
	<div class="row">											
		<div class="col-xs-12 col-md-3">
			<div class="form-group">
				<label for="cpf">CPF</label> 
				<input type="text" class="form-control" readonly style="text-align: center;" value="<?php echo $CPF; ?>" />
		  	</div>
		</div>							
		<div class="col-xs-12 col-md-9">
			<div class="form-group">
				<label for="nome_contrato">Nome Completo</label> 
				<input type="text" class="form-control" readonly value="<?php echo $NOME; ?>"  />
		  	</div>
		</div>										
	</div>
	
	<div class="row">											
		<div class="col-xs-12 col-md-3">
			<div class="form-group">
				<label for="apelido">Como gosta de ser chamado(a)? <span style="color: #f08080;">*</span></label> 
				<input type="text" class="form-control" id="apelido" name="apelido" required value="<?php echo $APELIDO; ?>" />
		  	</div>
		</div>							
					
		<div class="col-xs-12 col-md-5">
			<div class="form-group">
				<label for="email">Email <span style="color: #f08080;">*</span></label> 
				<input type="text" class="form-control" id="email" name="email" required value="<?php echo $EMAIL; ?>"  />
		  	</div>
		</div>
		
		<div class="col-xs-12 col-md-2">
			<div class="form-group">
				<label for="telefone_1">Telefone 1 <span style="color: #f08080;">*</span></label> 
				<input type="text" class="form-control" id="telefone_1" name="telefone_1" required onKeyUp="mtel(this);" maxlength="14" style="text-align: center;" value="<?php echo $TELEFONE_1; ?>" />
		  	</div>
		</div>
		
		<div class="col-xs-12 col-md-2">
			<div class="form-group">
				<label for="telefone_2">Telefone 2</label> 
				<input type="text" class="form-control" id="telefone_2" name="telefone_2" onKeyUp="mtel(this);" maxlength="14" style="text-align: center;" value="<?php echo $TELEFONE_2; ?>" />
		  	</div>
		</div>
		
	</div>
	
	<div class="form-footer">
		<button type="submit" class="btn-primary">CADASTRAR</button>		
	</div>
	
</form>       		