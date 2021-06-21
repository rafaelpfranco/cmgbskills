<?php
	
	session_start();
	
	if(isset($_SESSION['msg_novo_teste'])){
		$msg_novo_teste = $_SESSION['msg_novo_teste'];
		unset($_SESSION['msg_novo_teste']);
	}
	
	if(isset($_SESSION['msg_edita_teste'])){
		$msg_edita_teste = $_SESSION['msg_edita_teste'];
		unset($_SESSION['msg_edita_teste']);
	}
	
	if(isset($_SESSION['msg_exclui_teste'])){
		$msg_exclui_teste = $_SESSION['msg_exclui_teste'];
		unset($_SESSION['msg_exclui_teste']);
	}
		
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perguntas</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Perguntas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_novo_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_novo_teste; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_edita_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_edita_teste; ?>
	</div>
	<?php endif; ?>
	
	<?php if(isset($msg_exclui_teste)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_exclui_teste; ?>
	</div>
	<?php endif; ?>
			
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		    		
          	<!-- LISTA DE INGREDIENTES CADASTRADOS -->
          	<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
          				
						<div class="card-header">
			            	<h3 class="card-title">GRUPOS CADASTRADOS</h3>
			            	<h3 class="card-title" style="float: right; color: #666;">
			            		<a href="index.php?pg=grupo-pergunta" class="btn btn-info btn-xs" style="padding: 5px 20px; margin-left: 5px;">GERENCIAR GRUPO</a>
			            	</h3>
			            </div>
				            
			            <div class="card-body">
			            
			            	<table id="example1" style="font-size: 10px !important;" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
								    <tr id="title_table">
							            <th width="5%" style="text-align: center !important;"><strong>CÓDIGO</strong></th>
							            <th width="82%" style="text-align: center !important;"><strong>GRUPO</strong></th>
							            <th width="10%" style="text-align: center !important;"><strong>QTDE</strong></th>	
							            <th width="3%" style="text-align: center !important;"><strong></strong></th>
							        </tr>
						        </thead>
						        
						        <?php
						        
						        $sql_lis_con = "
						        select	
						        	tbl_grupo_pergunta.id_grupo_pergunta, 								
									tbl_grupo_pergunta.grupo_pergunta, 
									tbl_grupo_pergunta.descricao, 
									tbl_grupo_pergunta.bloqueado,
									
									(
									select count(tbl_pergunta.id_pergunta) from tbl_pergunta
									where tbl_grupo_pergunta.id_grupo_pergunta = tbl_pergunta.id_grupo_pergunta and
									tbl_pergunta.situacao = 'CADASTRADO'
									
									) as qtde_pergunta 
									
								from
									tbl_grupo_pergunta
																
								where
									tbl_grupo_pergunta.SITUACAO = 'CADASTRADO'
																	        					
								";
							    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
							    					    
								echo "<tbody>";
								
									while($reg_lis_con = mysql_fetch_array($qry_lis_con)){
							
										$grp_id_grupo_pergunta = $reg_lis_con['id_grupo_pergunta'];
										$grp_grupo_pergunta	   = $reg_lis_con['grupo_pergunta'];
										$grp_descricao         = $reg_lis_con['descricao'];
										$grp_bloqueado         = $reg_lis_con['bloqueado'];
										$grp_qtde_pergunta     = $reg_lis_con['qtde_pergunta'];
																																																		
										echo "<tr style='font-size: 14px;'>";
									
											echo "<td align='center'>".str_pad($grp_id_grupo_pergunta, 5, "0", STR_PAD_LEFT)."</td>";
											echo "<td align='left'>".$grp_grupo_pergunta."</td>";
											echo "<td align='center'>".$grp_qtde_pergunta."</td>";
											
											echo "<td align='center'>";
												echo "<a href='index.php?pg=listar-perguntas&id=".$grp_id_grupo_pergunta."'><i class='fas fa-list'></i></a>";
											echo "</td>";
											
										echo "</tr>";
																		
									}
									
								echo "</tbody>";
								
								?>
						        
							</table>
			            
			            </div>
			            
			            <div class="card-body" style="font-size: 12px; border-top: 1px solid #ccc; text-align: right;">
			            	
			            	<i class='fas fa-list' style="font-size: 12px; margin-left: 10px;"></i> listar perguntas 
			            	
			            </div>
							          				
          			</div>
          			
          		</div>
          	</div>
          	
          	
          	          	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>