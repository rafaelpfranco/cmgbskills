<?php
		

?>

<div class="content-wrapper">
	
    <!-- Content Header (Page header) -->    
    <div class="content-header">
      <div class="container-fluid">
      	
      	
        
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Painel</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
                
        <div class="row">
        	
      		<div class="col-lg-12 col-12">
      			
      			<div class="row">
        	
		      		<div class="col-lg-3 col-12">
		      			
		      			<div class="card">
		      				
		      				<div class="card-header">
				            	<h3 class="card-title">RESULTADO PENDENTES</h3>
				            </div>
					            
				            <div class="card-body">
				            	<div class="row" style="margin-bottom: 0; margin-top: 0;">		
									<div class="col-xs-12 col-md-12" style="text-align: center;">							
										<div style="font-size: 24px; color: #666;">0</div>
										<div style="font-size: 12px; color: #888;">0,00%</div>				
									</div>				
								</div>		            
				            </div>
		      				
		      			</div>
		      			
		      		</div>
		      		
		      		<div class="col-lg-3 col-12">
		      			
		      			<div class="card">
		      				
		      				<div class="card-header">
				            	<h3 class="card-title">RESULTADO ANDAMENTO</h3>
				            </div>
					            
				            <div class="card-body">
				            	<div class="row" style="margin-bottom: 0; margin-top: 0;">		
									<div class="col-xs-12 col-md-12" style="text-align: center;">							
										<div style="font-size: 24px; color: #666;">0</div>
										<div style="font-size: 12px; color: #888;">0,00%</div>				
									</div>				
								</div>		            
				            </div>
		      				
		      			</div>
		      			
		      		</div>
		      		
		      		<div class="col-lg-3 col-12">
		      			
		      			<div class="card">
		      				
		      				<div class="card-header">
				            	<h3 class="card-title">RESULTADO CONCLUÍDO</h3>
				            </div>
					            
				            <div class="card-body">
				            	<div class="row" style="margin-bottom: 0; margin-top: 0;">		
									<div class="col-xs-12 col-md-12" style="text-align: center;">							
										<div style="font-size: 24px; color: #666;">0</div>
										<div style="font-size: 12px; color: #888;">0,00%</div>				
									</div>				
								</div>		            
				            </div>
		      				
		      			</div>
		      			
		      		</div>
		      		
		      		<div class="col-lg-3 col-12">
		      			
		      			<div class="card">
		      				
		      				<div class="card-header">
				            	<h3 class="card-title">TESTES DISPONÍVEIS</h3>
				            </div>
					            
				            <div class="card-body">
				            	<div class="row" style="margin-bottom: 0; margin-top: 0;">		
									<div class="col-xs-12 col-md-12" style="text-align: center;">							
										<div style="font-size: 24px; color: #666;">0</div>
										<div style="font-size: 12px; color: #888;">0,00%</div>				
									</div>				
								</div>		            
				            </div>
		      				
		      			</div>
		      			
		      		</div>
		      		
		      	</div>
        	
        	</div>
        	
        </div>
        
        	
      	<div class="row">
        	
      		<div class="col-lg-6 col-12">
      			
      			<div class="card">
		      				
					<div class="card-header">
		            	<h3 class="card-title">RESULTADOS</h3>
		            </div>
			            
		            <div class="card-body">
		            	<div class="row">		
							<div class="col-xs-12 col-md-12">
								
								<div id="container" style="height: 300px;"></div>
								
								<script type="text/javascript">
									// Build the chart
									Highcharts.chart('container', {
									    chart: {
									        plotBackgroundColor: null,
									        plotBorderWidth: null,
									        plotShadow: false,
									        type: 'pie'
									    },
									    title: false,
									    
									    credits: {
									    	enabled: false
									    },
									    
									    colors: ['#ff6666', '#ffcc00', '#00cc99'],
									    
									    tooltip: {
									        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
									    },
									    accessibility: {
									        point: {
									            valueSuffix: '%'
									        }
									    },
									    plotOptions: {
									        pie: {
									            allowPointSelect: true,
									            cursor: 'pointer',
									            dataLabels: {
									                enabled: false
									            },
									            showInLegend: true
									        }
									    },
									    series: [{
									        name: 'perc',
									        colorByPoint: true,
									        data: [
									        {
									            name: 'Pendente',
									            y: 10
									        }, 
									        {
									            name: 'Andamento',
									            y: 12
									        },
									        {
									            name: 'Finalizado',
									            y: 8
									        }
									        ]
									    }]
									});
											</script>
								
							</div>
						</div>
					</div>
					
				</div>
      			
      		</div>
      		
      		<div class="col-lg-6 col-12">
      			
      			<div class="card">
		      				
					<div class="card-header">
		            	<h3 class="card-title">RESULTADO POR COMPETÊNCIA</h3>
		            </div>
			            
		            <div class="card-body" style="height: 340px;">
		            	<div class="row">		
							<div class="col-xs-12 col-md-12">
								
								<div id="container1" style="height: 300px;"></div>
								
								<script type="text/javascript">
									Highcharts.chart('container1', {
									    chart: {
									        type: 'column'
									    },
									    title: false,
																		    
									    credits: {
									    	enabled: false
									    },
									    subtitle: false,
									    
									    xAxis: {
									        categories: [
									            'A',
									            'B',
									            'C',
									            'D',
									            'E'
									        ],
									        crosshair: true
									    },
									    yAxis: {
									        min: 0,
									        title: {
									            text: 'Quantidade'
									        }
									    },
									    tooltip: {
									        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
									        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
									            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
									        footerFormat: '</table>',
									        shared: true,
									        useHTML: true
									    },
									    plotOptions: {
									        column: {
									            pointPadding: 0.2,
									            borderWidth: 0
									        }
									    },
									    colors: ['#3399ff', '#ff9966', '#009999'],
									    series: [{
									        name: 'JAN',
									        data: [14, 12, 11]
									
									    }, {
									        name: 'FEV',
									        data: [11, 10, 15]
									
									    }, {
									        name: 'MAR',
									        data: [12, 12, 14]
									
									    }]
									});
								</script>
								
								
							</div>
						</div>
					</div>
					
				</div>
      			
      		</div>
      		
      		
      		
      	</div>
      	
      	
      	
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <!-- /.content -->
    
    <?php include ("rodape.php"); ?>
    
  </div>