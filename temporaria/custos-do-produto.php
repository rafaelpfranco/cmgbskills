<?php
	
	session_start();
	
	$ID_FICHA_TECNICA = $_POST['id_ficha_tecnica'];
	$ID_PRODUTO       = $_POST['id_produto'];
	$ID_EMPRESA       = $_POST['id_empresa'];	
	
	$sql_ingred = "
    select
		tbl_produto.ID_PRODUTO,
		tbl_produto.ID_EMPRESA,
		tbl_produto.CODIGO_PRODUTO,
		tbl_produto.PRODUTO, 
		PRECO_CUSTO_KG, 
		PRECO_CUSTO_PORCAO, 
		
		VD_PTC_MARKUP, 
		BC_PTC_MARKUP  
		
	from
		tbl_produto
									
	where
		ID_EMPRESA = '$Emp_ID_EMPRESA' and
		BLOQUEADO = 'F' and
		SITUACAO = 'CADASTRADO'
																        					
	";
    $qry_ingred = mysql_query($sql_ingred) or die ("Erro 4: ".mysql_error());
    $reg_ingred = mysql_fetch_array($qry_ingred);

	$CONT_ID_PRODUTO 	 = $reg_ingred['ID_PRODUTO'];
	$CONT_ID_EMPRESA 	 = $reg_ingred['ID_EMPRESA'];										
	$CONT_CODIGO_PRODUTO = $reg_ingred['CODIGO_PRODUTO'];
	$CONT_PRODUTO 		 = $reg_ingred['PRODUTO'];
	
	$CONT_PRECO_CUSTO_KG     = $reg_ingred['PRECO_CUSTO_KG'];
	$CONT_PRECO_CUSTO_PORCAO = $reg_ingred['PRECO_CUSTO_PORCAO'];
	
	$CONT_VD_PTC_MARKUP = $reg_ingred['VD_PTC_MARKUP'];
	$CONT_BC_PTC_MARKUP = $reg_ingred['BC_PTC_MARKUP'];
	
//	$PRECO_CUSTO_KG       = $_POST['preco_custo_kg'];
//	$PRECO_CUSTO_PORCAO   = $_POST['preco_custo_porcao'];
	
