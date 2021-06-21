<?php
	
	session_start();
	
	if(isset($_SESSION['msg_edita_perguntas'])){
		$msg_edita_perguntas = $_SESSION['msg_edita_perguntas'];
		unset($_SESSION['msg_edita_perguntas']);
	}
	
	$id_teste = $_GET['id'];
	
	$sql_lis_con = "
    select	
    	tbl_teste.id_teste, 
    	tbl_teste.id_grupo_teste, 								
		tbl_teste.nome_teste, 
		date_format(data_inicio, '%d/%m/%Y') as data_inicio, 
		date_format(data_fim, '%d/%m/%Y') as data_fim
		
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
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perguntas do Inventário</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=inventario">Listar Inventário</a></li>
              <li class="breadcrumb-item active">Perguntas do Inventário</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_edita_perguntas)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edita_perguntas; ?>
	</div>
	<?php endif; ?>
	
	
			
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="card">          				
				<div class="card-body">
    		
		    		<div class="row">
		          		<div class="col-lg-12 col-12">
		          			
		          			<div class="row">
				            	<div class="col-xs-12 col-md-8">
									<div class="form-group">
										<label for="id_grupo_teste">Inventário</label>											
					                    <input type="text" class="form-control" readonly value="<?php echo $grp_nome_teste; ?>" />							                
									</div>
								</div>
								
								<div class="col-xs-12 col-md-2">
									<div class="form-group">
										<label for="data_inicio">Data início</label> 
										<input type="text" class="form-control" readonly style="text-align: center !important;" value="<?php echo $grp_data_inicio; ?>" >
					                </div>
								</div>
								
								<div class="col-xs-12 col-md-2">
									<div class="form-group">
										<label for="data_fim">Data fim</label> 
										<input type="text" class="form-control" readonly style="text-align: center !important;" value="<?php echo $grp_data_fim; ?>" >
					                </div>
								</div>
							</div>
			                      			
		          		</div>
		          	</div>
		          	
		    	</div>
		    </div>
          	
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title">LISTA DE PERGUNTAS</h3>
			            </div>
			            
			            <form id="NovoSetorForm" data-toggle="validator" method="post" role="form" action="perguntas-do-inventario-process.php?ac=cadastrar" enctype="multipart/form-data">
			  			
				  			<input type="hidden" class="form-control" name="id_usuario_cadastro" value="<?php echo $Fun_Id; ?>" />
				  			<input type="hidden" class="form-control" name="id_teste" value="<?php echo $grp_id_teste; ?>" />
				  			<input type="hidden" name="del_selecao" value="1">
			                
			            	<div class="card-body">
			            	
			            	
			            	
				            	<?php
				            	
				            	$sql_grupo = "
							    SELECT
									tbl_grupo_pergunta.id_grupo_pergunta, 
									tbl_grupo_pergunta.grupo_pergunta 
								
								FROM	
									tbl_grupo_pergunta
								
								WHERE
									tbl_grupo_pergunta.bloqueado = 'F' AND 
									tbl_grupo_pergunta.situacao = 'CADASTRADO' 
								
								ORDER BY
									tbl_grupo_pergunta.grupo_pergunta asc 
																	        					
								";
							    $qry_grupo = mysql_query($sql_grupo) or die ("Erro 4: ".mysql_error());
							    
							    while($reg_grupo = mysql_fetch_array($qry_grupo)){
							
									$grp_id_grupo_pergunta = $reg_grupo['id_grupo_pergunta'];
									$grp_grupo_pergunta    = $reg_grupo['grupo_pergunta'];
					            	
					            	echo "<div class='card-titulo-form'>".$grp_grupo_pergunta."</div>";
					            	
									echo "<table class='table table-striped table-bordered table-hover' cellspacing='0' width='100%' style='margin-bottom: 20px;'>";
										echo "<tbody>";
										
											$sql_perg = "
										    SELECT
												tbl_pergunta.id_pergunta, 
												tbl_pergunta.id_grupo_pergunta, 
												tbl_pergunta.pergunta 
											
											FROM	
												tbl_pergunta
											
											WHERE
												tbl_pergunta.id_grupo_pergunta = '$grp_id_grupo_pergunta' AND 
												tbl_pergunta.bloqueado = 'F' AND 
												tbl_pergunta.situacao = 'CADASTRADO' 
											
											ORDER BY
												tbl_pergunta.id_pergunta asc 
																				        					
											";
										    $qry_perg = mysql_query($sql_perg) or die ("Erro 4: ".mysql_error());
										    
											while($reg_perg = mysql_fetch_array($qry_perg)){
								
												$perg_id_pergunta       = $reg_perg['id_pergunta'];
												$perg_id_grupo_pergunta = $reg_perg['id_grupo_pergunta'];
												$perg_pergunta          = $reg_perg['pergunta'];
												
												$sql_sel = "
											    SELECT
													id_pergunta 
												
												FROM	
													tbl_teste_pergunta
												
												WHERE
													id_teste = '$grp_id_teste' and 
													id_pergunta = '$perg_id_pergunta'
																					        					
												";
											    $qry_sel = mysql_query($sql_sel) or die ("Erro 4: ".mysql_error());
											    $reg_sel = mysql_fetch_array($qry_sel);
											    
											    $sel_id_pergunta = $reg_sel['id_pergunta'];
										
												echo "<tr style='font-size: 14px;'>";
													
													echo "<td width='3%' align='center'>";	
														
														echo "<input type='hidden' class='id_grupo_pergunta' name='permissao[".$perg_id_pergunta."][id_grupo_pergunta]'";
															echo "value='".$grp_id_grupo_pergunta."'";
														echo ">";
														
														echo "<input type='hidden' class='id_pergunta' name='permissao[".$perg_id_pergunta."][id_pergunta]'";
															echo "value='".$perg_id_pergunta."'";
														echo ">";
														
														echo "<input type='checkbox' class='selecao' name='permissao[".$perg_id_pergunta."][selecao]'";
															echo "value='SIM'";
															if($sel_id_pergunta == $perg_id_pergunta){ echo "checked='checked'"; }
														echo ">";	
																											
													echo "</td>";
														
													echo "<td width='7%' align='center'>".str_pad($perg_id_pergunta, 5, "0", STR_PAD_LEFT)."</td>";
													echo "<td width='90%' align='left'>".$perg_pergunta."</td>";									
												echo "</tr>";
											
											}
										
										echo "</tbody>";
									echo "</table>";
								
								}
	
								?>
							
			            	</div>
			            
				            <div class="row" style="margin-top: 10px; margin-bottom: 20px;">											
								<div class="col-xs-12 col-md-12">
									<div class="form-group" style="margin-bottom: 0px !important; text-align: center;">
										<button type="submit" class="btn btn-primary">ATUALIZAR INVENTÁRIO</button>
									</div>
								</div>											
							</div>
						
						</form>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	
          	
          	          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>