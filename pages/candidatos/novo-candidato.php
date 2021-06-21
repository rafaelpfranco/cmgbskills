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
            <h1 class="m-0 text-dark">Novo Candidato</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=listar-candidatos">Listar Candidatos</a></li>
              <li class="breadcrumb-item active">Novo Candidato</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_existe_cpf)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_existe_cpf; ?>
	</div>
	<?php endif; ?>
    
    		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<form id="LancamentoForm" method="post" role="form" action="novo-candidato-process.php?ac=cadastrar" enctype="multipart/form-data">
			
				<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />	
          	
	          	<div class="row">
	          		<div class="col-lg-12 col-12">
	          				
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">DADOS DO CANDIDATO</h3>
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
				            	<h3 class="card-title">TESTES DISPONÍVEIS</h3>
				            </div>
				                
				            <div class="card-body">
				            								    
							    <div class="row">									
									<div class="col-xs-12 col-md-12">
										
										<table style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead>
											    <tr id="title_table">
										            <th width="5%" style="text-align: center !important;"><strong></strong></th>
										            <th width="10%" style="text-align: center !important;"><strong>CÓDIGO</strong></th>	
										            <th width="85%" style="text-align: center !important;"><strong>TESTE</strong></th>
										        </tr>
									        </thead>
									        
									        <?php
						        
									        $sql_lis_con = "
									        select									
												tbl_teste.id_teste,
												tbl_teste.id_grupo_teste, 
												tbl_teste.nome_teste
												
											from
												tbl_teste
																															
											where
												data_inicio <= '$DATA_ATUAL' and 
												'$DATA_ATUAL' <= data_fim and 
												situacao = 'CADASTRADO'
																				        					
											";
										    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
										    					    
											echo "<tbody>";
											
												while($reg_lis_con = mysql_fetch_array($qry_lis_con)){
										
													$id_teste       = $reg_lis_con['id_teste'];
													$id_grupo_teste = $reg_lis_con['id_grupo_teste'];
													$nome_teste     = $reg_lis_con['nome_teste'];
													
													echo "<tr style='font-size: 14px;'>";
														
														echo "<td width='3%' align='center'>";	
																
															echo "<input type='hidden' class='id_teste' name='permissao[".$id_teste."][id_teste]'";
																echo "value='".$id_teste."'";
															echo ">";
															
															echo "<input type='checkbox' class='selecao' name='permissao[".$id_teste."][selecao]'";
																echo "value='SIM'";
																//if($sel_id_pergunta == $perg_id_pergunta){ echo "checked='checked'"; }
															echo ">";	
																												
														echo "</td>";
														
														echo "<td align='center'>".str_pad($id_teste, 5, "0", STR_PAD_LEFT)."</td>";
														echo "<td align='left'>".$nome_teste."</td>";
														
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