//	$VD_MARKUP = $_POST['vd_markup'];
//	$BC_MARKUP = $_POST['bc_markup'];
		
	if(isset($_POST['ac']) && $_POST['ac'] == "editar"){
		
		$tempo_preparo 	= $_POST['tempo_preparo'];
		$tempo_coccao 	= $_POST['tempo_coccao'];
				
		$peso_porcao 	= str_replace(',','.',str_replace('.','',$_POST['peso_porcao']));
		$peso_cozido 	= str_replace(',','.',str_replace('.','',$_POST['peso_cozido']));
		$peso_real 		= str_replace(',','.',str_replace('.','',$_POST['peso_real']));
		
		//////
		$sql_del_igr = " DELETE FROM tbl_ficha_tecnica_ingrediente WHERE ID_FICHA_TECNICA = '$ID_FICHA_TECNICA' ";
		$qry_del_igr = mysql_query($sql_del_igr) or die ("Erro 1: ".mysql_error());		
		
		
		for($i = 0; $i < count($_POST["ingrediente"]); $i++) {
				
			$linha1 = $_POST["ingrediente"][$i];
			$arr1   = explode('_',$linha1);
			
			$ID_INGREDIENTE      = $arr1[0];
			$CODIGO_INGREDIENTE  = $arr1[1];
			$INGREDIENTE         = $arr1[2];
			$PRECO_INGREDIENTE   = $arr1[3];
						
						
			$linha2     = $_POST["peso_bruto"][$i];
			$arr2       = explode('-',$linha2);			
			$PESO_BRUTO = str_replace(',','.',str_replace('.','',$arr2[0]));
									
			$linha3       = $_POST["peso_liquido"][$i];
			$arr3         = explode('-',$linha3);			
			$PESO_LIQUIDO = str_replace(',','.',str_replace('.','',$arr3[0]));
			
			$FC 					= $PESO_BRUTO / $PESO_LIQUIDO;
			$PESO_TOTAL 			= $PESO_LIQUIDO;
			$CUSTO_POR_INGREDIENTE 	= ($PESO_BRUTO * $PRECO_INGREDIENTE) / 1.000;
			$CUSTO_UNITARIO			= ($PESO_BRUTO * $PRECO_INGREDIENTE) / 1.000;
			
			//echo $INGREDIENTE." - ".$PESO_BRUTO." - ".$PESO_LIQUIDO." - ".$FC." - ".$PESO_TOTAL." - ".$CUSTO_POR_INGREDIENTE." - ".$PRECO_INGREDIENTE." - ".$CUSTO_UNITARIO."<br/>";
			
			$CUSTO_TOTAL_RECEITA += $CUSTO_POR_INGREDIENTE;
			$PESO_TOTAL_ACUMULADO += $PESO_TOTAL;
			
			$sql_ins_igr = "
			INSERT INTO tbl_ficha_tecnica_ingrediente ( 
			
			ID_FICHA_TECNICA_INGREDIENTE,
			ID_FICHA_TECNICA, ID_INGREDIENTE, CODIGO_INGREDIENTE, INGREDIENTE, 
			PESO_BRUTO, PESO_LIQUIDO, FC, PESO_TOTAL, 
			CUSTO_POR_INGREDIENTE, PRECO_KG, CUSTO_UNITARIO, 
			DATA_CADASTRO
			
			)
			VALUES ( 
			
			null, 
			'$ID_FICHA_TECNICA', '$ID_INGREDIENTE', '$CODIGO_INGREDIENTE', '$INGREDIENTE', 
			'$PESO_BRUTO', '$PESO_LIQUIDO', '$FC', '$PESO_TOTAL', 
			'$CUSTO_POR_INGREDIENTE', '$PRECO_INGREDIENTE', '$CUSTO_UNITARIO', 
			now()
								
			)
			";
			$qry_ins_igr = mysql_query($sql_ins_igr) or die ("Erro 11: ".mysql_error());
			
		
		}

		$RENDIMENTO   = ($peso_real / $peso_cozido);
		$CUSTO_PORCAO = ($CUSTO_TOTAL_RECEITA / $RENDIMENTO);
		$CUSTO_KG     = ($CUSTO_PORCAO * 1.000) / $peso_cozido;
		$FATOR_COCCAO = ($peso_real / $PESO_TOTAL_ACUMULADO);
		$PERDA_GANHO  = (1 - $FATOR_COCCAO);
		
		/// UPDATE
		$sql_upd_igr = "
		
		UPDATE tbl_ficha_tecnica SET 
		
		RENDIMENTO          = CASE WHEN '$RENDIMENTO' <> '' THEN '$RENDIMENTO' ELSE null END, 
		CUSTO_TOTAL_RECEITA = CASE WHEN '$CUSTO_TOTAL_RECEITA' <> '' THEN '$CUSTO_TOTAL_RECEITA' ELSE null END,
		
		TEMPO_PREPARO = CASE WHEN '$tempo_preparo' <> '' THEN '$tempo_preparo' ELSE null END,
		TEMPO_COCCAO  = CASE WHEN '$tempo_coccao' <> '' THEN '$tempo_coccao' ELSE null END,
		
		PESO_PORCAO = CASE WHEN '$peso_porcao' <> '' THEN '$peso_porcao' ELSE null END, 
		PESO_COZIDO = CASE WHEN '$peso_cozido' <> '' THEN '$peso_cozido' ELSE null END, 
		PESO_REAL   = CASE WHEN '$peso_real' <> '' THEN '$peso_real' ELSE null END,
		
		CUSTO_PORCAO = CASE WHEN '$CUSTO_PORCAO' <> '' THEN '$CUSTO_PORCAO' ELSE null END,
		CUSTO_KG     = CASE WHEN '$CUSTO_KG' <> '' THEN '$CUSTO_KG' ELSE null END,
		FATOR_COCCAO = CASE WHEN '$FATOR_COCCAO' <> '' THEN '$FATOR_COCCAO' ELSE null END,
		PERDA_GANHO  = CASE WHEN '$PERDA_GANHO' <> '' THEN '$PERDA_GANHO' ELSE null END,
		PESO_TOTAL   = CASE WHEN '$PESO_TOTAL_ACUMULADO' <> '' THEN '$PESO_TOTAL_ACUMULADO' ELSE null END
										
		WHERE 
		ID_FICHA_TECNICA = '$ID_FICHA_TECNICA' and 
		ID_EMPRESA = '$ID_EMPRESA'
	
		";
		$qry_upd_igr = mysql_query($sql_upd_igr) or die ("Erro 12: ".mysql_error());
		
		
		/// CALCULOS VD
		$vd_sug_preco_kg     = (($VD_MARKUP / 100) * $CUSTO_KG) + $CUSTO_KG;
		$vd_sug_preco_porcao = (($VD_MARKUP / 100) * $CUSTO_PORCAO) + $CUSTO_PORCAO;
		
		
		/// CALCULOS BC
		$bc_sug_preco_kg     = (($BC_MARKUP / 100) * $CUSTO_KG) + $CUSTO_KG;
		$bc_sug_preco_porcao = (($BC_MARKUP / 100) * $CUSTO_PORCAO) + $CUSTO_PORCAO;
		
				
		///
		$sql_upd_igr = "
		
		UPDATE tbl_produto SET 
		
		PRECO_CUSTO_KG     = CASE WHEN '$CUSTO_KG' <> '' THEN '$CUSTO_KG' ELSE null END, 
		PRECO_CUSTO_PORCAO = CASE WHEN '$CUSTO_PORCAO' <> '' THEN '$CUSTO_PORCAO' ELSE null END, 
		
		VD_SUG_PRECO_KG = CASE WHEN '$CUSTO_KG' <> '' THEN '$vd_sug_preco_kg' ELSE null END,
		VD_SUG_PRECO_PORCAO = CASE WHEN '$CUSTO_PORCAO' <> '' THEN '$vd_sug_preco_porcao' ELSE null END,
		
		BC_SUG_PRECO_KG = CASE WHEN '$CUSTO_KG' <> '' THEN '$bc_sug_preco_kg' ELSE null END,
		BC_SUG_PRECO_PORCAO = CASE WHEN '$CUSTO_PORCAO' <> '' THEN '$bc_sug_preco_porcao' ELSE null END
												
		WHERE 
		ID_PRODUTO = '$ID_PRODUTO' and 
		ID_EMPRESA = '$ID_EMPRESA'
	
		";
		$qry_upd_igr = mysql_query($sql_upd_igr) or die ("Erro 12: ".mysql_error());
		
		
		
		$msg_editar_custo = 'Custos do produto atualizados com sucesso no sistema.';	
		
	}
	
	$sql_ing = "
    select
		ID_FICHA_TECNICA, ID_EMPRESA, ID_PRODUTO, CODIGO_PRODUTO, PRODUTO, 
		TEMPO_PREPARO, TEMPO_COCCAO, PESO_PORCAO, PESO_COZIDO, PESO_REAL
		
	from
		tbl_ficha_tecnica
									
	where
		ID_EMPRESA = '$ID_EMPRESA' and
		ID_PRODUTO = '$ID_PRODUTO' and		
		BLOQUEADO = 'F' and
		SITUACAO = 'CADASTRADO'
									        					
	";
    $qry_ing = mysql_query($sql_ing) or die ("Erro 4: ".mysql_error());
    $reg_ing = mysql_fetch_array($qry_ing);

	$PROD_ID_FICHA_TECNICA = $reg_ing['ID_FICHA_TECNICA'];	
	$PROD_ID_EMPRESA       = $reg_ing['ID_EMPRESA'];	
	$PROD_ID_PRODUTO  	   = $reg_ing['ID_PRODUTO'];	
	$PROD_CODIGO_PRODUTO   = $reg_ing['CODIGO_PRODUTO'];
	$PROD_NOME_PRODUTO	   = $reg_ing['PRODUTO'];
	
	$PROD_TEMPO_PREPARO	   = $reg_ing['TEMPO_PREPARO'];
	$PROD_TEMPO_COCCAO	   = $reg_ing['TEMPO_COCCAO'];
	$PROD_PESO_PORCAO	   = $reg_ing['PESO_PORCAO'];
	$PROD_PESO_COZIDO	   = $reg_ing['PESO_COZIDO'];
	$PROD_PESO_REAL 	   = $reg_ing['PESO_REAL'];
	

