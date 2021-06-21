<?php
	
	session_start();
	
	
	$get_id_candidato_teste = $_GET['id'];
	
	$sql_lis_con = "
    select									
		tbl_candidato_teste.id_candidato_teste, 
		tbl_candidato_teste.id_candidato,
		tbl_candidato_teste.id_teste, 
		date_format(tbl_candidato_teste.data_contratado, '%d/%m/%Y') as data_contratado, 
		
		tbl_candidato.cpf, 
		tbl_candidato.nome, 
		tbl_candidato.email, 
		tbl_candidato.telefone_1, 
		tbl_candidato.telefone_2		 
		
	from
		tbl_candidato_teste
		
		left join tbl_candidato 
		on tbl_candidato_teste.id_candidato = tbl_candidato.id_candidato 
																		
	where
		tbl_candidato_teste.id_candidato_teste = '$get_id_candidato_teste' and 
		tbl_candidato_teste.situacao = 'LIBERADO' and 
		tbl_candidato_teste.situacao_teste = 'CADASTRADO' 
										        					
	";
    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
    $reg_lis_con = mysql_fetch_array($qry_lis_con);

	$tst_id_candidato_teste = $reg_lis_con['id_candidato_teste'];
	$tst_id_candidato       = $reg_lis_con['id_candidato'];
	$tst_id_teste           = $reg_lis_con['id_teste'];
	$tst_data_contratado    = $reg_lis_con['data_contratado'];
	
	$tst_cpf        = $reg_lis_con['cpf'];
	$tst_nome       = $reg_lis_con['nome'];
	$tst_email      = $reg_lis_con['email'];
	$tst_telefone_1 = $reg_lis_con['telefone_1'];
	$tst_telefone_2 = $reg_lis_con['telefone_2'];
	
	
	//////////////////
	$sql_ts = "
    select									
		nome_teste		 
		
	from
		tbl_teste
																		
	where
		id_teste = '$tst_id_teste' 
										        					
	";
    $qry_ts = mysql_query($sql_ts) or die ("Erro 4: ".mysql_error());
    $reg_ts = mysql_fetch_array($qry_ts);

	$tst_nome_teste = $reg_ts['nome_teste'];
	
	
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Desfazer Autorização</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=liberado">Liberado</a></li>
              <li class="breadcrumb-item active">Desfazer Autorização</li>
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
          			
          			<form id="LancamentoForm" method="post" role="form" action="desfazer-liberacao-process.php?ac=alterar" enctype="multipart/form-data">
			
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
						<input type="hidden" id="id_candidato_teste" name="id_candidato_teste" value="<?php echo $tst_id_candidato_teste; ?>" />
						
	          			<div class="card">
	          				
							<div class="card-header">
				            	<h3 class="card-title">DADOS DO TESTE</h3>
				            </div>
				                
				            <div class="card-body">
				            	
				            	<div class="row">									
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="nome_teste">CPF</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" value="<?php echo $tst_cpf; ?>" />
									  	</div>
									</div>	
									<div class="col-xs-12 col-md-9">
										<div class="form-group">
											<label for="nome_teste">Nome</label> 
											<input type="text" class="form-control" readonly value="<?php echo $tst_nome; ?>" />
									  	</div>
									</div>																						
							    </div>
							    
							    <div class="row">									
									<div class="col-xs-12 col-md-6">
										<div class="form-group">
											<label for="nome_teste">Email</label> 
											<input type="text" class="form-control" readonly value="<?php echo $tst_email; ?>" />
									  	</div>
									</div>	
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="nome_teste">Telefone 1</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" value="<?php echo $tst_telefone_1; ?>" />
									  	</div>
									</div>
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<label for="nome_teste">Telefone 2</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" value="<?php echo $tst_telefone_2; ?>" />
									  	</div>
									</div>																						
							    </div>
							    
							    <div class="row">									
									<div class="col-xs-12 col-md-2">
										<div class="form-group">
											<label for="nome_teste">Data Contratado</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" value="<?php echo $tst_data_contratado; ?>" />
									  	</div>
									</div>	
									<div class="col-xs-12 col-md-10">
										<div class="form-group">
											<label for="nome_teste">Nome Teste</label> 
											<input type="text" class="form-control" readonly value="<?php echo $tst_nome_teste; ?>" />
									  	</div>
									</div>																			
							    </div>
				            	
				            </div>
				        
	          				<div class="card-footer" style="text-align: center;">
	                  			<button type="submit" class="btn-primary">DESFAZER LIBERAÇÃO</button>
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