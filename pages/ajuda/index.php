<?php

	session_start();
	
	if(isset($_GET['pg'])) $pg = $_GET['pg']; else $pg = "home";
	
	require_once("../../inc_dbConexao.php");
	require_once("../../inc/sessao.php");
	require_once("../../inc/funcoes.php");
	require_once("../../inc/mascaras.php");
	//require_once("inc/busca_dados.php");
		
	$DATA_ATUAL = date("Y-m-d");
	$DATA_ATUAL_FORM = date("d/m/Y");
	$DIA_ATUAL = date("d");
	$MES_ATUAL = date("m");
	$ANO_ATUAL = date("Y");
	$ANO_MES_ATUAL = date("Y-m");
	$MES_ANO_ATUAL_FORM = date("m/Y");
	
	$ULTIMO_DIA_MES = cal_days_in_month(CAL_GREGORIAN, date("m") , date("Y"));
	
	$area_acesso = "1";
	
	$sql_f = " SELECT ID_USUARIO, CPF, NOME, APELIDO, LOGIN FROM tbl_usuario WHERE LOGIN = '$_SESSION[login]' AND BLOQUEADO = 'F' ";
	$qry_f = mysql_query($sql_f) or die ("Erro 01: ".mysql_error());
	$reg_f = mysql_fetch_array($qry_f);
	
	$existe_usuario  = mysql_num_rows($qry_f);
	
	$Fun_Id   	     = $reg_f['ID_USUARIO'];
	$Fun_CPF         = $reg_f['CPF'];
	$Fun_Nome 	     = $reg_f['NOME'];
	$Fun_Apelido     = $reg_f['APELIDO'];
	$Fun_Login       = $reg_f['LOGIN'];
					
	$_SESSION['us_id'] 		= $Fun_Id;
	$_SESSION['us_name'] 	= $Fun_Nome;
	$_SESSION['us_apelido'] = $Fun_Apelido;
	
	
	if($existe_usuario != ""){
	
		$sql_log = " SELECT date_format(DATA_LOG, '%d/%m/%Y às %H:%i:%s') as DATA_LOG FROM tbl_log WHERE ID_USUARIO = '$Fun_Id' ORDER BY DATA_LOG DESC LIMIT 1, 1 ";
		$qry_log = mysql_query($sql_log) or die ("Erro 04: ".mysql_error());
		$reg_log = mysql_fetch_array($qry_log);
		
		$DataLog = " Último acesso em ". $reg_log['DATA_LOG'];
		if($reg_log['DATA_LOG'] == ""){ $DataLog = "Primeiro acesso."; }
		
		/*
		if(permisssao_servico($_SESSION['us_id'],1) == ""){
						
			echo "<script language= 'JavaScript'>";
				echo "location.href='/'";
			echo "</script>";
						
		}
		*/		
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	
	<title>CMGB CONSULTORIA E TREINAMENTO</title>
	<link rel="icon" type="image/png" sizes="16x16" href="../../imagens/favicon-16x16.png">
	
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
	<!-- DataTables -->
  	<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  	<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	
	<link rel="stylesheet" href="../../css/estilo-sistema.css">
</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light estilo-header">
    <!-- Left navbar links -->
    <?php include("../../navtopo.php"); ?>       
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php include("../../logomarca.php"); ?> 

    <!-- Sidebar -->
    <?php include("../../menu.php"); ?>      
    <!-- /.sidebar -->
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <?php if ( (!isset($pg)) || ($pg == "home") ) include("home.php"); else	include($pg . ".php"); ?>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <!--
  <footer class="main-footer" style="padding: 10px 15px; background: #5c6670; color: #fff;">
    <strong>SISTEMA GESTOR PRODUÇÃO.</strong> Copyright &copy; 2020 
    Todos os direitos reservados. | <a href="http://gheti.com.br" target="_blank">GHETI Tecnologia e Inovação</a>
     CNPJ 24.578.303/0001-54 | contato@gheti.com.br
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 1.0.0
    </div>
  </footer>
  -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../../dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../plugins/raphael/raphael.min.js"></script>
<script src="../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="../../dist/js/pages/dashboard2.js"></script>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {	    
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "language": {
			"sEmptyTable": "Nenhum registro encontrado",
		    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
		    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
		    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
		    "sInfoPostFix": "",
		    "sInfoThousands": ".",
		    "sLengthMenu": "Mostrando _MENU_ resultados por página",
		    
		    "sLoadingRecords": "Carregando...",
		    "sProcessing": "Processando...",
		    "sZeroRecords": "Nenhum registro encontrado",
		    "sSearch": "Pesquisar",
		    
		    "oPaginate": {
		        "sNext": "Próximo",
		        "sPrevious": "Anterior",
		        "sFirst": "Primeiro",
		        "sLast": "Último"
		    },
		    "oAria": {
		        "sSortAscending": ": Ordenar colunas de forma ascendente",
		        "sSortDescending": ": Ordenar colunas de forma descendente"
		    },
		    "select": {
		        "rows": {
		            "_": "Selecionado %d linhas",
		            "0": "Nenhuma linha selecionada",
		            "1": "Selecionado 1 linha"
		        }
		    },
		    "buttons": {
		        "copy": "Copiar para a área de transferência",
		        "copyTitle": "Cópia bem sucedida",
		        "copySuccess": {
		            "1": "Uma linha copiada com sucesso",
		            "_": "%d linhas copiadas com sucesso"
		        }
		    }
	    }
    });
  });
</script>

</body>
</html>
<?php
	}else{
		header('Location: ../../login.php');
	}
?>