?>

<script src="../../jquery-ui/development-bundle/jquery-1.9.1.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>

<script type="text/javascript">
	(function($) {

  RemoveTableRow = function(handler) {
    var tr = $(handler).closest('tr');

    tr.fadeOut(400, function(){ 
      tr.remove(); 
    }); 

    return false;
  };
  
  var count = 5;
	$('#addCount').click(function(){
	  alert(count);
	  count++;
	});
  
  var count = 1;
  AddTableRow = function() {
      
      count++;
      
      var newRow = $("<tr>");
      var cols = "";
      
      cols += '<td><select name="ingrediente[]-' + count +'" id="ingrediente" required class="form-control"><option value="">selecione</option><?php $sql_la = " SELECT ID_INGREDIENTE, CODIGO_INGREDIENTE, INGREDIENTE, PRECO_KG FROM tbl_ingrediente WHERE ID_EMPRESA = '$PROD_ID_EMPRESA' and BLOQUEADO = 'F' and SITUACAO = 'CADASTRADO' ORDER BY INGREDIENTE ASC "; $qry_la = mysql_query($sql_la) or die(mysql_error()); while($ln_la = mysql_fetch_assoc($qry_la)){ ?><option value="<?php echo $ln_la['ID_INGREDIENTE']."_".$ln_la['CODIGO_INGREDIENTE']."_".$ln_la['INGREDIENTE']."_".$ln_la['PRECO_KG']; ?>"><?php echo $ln_la['INGREDIENTE']; ?></option><?php } ?></select></td>';      
      cols += '<td><input type="text" name="peso_bruto[]-' + count +'" id="peso_bruto" class="form-control" maxlength="7" style="text-align: right;" onKeyUp="peso(this);" ></td>';
      cols += '<td><input type="text" name="peso_liquido[]-' + count +'" id="peso_liquido" class="form-control" maxlength="7" style="text-align: right;" onKeyUp="peso(this);" ></td>';
      
      cols += '<td class="actions" style="text-align: center !important;">';
      cols += '<button class="btn btn-xs btn-danger"  onclick="RemoveTableRow(this)" type="button">REMOVER</button>';
      cols += '</td>';
      
      newRow.append(cols);
      
      $("#products-table").append(newRow);
    
      return false;
  };
  
})(jQuery);
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php //include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Custos do Produto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=lista-de-produtos">Lista de Produtos</a></li>
              <li class="breadcrumb-item active">Custos do Produto</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <?php if(isset($msg_editar_custo)): ?>
	<div class="alert alert-dismissable alert-success">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo $msg_editar_custo; ?>
	</div>
	<?php endif; ?>
	
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		
    		<div class="row">
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
          				
          				<form id="LancamentoForm" method="post" role="form" action="index.php?pg=custos-do-produto" enctype="multipart/form-data" style="margin-bottom: 0;">
						
							<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $Fun_Id; ?>" />
							<input type="hidden" id="id_empresa" name="id_empresa" value="<?php echo $Emp_ID_EMPRESA; ?>" />
							<input type="hidden" id="id_produto" name="id_produto" value="<?php echo $PROD_ID_PRODUTO; ?>" />
							<input type="hidden" id="id_ficha_tecnica" name="id_ficha_tecnica" value="<?php echo $PROD_ID_FICHA_TECNICA; ?>" />
							<input type="hidden" id="ac" name="ac" value="editar" />
							
							<input type="hidden" id="preco_custo_kg" name="preco_custo_kg" value="<?php echo $PRECO_CUSTO_KG; ?>" />
							<input type="hidden" id="preco_custo_porcao" name="preco_custo_porcao" value="<?php echo $PRECO_CUSTO_PORCAO; ?>" />
							
							<input type="hidden" id="vd_markup" name="vd_markup" value="<?php echo $VD_MARKUP; ?>" />
							<input type="hidden" id="bc_markup" name="bc_markup" value="<?php echo $BC_MARKUP; ?>" />
							
							<div class="card-header">
				            	<h3 class="card-title">CUSTOS DO PRODUTO</h3>
				            </div>
				            
				            <div class="card-body">
				            		
			                	<div class="row">
				            		<div class="col-xs-12 col-md-2">
										<div class="form-group">
											<label for="codigo_produto">Código</label> 
											<input type="text" class="form-control" readonly style="text-align: center;" value="<?php echo str_pad($PROD_CODIGO_PRODUTO, 5, "0", STR_PAD_LEFT); ?>" >
									  	</div>
									</div>
									<div class="col-xs-12 col-md-10">
										<div class="form-group">
											<label for="nome_produto">Produto</label> 
											<input type="text" class="form-control" readonly value="<?php echo $PROD_NOME_PRODUTO; ?>" >
									  	</div>
									</div>	
								</div>
								
								<div class="row">
									
									<div class="col-xs-12 col-md-5" style="padding-right: 20px;">
									
										<p id="title_box">TEMPO</p>
										
										<div class="row">	
											
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
													<label for="tempo_preparo">Tempo preparo</label>
											    	<input type="text" class="form-control" id="tempo_preparo" name="tempo_preparo" maxlength="5" style="text-align: center;" onKeyUp="horas(this);" value="<?php echo $PROD_TEMPO_PREPARO; ?>"  >
											  	</div>
											</div>
											
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
													<label for="tempo_coccao">Tempo cocção</label>
											    	<input type="text" class="form-control" id="tempo_coccao" name="tempo_coccao" maxlength="5" style="text-align: center;" onKeyUp="horas(this);" value="<?php echo $PROD_TEMPO_COCCAO; ?>"  >
											  	</div>
											</div>
																										
										</div>
									
									</div>
									
									<div class="col-xs-12 col-md-7" style="padding-right: 20px;">
										
										<p id="title_box">PESO</p>
								
										<div class="row">	
											
											<div class="col-xs-12 col-md-4">
												<div class="form-group">
													<label for="peso_porcao">Peso porção crua (kg) <span style="color: #ff8080;">*</span></label>
											    	<input type="text" class="form-control" required id="peso_porcao" name="peso_porcao" maxlength="9" style="text-align: right;" onKeyUp="peso(this);" value="<?php echo formata_peso_g($PROD_PESO_PORCAO); ?>"  >
											  	</div>
											</div>
											
											<div class="col-xs-12 col-md-4">
												<div class="form-group">
													<label for="peso_cozido">Peso porção pronta (kg) <span style="color: #ff8080;">*</span></label>
											    	<input type="text" class="form-control" required id="peso_cozido" name="peso_cozido" maxlength="9" style="text-align: right;" onKeyUp="peso(this);" value="<?php echo formata_peso_g($PROD_PESO_COZIDO); ?>"  >
											  	</div>
											</div>
											
											<div class="col-xs-12 col-md-4">
												<div class="form-group">
													<label for="peso_real">Peso real receita completa (kg) <span style="color: #ff8080;">*</span></label>
											    	<input type="text" class="form-control" required id="peso_real" name="peso_real" maxlength="9" style="text-align: right;" onKeyUp="peso(this);" value="<?php echo formata_peso_g($PROD_PESO_REAL); ?>"  >
											  	</div>
											</div>
																											
										</div>
										
									</div>
									
								</div>
								
								<div class="row">	
									
									<div class="col-xs-12 col-md-12">
										
										<p id="title_box">INGREDIENTES</p>
										
										<table id="products-table" class="table table-striped table-bordered table-hover" style="font-size: 10px !important; margin-bottom: 10px;" cellspacing="0" width="100%">
												
											<thead>
												<tr style="color:#666699; font-size: 10px !important;">
													<th width="40%" style="text-align: center !important;"><strong>INGREDIENTE <span style="color: #f08080;">*</span></strong></th>
													<th width="20%" style="text-align: center !important;"><strong>PESO BRUTO (kg/L) <span style="color: #f08080;">*</span></strong></th>
													<th width="20%" style="text-align: center !important;"><strong>PESO LÍQUIDO (kg/L) <span style="color: #f08080;">*</span></strong></th>
													<th width="20%" style="text-align: center !important;"><strong></strong></th>
												</tr>
											</thead>
										
											<tbody>
												
												<?php
												
												$sql_lc = "
						                     	SELECT 
													ID_INGREDIENTE,
													CODIGO_INGREDIENTE,
													INGREDIENTE,
													PESO_BRUTO,
													PESO_LIQUIDO
												FROM 
													tbl_ficha_tecnica_ingrediente
												WHERE 
													ID_FICHA_TECNICA = '$PROD_ID_FICHA_TECNICA'
												";
						                        $qry_lc = mysql_query($sql_lc) or die(mysql_error());
												
												$count = 0;
												
						                        while($ln_lc = mysql_fetch_assoc($qry_lc)){
						                        
						                        	$FTI_ID_INGREDIENTE 	= $ln_lc['ID_INGREDIENTE'];
													$FTI_CODIGO_INGREDIENTE = $ln_lc['CODIGO_INGREDIENTE'];
													$FTI_INGREDIENTE 		= $ln_lc['INGREDIENTE'];
													$FTI_PESO_BRUTO 		= $ln_lc['PESO_BRUTO'];
													$FTI_PESO_LIQUIDO 		= $ln_lc['PESO_LIQUIDO'];
													
													$count ++;
													
													?>
												
												<tr>
													<td>
														<select class="form-control" name="ingrediente[]-<?php echo $count; ?>" id="ingrediente" required class="form-control" >
															<option value="">selecione</option>
												    		
												    		<?php
												    		$sql_lis_ing = "
													        select
																ID_INGREDIENTE,
																CODIGO_INGREDIENTE,
																INGREDIENTE,
																PRECO_KG
																
															from
																tbl_ingrediente
																							
															where
																ID_EMPRESA = '$PROD_ID_EMPRESA' and
																BLOQUEADO = 'F' and
																SITUACAO = 'CADASTRADO'
															
															order by
																INGREDIENTE asc		
																						        					
															";
														    $qry_lis_ing = mysql_query($sql_lis_ing) or die ("Erro 4: ".mysql_error());
														    					    
															while($reg_lis_ing = mysql_fetch_array($qry_lis_ing)){
														
																	$ING_ID_INGREDIENTE      = $reg_lis_ing['ID_INGREDIENTE'];
																	$ING_CODIGO_INGREDIENTE  = $reg_lis_ing['CODIGO_INGREDIENTE'];
																	$ING_INGREDIENTE         = $reg_lis_ing['INGREDIENTE'];
																	$ING_PRECO_KG            = $reg_lis_ing['PRECO_KG'];
																	
																	echo "<option value='".$ING_ID_INGREDIENTE."_".$ING_CODIGO_INGREDIENTE."_".$ING_INGREDIENTE."_".$ING_PRECO_KG."'";
																	if($FTI_ID_INGREDIENTE == $ING_ID_INGREDIENTE) echo ' selected="selected" '; 
																	echo ">";
																	echo $ING_INGREDIENTE;
																	echo "</option>";
																	
															}
												    		?>
												    		
												    	</select>
													</td>
													
													<td>
														<input type="text" class="form-control" id="peso_bruto" name="peso_bruto[]-<?php echo $count; ?>" required  maxlength="7" onKeyUp="peso(this);" style="text-align: right !important;" value="<?php echo formata_peso_g($FTI_PESO_BRUTO); ?>" >
													</td>
													
													<td>
														<input type="text" class="form-control" id="peso_liquido" name="peso_liquido[]-<?php echo $count; ?>" required maxlength="7" onKeyUp="peso(this);" style="text-align: right !important;" value="<?php echo formata_peso_g($FTI_PESO_LIQUIDO); ?>" >
													</td>
													
													<td style="text-align: center !important;">
														<button onclick="RemoveTableRow(this)" type="button" class="btn btn-danger btn-xs">REMOVER</button>
													</td>
													
												</tr>
												<?php } ?>
											</tbody>
										
											<tfoot style="margin-top: 20px;">
												<tr>
													<td colspan="4" style="text-align: left;"><button onclick="AddTableRow()" type="button" class="btn btn-info btn-xs">ADICIONAR</button></td>
												</tr>
											</tfoot>
										
										</table>
										
									</div>
								
								</div>
								
							</div>
							
							<div class="card-footer" style="text-align: center;">
	                  			<button type="submit" class="btn-primary">CADASTRAR</button>
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