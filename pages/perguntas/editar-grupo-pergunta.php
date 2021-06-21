<?php
	
	session_start();
	
	$id_grupo_pergunta = $_GET['id'];
	
	$sql_lis_con = "
    select	
    	tbl_grupo_pergunta.id_grupo_pergunta, 								
		tbl_grupo_pergunta.grupo_pergunta, 
		tbl_grupo_pergunta.descricao
		
	from
		tbl_grupo_pergunta
									
	where
		tbl_grupo_pergunta.ID_GRUPO_PERGUNTA = '$id_grupo_pergunta' and 
		tbl_grupo_pergunta.SITUACAO = 'CADASTRADO'
										        					
	";
    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
    $reg_lis_con = mysql_fetch_array($qry_lis_con);

	$grp_id_grupo_pergunta = $reg_lis_con['id_grupo_pergunta'];
	$grp_grupo_pergunta	   = $reg_lis_con['grupo_pergunta'];
	$grp_descricao         = $reg_lis_con['descricao'];
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Grupo Pergunta</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=perguntas">Perguntas</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=grupo-pergunta">Grupo Pergunta</a></li>
              <li class="breadcrumb-item active">Editar Grupo Pergunta</li>
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
          			
          			<form id='LancamentoForm' method='post' role='form' action='editar-grupo-pergunta-process.php?ac=editar' enctype='multipart/form-data'>
          			
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
						
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">EDITAR GRUPO PERGUNTA</h3>
				            </div>
				                
				            <div class="card-body">
				            	
				            	<div class="row">
				            		<div class="col-xs-12 col-md-2">
										<div class="form-group">
											<label for="nome_grupo">Código</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" id="id_grupo" name="id_grupo" value="<?php echo str_pad($grp_id_grupo_pergunta, 5, "0", STR_PAD_LEFT); ?>" />
									  	</div>
									</div>										
									<div class="col-xs-12 col-md-10">
										<div class="form-group">
											<label for="nome_grupo">Grupo<span style="color: #f08080;">*</span></label> 
											<input type="text" class="form-control" required id="nome_grupo" name="nome_grupo"  value="<?php echo $grp_grupo_pergunta; ?>" />
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