<?php
	
	session_start();
		
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mensalidades</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item active">Mensalidades</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
   		
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="row">									
									
				<div class="col-xs-12 col-md-12">
					
					<div class="card">
	          					
						<div class="card-header">
			            	<h3 class="card-title">MENSALIDADES</h3>
			            	<div class="card-tools">
			            		<div style="float: left; color: #666; margin-right: 20px;"></div>
			            		<ul class="nav nav-pills ml-auto">
				                    <li class="nav-item">
				                      <a class="nav-link active menu-card" href="#form-anamnese" data-toggle="tab">Histórico</a>
				                    </li>
				                    <li class="nav-item">
				                      <a class="nav-link menu-card" href="#form-sessao" data-toggle="tab">Faturas</a>
				                    </li>
			                  	</ul>
			                </div>
			                
			            </div>
				                
			            <div class="card-body">
			            	
			            	<div class="tab-content p-0">
			            		
				            	<div class="chart tab-pane active" id="form-anamnese" style="position: relative;">
			                    	<?php include("mensalidade-historico.php"); ?>  	                        
			                   	</div>
			                  
			                  	<div class="chart tab-pane" id="form-sessao" style="position: relative;">
			                    	<?php include("mensalidade-faturas.php"); ?> 	                        
			                  	</div>
			                  	
			            	</div>  
			            	
			            </div>
				            		            
			    	</div>
				
				</div>
				
			</div>
			  	          	
    	</div>
    </section>
    
    <!-- /.content -->
    
    <?php include ("../../rodape.php"); ?>
    
  </div>