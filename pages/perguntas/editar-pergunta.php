<?php
	
	session_start();
	
	
	$id_pergunta = $_GET['id'];
	$id_grupo_pergunta = $_GET['idgp'];
	
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
																																											
	
	$sql_p = "
    select	
    	tbl_pergunta.id_pergunta, 
    	tbl_pergunta.pergunta 
		
	from
		tbl_pergunta
									
	where
		tbl_pergunta.id_pergunta = '$id_pergunta' and
		tbl_pergunta.id_grupo_pergunta = '$grp_id_grupo_pergunta'
										        					
	";
    $qry_p = mysql_query($sql_p) or die ("Erro 4: ".mysql_error());
    $reg_p = mysql_fetch_array($qry_p);

	$per_id_pergunta = $reg_p['id_pergunta'];
	$per_pergunta    = $reg_p['pergunta'];
	
	
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Pergunta</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=listar-perguntas&id=<?php echo $grp_id_grupo_pergunta ?>">Listar Perguntas</a></li>
              <li class="breadcrumb-item active">Editar Pergunta</li>
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
          			
          			<form id='LancamentoForm' method='post' role='form' action='editar-pergunta-process.php?ac=editar' enctype='multipart/form-data'>
          			
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
						<input type="hidden" id="id_grupo_pergunta" name="id_grupo_pergunta" value="<?php echo $grp_id_grupo_pergunta; ?>" />
						<input type="hidden" id="id_pergunta" name="id_pergunta" value="<?php echo $per_id_pergunta; ?>" />
						
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">EDITAR PERGUNTA</h3>
				            </div>
				                
				            <div class="card-body">
				            	
				            	<div class="row">	
				            		<div class="col-xs-12 col-md-2">
										<div class="form-group">
											<label for="nome_grupo">Código</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" id="id_grupo" name="id_grupo" value="<?php echo str_pad($per_id_pergunta, 5, "0", STR_PAD_LEFT); ?>" />
									  	</div>
									</div>									
									<div class="col-xs-12 col-md-10">
										<div class="form-group">
											<label for="nome_grupo">Grupo</label> 
											<input type="text" class="form-control" readonly value="<?php echo str_pad($grp_id_grupo_pergunta, 5, "0", STR_PAD_LEFT)." - ".$grp_grupo_pergunta; ?>" />
									  	</div>
									</div>																							
							    </div>
							    
							    <div class="row">
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="pergunta_grupo">Descrição</label>
											<textarea type="text" rows="2" class="form-control" readonly ><?php echo $grp_descricao; ?></textarea>
									  	</div>									  	
									</div>						
								</div>
					  			
							    <div class="row">
									<div class="col-xs-12 col-md-12">
										<div class="form-group">
											<label for="pergunta_grupo">Pergunta<span style="color: #f08080;">*</span></label>
											<textarea type="text" rows="4" class="form-control" required id="editar_pergunta" name="editar_pergunta" ><?php echo $per_pergunta; ?></textarea>
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