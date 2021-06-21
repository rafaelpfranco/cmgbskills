<?php
	
	session_start();
	
	
	$id_teste = $_GET['id'];
	
	$sql_lis_con = "
    select	
    	tbl_teste.id_teste, 
    	tbl_teste.id_grupo_teste, 								
		tbl_teste.nome_teste, 
		date_format(data_inicio, '%d/%m/%Y') as data_inicio, 
		date_format(data_fim, '%d/%m/%Y') as data_fim,    
		tbl_teste.observacao
		
	from
		tbl_teste
									
	where
		tbl_teste.id_teste = '$id_teste' and 
		tbl_teste.SITUACAO = 'CADASTRADO'
										        					
	";
    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
    $reg_lis_con = mysql_fetch_array($qry_lis_con);

	$grp_id_teste          = $reg_lis_con['id_teste'];
	$grp_id_grupo_teste    = $reg_lis_con['id_grupo_teste'];
	$grp_nome_teste  	   = $reg_lis_con['nome_teste'];
	
	$grp_data_inicio       = $reg_lis_con['data_inicio'];
	$grp_data_fim          = $reg_lis_con['data_fim'];
	
	$grp_observacao        = $reg_lis_con['observacao'];
	
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Inventário</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=inventario">Listar Inventário</a></li>
              <li class="breadcrumb-item active">Editar Inventário</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		    		
          	<!-- LISTA DE INGREDIENTES CADASTRADOS -->
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<form id="LancamentoForm" method="post" role="form" action="editar-inventario-process.php?ac=alterar" enctype="multipart/form-data">
			
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
						<input type="hidden" id="id_teste" name="id_teste" value="<?php echo $grp_id_teste; ?>" />
						
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">DADOS DO INVENTÁRIO</h3>
				            </div>
				                
				            <div class="card-body">
				            	
				            	<div class="row">
					            	<div class="col-xs-12 col-md-6">
										<div class="form-group">
											<label for="id_grupo_teste">Grupo inventário <span style="color: #f08080;">*</span></label>											
						                    <select name="id_grupo_teste" id="id_grupo_teste" required class="form-control">
									    		<option value="">selecione</option>
									    		<?php
							                     	$sql_prof = "SELECT DISTINCT id_grupo_teste, grupo_teste FROM tbl_grupo_teste WHERE bloqueado = 'F' and situacao = 'CADASTRADO' ORDER BY grupo_teste ASC";
							                        $qry_prof = mysql_query($sql_prof) or die(mysql_error());
							                        while($ln_prof = mysql_fetch_assoc($qry_prof)){
							                    ?>	 
							                        <option value="<?php echo $ln_prof['id_grupo_teste']; ?>"
							                        	<?php if($ln_prof['id_grupo_teste'] = $grp_id_grupo_teste){ echo "selected"; } ?> 
							                        	>
							                        	<?php 
							                        	echo "<strong>".$ln_prof['grupo_teste']."</strong>";
							                        	?>
							                        </option>
							                    <?php		
							                        }
							                    ?>
									    	</select>							                
										</div>
									</div>
									
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="data_inicio">Data início  <span style="color: #f08080;">*</span></label> 
											<div class="input-group date" data-target-input="nearest">
						                        <input type="text" class="form-control" id="data_inicio" name="data_inicio" required style="text-align: center !important;" maxlength="10" onKeyUp="dat(this);" value="<?php echo $grp_data_inicio; ?>" >
						                        <div class="input-group-append" data-toggle="datetimepicker">
						                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
						                        </div>
						                    </div>
						                </div>
									</div>
									
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="data_fim">Data fim</label> 
											<div class="input-group date" data-target-input="nearest">
						                        <input type="text" class="form-control" id="data_fim" name="data_fim" style="text-align: center !important;" maxlength="10" onKeyUp="dat(this);" value="<?php echo $grp_data_fim; ?>" >
						                        <div class="input-group-append" data-toggle="datetimepicker">
						                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
						                        </div>
						                    </div>
						                </div>
									</div>
								</div>
				            
				            	<div class="row">									
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="nome_teste">Nome do inventário<span style="color: #f08080;">*</span></label> 
											<input type="text" class="form-control" required id="nome_teste" name="nome_teste" value="<?php echo $grp_nome_teste; ?>" />
									  	</div>
									</div>																							
							    </div>
							    
							    <div class="row">
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="observacao">Observações</label>
											<textarea type="text" rows="2" class="form-control" id="observacao" name="observacao" ><?php echo $grp_observacao; ?></textarea>
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
          	
          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>