<?php
	
	session_start();
	
	if(isset($_SESSION['msg_existe_cpf'])){
		$msg_existe_cpf = $_SESSION['msg_existe_cpf'];
		unset($_SESSION['msg_existe_cpf']);
	}
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Novo Usuário</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=usuarios">Usuários</a></li>
              <li class="breadcrumb-item active">Novo Usuário</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_existe_cpf)): ?>
	<div class="alert alert-dismissable alert-danger">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_existe_cpf; ?>
	</div>
	<?php endif; ?>
    
    		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<form id="LancamentoForm" method="post" role="form" action="novo-usuario-process.php?ac=cadastrar" enctype="multipart/form-data">
			
				<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />	
          	
	          	<div class="row">
	          		<div class="col-lg-12 col-12">
	          				
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">DADOS DO USUÁRIO</h3>
				            </div>
				                
				            <div class="card-body">
				            	
				            	<div class="row">									
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="cpf">CPF <span style="color: #f08080;">*</span></label> 
											<input type="text" class="form-control" id="cpf" name="cpf" required onKeyUp="numcpf(this);" maxlength="14" style="text-align: center;" />
									  	</div>
									</div>
									<div class="col-xs-12 col-md-9">
										<div class="form-group">
											<label for="nome">Nome <span style="color: #f08080;">*</span></label> 
											<input type="text" class="form-control" id="nome" name="nome" required />
									  	</div>
									</div>																							
							    </div>
							    
							    <div class="row">									
									<div class="col-xs-12 col-md-6">
										<div class="form-group">
											<label for="email">Email <span style="color: #f08080;">*</span></label> 
											<input type="text" class="form-control" id="email" name="email" required />
									  	</div>
									</div>
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="telefone_1">Telefone 1 <span style="color: #f08080;">*</span></label>
											<input type="text" class="form-control" id="telefone_1" name="telefone_1" required onKeyUp="mtel(this);" maxlength="14" style="text-align: center;" />
									  	</div>
									</div>
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="telefone_2">Telefone 2</label>
											<input type="text" class="form-control" id="telefone_2" name="telefone_2" onKeyUp="mtel(this);" maxlength="14" style="text-align: center;" />
									  	</div>
									</div>																							
							    </div>
							    							    
				            </div>
				            					        	          				
	          			</div>
		          			
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">CARGOS(S) DO USUÁRIO</h3>
				            </div>
				                
				            <div class="card-body">
				            								    
							    <div class="row">									
									<div class="col-xs-12 col-md-12">
										
										<table style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead>
											    <tr id="title_table">
										            <th width="5%" style="text-align: center !important;"><strong></strong></th>
										            <th width="95%" style="text-align: center !important;"><strong>CARGO</strong></th>
										        </tr>
									        </thead>
									        
									        <?php
						        
									        $sql_lis_con = "
									        select									
												id_cargo, 
												cargo 
												
											from
												tbl_cargo 
																															
											order by 
												ordem asc
																				        					
											";
										    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
										    					    
											echo "<tbody>";
											
												while($reg_lis_con = mysql_fetch_array($qry_lis_con)){
										
													$id_cargo = $reg_lis_con['id_cargo'];
													$cargo    = $reg_lis_con['cargo'];
													
													echo "<tr style='font-size: 14px;'>";
														
														echo "<td width='3%' align='center'>";	
																
															echo "<input type='hidden' class='id_cargo' name='permissao[".$id_cargo."][id_cargo]'";
																echo "value='".$id_cargo."'";
															echo ">";
															
															echo "<input type='checkbox' class='selecao' name='permissao[".$id_cargo."][selecao]'";
																echo "value='SIM'";
																//if($sel_id_pergunta == $perg_id_pergunta){ echo "checked='checked'"; }
															echo ">";	
																												
														echo "</td>";
														
														echo "<td align='left'>".$cargo."</td>";
														
													echo "</tr>";
													
												}
												
											echo "</tbody>";
											
											?>
									        
										</table>
																				
									</div>																						
							    </div>
							    
				            </div>
				            					        	          				
	          			</div>
		          			
	          			<div class="card">
	          				<div class="card-footer" style="text-align: center;">
	                  			<button type="submit" class="btn-primary">CADASTRAR</button>
	                		</div>
	          			</div>
	          				          			
	          		</div>
	          	</div>
          	
          </form>
          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>