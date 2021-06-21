<?php
	
	session_start();
	
	$id_grupo_teste = $_GET['id'];
	
	$sql_lis_con = "
    select	
    	tbl_grupo_teste.id_grupo_teste, 								
		tbl_grupo_teste.grupo_teste, 
		tbl_grupo_teste.descricao
		
	from
		tbl_grupo_teste
									
	where
		tbl_grupo_teste.id_grupo_teste = '$id_grupo_teste' and 
		tbl_grupo_teste.SITUACAO = 'CADASTRADO'
										        					
	";
    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
    $reg_lis_con = mysql_fetch_array($qry_lis_con);

	$grp_id_grupo_teste    = $reg_lis_con['id_grupo_teste'];
	$grp_grupo_teste	   = $reg_lis_con['grupo_teste'];
	$grp_descricao         = $reg_lis_con['descricao'];
		
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Grupo Inventário</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=grupo-inventario">Grupo Inventário</a></li>
              <li class="breadcrumb-item active">Editar Grupo Inventário</li>
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
          			
          			<form id='LancamentoForm' method='post' role='form' action='editar-grupo-inventario-process.php?ac=alterar' enctype='multipart/form-data'>
          			
						<input type="hidden" id="id_grupo_teste" name="id_grupo_teste" value="<?php echo $grp_id_grupo_teste; ?>" />
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
						
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">EDITAR GRUPO INVENTÁRIO</h3>
				            </div>
				                
				            <div class="card-body">
				            	
				            	<div class="row">
				            		<div class="col-xs-12 col-md-2">
										<div class="form-group">
											<label for="nome_grupo">Código</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" value="<?php echo str_pad($grp_id_grupo_teste, 5, "0", STR_PAD_LEFT); ?>" />
									  	</div>
									</div>									
									<div class="col-xs-12 col-md-10">
										<div class="form-group">
											<label for="nome_grupo">Grupo<span style="color: #f08080;">*</span></label> 
											<input type="text" class="form-control" required id="nome_grupo" name="nome_grupo" value="<?php echo $grp_grupo_teste; ?>" />
									  	</div>
									</div>																							
							    </div>
					  			
							    <div class="row">
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="descricao_grupo">Descrição</label>
											<textarea type="text" rows="3" class="form-control" id="descricao_grupo" name="descricao_grupo" ><?php echo $grp_descricao; ?></textarea>
									  	</div>									  	
									</div>						
								</div>
							    
				            </div>
				            
				            <div class="card-footer" style="text-align: center;">
	                  			<button type="submit" class="btn-primary">ALTERAR</button>
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