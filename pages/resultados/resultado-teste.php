<?php
	
	session_start();
	
	$get_id_candidato_teste = $_GET['id'];
	
	$sql_lis_con = "
    select									
		tbl_candidato_teste.id_candidato_teste, 
		tbl_candidato_teste.id_candidato,
		tbl_candidato_teste.id_teste, 
		date_format(tbl_candidato_teste.data_contratado, '%d/%m/%Y') as data_contratado,
		date_format(tbl_candidato_teste.data_fim, '%d/%m/%Y') as data_fim, 
		
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
		tbl_candidato_teste.id_candidato = '$get_id_candidato_teste' and 
		tbl_candidato_teste.situacao = 'FINALIZADO' and 
		tbl_candidato_teste.situacao_teste = 'CADASTRADO' 
										        					
	";
    $qry_lis_con = mysql_query($sql_lis_con) or die ("Erro 4: ".mysql_error());
    $reg_lis_con = mysql_fetch_array($qry_lis_con);

	$tst_id_candidato_teste = $reg_lis_con['id_candidato_teste'];
	$tst_id_candidato       = $reg_lis_con['id_candidato'];
	$tst_id_teste           = $reg_lis_con['id_teste'];
	$tst_data_contratado    = $reg_lis_con['data_contratado'];
	$tst_data_fim           = $reg_lis_con['data_fim'];
	
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
	
	
	/////////////////////////
	$sql_resp = "
    select									
		count(id_pergunta) as qtde_resposta		 
		
	from
		tbl_candidato_teste_resposta 
																		
	where
		id_candidato_teste = '$tst_id_candidato_teste' and 
		id_candidato = '$tst_id_candidato' and 
		id_teste = '$tst_id_teste'  
										        					
	";
    $qry_resp = mysql_query($sql_resp) or die ("Erro 4: ".mysql_error());
    $reg_resp = mysql_fetch_array($qry_resp);

	$resp_qtde_resposta = $reg_resp['qtde_resposta'];
	
	
	
	$sql_msg_geral = "
    select									
		mensagem		 
		
	from
		tbl_teste_resultado_geral 
																		
	where
		valor_inicial <= '$resp_qtde_resposta' and 
		'$resp_qtde_resposta' <= valor_final 
										        					
	";
    $qry_msg_geral = mysql_query($sql_msg_geral) or die ("Erro 4: ".mysql_error());
    $reg_msg_geral = mysql_fetch_array($qry_msg_geral);

	$geral_mensagem = $reg_msg_geral['mensagem'];
	
	
	
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	
      	<?php include ("../../header-pagina.php"); ?>
      	
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Resultado</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Painel</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=finalizado">Finalizado</a></li>
              <li class="breadcrumb-item active">Resultado</li>
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
          		<div class="col-lg-12 col-12">
          			
          			<div class="card">
	          			
			            <div class="card-body">
    		    			
    		    			<div class="row">									
								<div class="col-xs-12 col-md-2">
									<div class="form-group" style="margin-bottom: 0;">
										<label for="nome_teste" style="margin-bottom: 0;">CPF</label><br/> 
										<?php echo $tst_cpf; ?>
								  	</div>
								</div>	
								<div class="col-xs-12 col-md-4">
									<div class="form-group" style="margin-bottom: 0;">
										<label for="nome_teste" style="margin-bottom: 0;">Nome</label><br/>  
										<?php echo $tst_nome; ?>
								  	</div>
								</div>							
								<div class="col-xs-12 col-md-2">
									<div class="form-group" style="margin-bottom: 0;">
										<label for="nome_teste" style="margin-bottom: 0;">Data Realização</label><br/>  
										<?php echo $tst_data_fim; ?>
								  	</div>
								</div>	
								<div class="col-xs-12 col-md-4">
									<div class="form-group" style="margin-bottom: 0;">
										<label for="nome_teste" style="margin-bottom: 0;">Nome Teste</label><br/>  
										<?php echo $tst_nome_teste; ?>
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
			            	<h3 class="card-title">INVENTÁRIO DE HÁBITOS COMPORTAMENTAIS</h3>
			            </div>
			            
			            <div class="card-body">
			            	
				            <div class="card-conteudo">
						    	<p>
						    		Apresentamos o Inventário com as informações sobre seus Hábitos Comportamentais. Eles são considerados relevantes como fatores que poderão constituir fontes de Falta de Eficácia no trabalho, em casa, em alguma atividade e de Desperdício de Tempo. 
						    	</p>
						    	<p>
						    		Este Inventário apresenta as características de comportamento observadas em suas ações pessoais e profissionais. A forma como lida com as múltiplas situações no ambiente, com as pessoas, com os processos e como profissional.
						    	</p>
						    	<p>
						    		Os resultados podem ser melhores quando da mudança de um Hábito em nosso dia a dia. Seremos mais produtivos, dinâmicos, assertivos e com resultados efetivos.
						    	</p>
						    	
						    	<p>
						    		<strong>Gastaremos menos Energia para produzir mais.</strong>
						    	</p>
						    	<p>
						    		Antes de ler o resultado de seu Inventário verifique a natureza de seu trabalho/atividade, pois você pode ter criado alguns hábitos em função do que desempenha hoje. Verifique se você está alinhado/equilibrado em relação aos Hábitos Comportamentais. 
						    	</p>
						    	<p>
						    		Observe que quanto mais alta a pontuação, maior a incidência deste hábito comportamental em nosso dia a dia. Quanto menor, ou zero, significa que estamos mais próximos de comportamentos adequados que nos ajudam a melhorar a nossa eficácia e o uso de nosso tempo.
						    	</p>
						    </div>
				        
				        </div>
				            
				    </div>
          			
          			<div class="card">
	          				
						<div class="card-header">
			            	<h3 class="card-title">RESULTADO DO TESTE</h3>
			            </div>
				                
			            <div class="card-body">
			            	
			            	<div class="row">		
								<div class="col-xs-12 col-md-12" style="background: #e0ebeb; color: #444; padding: 20px; margin-bottom: 20px; border-radius: 5px;">
			            			<?php echo $geral_mensagem; ?>	
			            		</div>
			            	</div>
			            			
					    	<div class="row">		
								<div class="col-xs-12 col-md-12">
									
									<?php
		            			
			            			$sql_geral = "
			            			SELECT
			            				tbl_grupo_pergunta.id_grupo_pergunta, 
										tbl_grupo_pergunta.grupo_pergunta
										
									FROM
										tbl_teste_pergunta
										
										LEFT JOIN tbl_grupo_pergunta
										ON tbl_teste_pergunta.id_grupo_pergunta = tbl_grupo_pergunta.id_grupo_pergunta
									
									WHERE
										tbl_teste_pergunta.id_teste = '$tst_id_teste'
									
									GROUP BY 
										tbl_grupo_pergunta.id_grupo_pergunta
									
									ORDER BY
										tbl_grupo_pergunta.id_grupo_pergunta asc
			            												        					
									";
								    $qry_geral = mysql_query($sql_geral) or die ("Erro 4: ".mysql_error());
								    
								    $item = 1;
									
									echo "<table class='table' cellspacing='0' width='100%'>";
										echo "<tbody>";
								    
										    while($reg_geral = mysql_fetch_array($qry_geral)){
										
												$geral_id_grupo_pergunta = $reg_geral['id_grupo_pergunta'];
												$geral_grupo_pergunta    = $reg_geral['grupo_pergunta'];
												
												$sql_resp = "
						            			SELECT
													count(tbl_candidato_teste_resposta.resposta) AS qtde_resposta
													
												FROM
													tbl_candidato_teste_resposta
												
												WHERE
													tbl_candidato_teste_resposta.id_candidato_teste = '$tst_id_candidato_teste' and 
													tbl_candidato_teste_resposta.id_candidato = '$tst_id_candidato' and 
													tbl_candidato_teste_resposta.id_teste = '$tst_id_teste' and 
													tbl_candidato_teste_resposta.id_grupo_pergunta = '$geral_id_grupo_pergunta'
						            												        					
												";
											    $qry_resp = mysql_query($sql_resp) or die ("Erro 4: ".mysql_error());
												$reg_resp = mysql_fetch_array($qry_resp);
												
												$QTDE_RESPOSTA = $reg_resp['qtde_resposta'];
												
												if($QTDE_RESPOSTA <= 1){
											   		$cor_progress = "#0066ff";
											   	}elseif($QTDE_RESPOSTA > 1 and $QTDE_RESPOSTA <= 2){
											   		$cor_progress = "#ffcc00";
											   	}else{
											   		$cor_progress = "#ff0000";
											   	}
												
												echo "<tr style='font-size: 12px;'>";
													
													echo "<td width='30%' align='right'>".$geral_grupo_pergunta."</td>";
													echo "<td width='70%' align='left'>";
														
														/*
														echo "<div class='progress'>";
										                  	echo "<div class='progress-bar bg-success' role='progressbar'";
										                       	echo "aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width: 40%'>";
										                		echo "<span class='sr-only'>40% Complete (success)</span>";
										                  	echo "</div>";
										                echo "</div>";
														*/
														
														echo "<div class='progress-group'>";
									                    	echo "<span class='float-right' style='margin-left: 10px;'><b>".$QTDE_RESPOSTA."</b>/6</span>";
									                      	echo "<div class='progress'>";
									                        	echo "<div class='progress-bar' style='background-color: ".$cor_progress."; width: ".(($QTDE_RESPOSTA * 100) / 6)."%'></div>";
									                      	echo "</div>";
									                    echo "</div>";
														
														//echo "<div class='progress'>";
											            //	echo "<div class='progress-bar' style='background-color: ".$cor_progress."; width: ".$QTDE_RESPOSTA."%;'></div>"; 
											          	//echo "</div>";
													
													echo "</td>";
																						
												echo "</tr>";	
													
											}
									
										echo "</tbody>";
									echo "</table>";
									
									
			            			?>
									
								</div>
							</div>
								
							<div class="row">		
								<div class="col-xs-12 col-md-12" style="text-align: center;">
									
									<span><i class='fas fa-minus-square' style="color: #0066ff;"></i> Pontos a Manter (0 a 1)</span>
									<span><i class='fas fa-minus-square' style="color: #ffcc00; margin-left: 10px;"></i> Pontos de Atenção (2 a 3)</span>
									<span><i class='fas fa-minus-square' style="color: #ff0000; margin-left: 10px;"></i> Pontos a Aprimorar (4 a 6)</span>
									
								</div>
							</div>
						    
						    							    
			            </div>
				            					        	          				
          			</div>
          			
          			
          			<!-- detalhes do resultado -->
          			<div class="card">
	          				
						<div class="card-header">
			            	<h3 class="card-title">DETALHES DO RESULTADO</h3>
			            </div>
				                
			            <div class="card-body">
			            	
			            	<div class="row">	
			            		
			            		<?php
			            		
			            		$sql_espec = "
		            			SELECT
		            				tbl_grupo_pergunta.id_grupo_pergunta, 
									tbl_grupo_pergunta.grupo_pergunta
									
								FROM
									tbl_teste_pergunta
									
									LEFT JOIN tbl_grupo_pergunta
									ON tbl_teste_pergunta.id_grupo_pergunta = tbl_grupo_pergunta.id_grupo_pergunta
								
								WHERE
									tbl_teste_pergunta.id_teste = '$tst_id_teste'
								
								GROUP BY 
									tbl_grupo_pergunta.id_grupo_pergunta
								
								ORDER BY
									tbl_grupo_pergunta.id_grupo_pergunta asc
		            												        					
								";
							    $qry_espec = mysql_query($sql_espec) or die ("Erro 4: ".mysql_error());
								
								while($reg_espec = mysql_fetch_array($qry_espec)){
										
									$especifico_id_grupo_pergunta = $reg_espec['id_grupo_pergunta'];
									$especifico_grupo_pergunta    = $reg_espec['grupo_pergunta'];
									
									$sql_respes = "
			            			SELECT
										count(tbl_candidato_teste_resposta.resposta) AS qtde_resposta
										
									FROM
										tbl_candidato_teste_resposta
									
									WHERE
										tbl_candidato_teste_resposta.id_candidato_teste = '$tst_id_candidato_teste' and 
										tbl_candidato_teste_resposta.id_candidato = '$tst_id_candidato' and 
										tbl_candidato_teste_resposta.id_teste = '$tst_id_teste' and 
										tbl_candidato_teste_resposta.id_grupo_pergunta = '$especifico_id_grupo_pergunta'
			            												        					
									";
								    $qry_respes = mysql_query($sql_respes) or die ("Erro 4: ".mysql_error());
									$reg_respes = mysql_fetch_array($qry_respes);
									
									$QTDE_RESPOSTA_ESP = $reg_respes['qtde_resposta'];
									
									if($QTDE_RESPOSTA_ESP <= 1){
								   		$cor_progress_esp = "#0066ff";
								   	}elseif($QTDE_RESPOSTA_ESP > 1 and $QTDE_RESPOSTA_ESP <= 2){
								   		$cor_progress_esp = "#ffcc00";
								   	}else{
								   		$cor_progress_esp = "#ff0000";
								   	}
									
									
									$sql_msg_esp = "
								    select									
										mensagem		 
										
									from
										tbl_teste_resultado_especifico
																										
									where
										id_grupo_pergunta = '$especifico_id_grupo_pergunta' and 
										valor_inicial <= '$QTDE_RESPOSTA_ESP' and 
										'$QTDE_RESPOSTA_ESP' <= valor_final 
																		        					
									";
								    $qry_msg_esp = mysql_query($sql_msg_esp) or die ("Erro 4: ".mysql_error());
								    $reg_msg_esp = mysql_fetch_array($qry_msg_esp);
								
									$esp_mensagem = $reg_msg_esp['mensagem'];
									
									
				            		
				            		echo "<div class='col-xs-12 col-md-4' style='margin-bottom: 20px; padding: 20px;'>";
										
										echo "<div style='font-size: 14px; margin-bottom: 20px; color: #444; border-bottom: 1px solid #e0e0e0;'>".$especifico_grupo_pergunta."</div>";
										
										echo "<div>";
											
											echo "<div class='progress-group'>";
						                    	echo "<span class='float-right' style='margin-left: 10px;'><b>".$QTDE_RESPOSTA_ESP."</b>/6</span>";
						                      	echo "<div class='progress'>";
						                        	echo "<div class='progress-bar' style='background-color: ".$cor_progress_esp."; width: ".(($QTDE_RESPOSTA_ESP * 100) / 6)."%'></div>";
						                      	echo "</div>";
						                    echo "</div>";
											
										echo "</div>";
										
										echo "<div class='card-conteudo'>";
											echo $esp_mensagem;
										echo "</div>";
										
									echo "</div>";
								
								}
			            		
			            		?>
			            		
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