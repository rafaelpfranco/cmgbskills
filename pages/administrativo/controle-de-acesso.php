<?php
	
	session_start();
	
	if(isset($_SESSION['msg_edita_controle_acesso'])){
		$msg_edita_controle_acesso = $_SESSION['msg_edita_controle_acesso'];
		unset($_SESSION['msg_edita_controle_acesso']);
	}
	
	
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Controle de Acesso</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Controle de Acesso</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_edita_controle_acesso)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edita_controle_acesso; ?>
	</div>
	<?php endif; ?>
	
	
			
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		          	
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title">CONTROLE DE ACESSO</h3>
			            </div>
			            
			            <form id="NovoSetorForm" data-toggle="validator" method="post" role="form" action="controle-de-acesso-process.php?ac=cadastrar" enctype="multipart/form-data">
			  				
			            	<div class="card-body">
			            	
			            	
			            	
				            	<?php
				            	
				            	$sql_grupo = "
							    SELECT
									id_cargo, 
									cargo 
								
								FROM	
									tbl_cargo
								
								WHERE
									bloqueado = 'F' 
								
								ORDER BY
									ordem asc 
																	        					
								";
							    $qry_grupo = mysql_query($sql_grupo) or die ("Erro 4: ".mysql_error());
							    
							    $item = 1;
								
							    while($reg_grupo = mysql_fetch_array($qry_grupo)){
							
									$cg_id_cargo = $reg_grupo['id_cargo'];
									$cg_cargo    = $reg_grupo['cargo'];
					            	
					            	echo "<div class='card-titulo-form'>".$cg_cargo."</div>";
					            	
									echo "<table class='table table-striped table-bordered table-hover' cellspacing='0' width='100%' style='margin-bottom: 20px;'>";
										echo "<tbody>";
										
											$sql_perg = "
										    SELECT
												id_permissao, 
												permissao  
											
											FROM	
												tbl_permissao 
											
											WHERE
												bloqueado = 'F'
											
											ORDER BY
												id_permissao asc 
																				        					
											";
										    $qry_perg = mysql_query($sql_perg) or die ("Erro 4: ".mysql_error());
										    
											while($reg_perg = mysql_fetch_array($qry_perg)){
								
												$per_id_permissao = $reg_perg['id_permissao'];
												$per_permissao    = $reg_perg['permissao'];
												
												$sql_sel = "
											    SELECT
													id_permissao  
												
												FROM	
													tbl_cargo_permissao 
												
												WHERE
													id_cargo = '$cg_id_cargo' and 
													id_permissao = '$per_id_permissao'
																					        					
												";
											    $qry_sel = mysql_query($sql_sel) or die ("Erro 4: ".mysql_error());
											    $reg_sel = mysql_fetch_array($qry_sel);
											    
											    $sel_id_permissao = $reg_sel['id_permissao'];
										
												echo "<tr style='font-size: 14px;'>";
													
													echo "<td width='5%' align='center'>";	
														
														echo "<input type='hidden' class='id_cargo' name='permissao[".$item."][id_cargo]'";
															echo "value='".$cg_id_cargo."'";
														echo ">";
														
														echo "<input type='hidden' class='id_permissao' name='permissao[".$item."][id_permissao]'";
															echo "value='".$per_id_permissao."'";
														echo ">";
														
														echo "<input type='checkbox' class='selecao' name='permissao[".$item."][selecao]'";
															echo "value='SIM'";
															if($sel_id_permissao == $per_id_permissao){ echo "checked='checked'"; }
														echo ">";	
																											
													echo "</td>";
														
													echo "<td width='95%' align='left'>".$per_permissao."</td>";									
												echo "</tr>";
												
												$item = $item + 1;
											
											}
										
										echo "</tbody>";
									echo "</table>";
								
								}
	
								?>
							
			            	</div>
			            
				            <div class="row" style="margin-top: 10px; margin-bottom: 20px;">											
								<div class="col-xs-12 col-md-12">
									<div class="form-group" style="margin-bottom: 0px !important; text-align: center;">
										<button type="submit" class="btn btn-primary">ATUALIZAR</button>
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