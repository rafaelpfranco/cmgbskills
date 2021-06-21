<div class="sidebar" style="background: #364150; margin-top: 8px;">
	
	<nav class="mt-2" style="border-bottom: 1px solid #4f5962; margin-top: 5px !important; ">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	      
	      <li class="nav-item has-treeview">
	        <a href="/" class="nav-link">
	          <i class="nav-icon fas fa-home" style="font-size: 13px;"></i>
	          <p>PAINEL</p>
	        </a>            
	      </li>
	                
	    </ul>
	</nav>

	<!-- Sidebar Menu -->
	<nav class="mt-2" style="margin-top: 3px !important;">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'1') == "T"){ ?>
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 0px !important;">
		    <a href="../../pages/perguntas/index.php?pg=perguntas" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-question-circle" style="font-size: 16px;"></i>
		      <p>
		        Perguntas
		      </p>
		    </a>           
		  </li>
		  <?php } ?>
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'2') == "T"){ ?>
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="../../pages/inventario/index.php?pg=inventario" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-paste" style="font-size: 16px;"></i>
		      <p>
		        Inventário
		      </p>
		    </a>           
		  </li>
		  <?php } ?>
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'3') == "T"){ ?>		  
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="../../pages/candidatos/index.php?pg=listar-candidatos" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-user" style="font-size: 16px;"></i>
		      <p>
		        Candidatos
		      </p>
		    </a>           
		  </li>
		  <?php } ?>

		  <?php if(permisssao_acesso($_SESSION['us_id'],'9') == "T"){ ?>		  
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="../../pages/candidaturas/index.php?pg=listar-candidaturas" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-user" style="font-size: 16px;"></i>
		      <p>
		        Candidaturas
		      </p>
		    </a>           
		  </li>
		  <?php } ?>
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'4') == "T"){ ?>		  
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="../../pages/clientes/index.php?pg=listar-clientes" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-user" style="font-size: 16px;"></i>
		      <p>
		        Clientes
		      </p>
		    </a>           
		  </li>
		  <?php } ?>
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'5') == "T"){ ?>  
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="#" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon far fa-file-alt" style="font-size: 13px;"></i>
		      <p>
		        Resultados
		        <i class="right fas fa-angle-right"></i>
		      </p>
		    </a>		    		    
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="../../pages/resultados/index.php?pg=aguardando" class="nav-link">
		          	<i class="fas fa-caret-right nav-icon"></i>
		          	<p>Aguardando</p>
		        </a>
		      </li>              
		    </ul>
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="../../pages/resultados/index.php?pg=liberado" class="nav-link">
		          	<i class="fas fa-caret-right nav-icon"></i>
		          	<p>Liberado</p>
		        </a>
		      </li>              
		    </ul>
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="../../pages/resultados/index.php?pg=finalizado" class="nav-link">
		          	<i class="fas fa-caret-right nav-icon"></i>
		          	<p>Finalizado</p>
		        </a>
		      </li>              
		    </ul>		    
		  </li>
		  <?php } ?>
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'6') == "T"){ ?> 		  
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="#" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-cloud-download-alt" style="font-size: 13px;"></i>
		      <p>
		        Arquivos
		        <i class="right fas fa-angle-right"></i>
		      </p>
		    </a>
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="../../pages/arquivos/index.php?pg=pastas" class="nav-link">
		          <i class="fas fa-caret-right nav-icon"></i>
		          <p>Pastas</p>
		        </a>
		      </li>              
		    </ul>            
		  </li>
		  <?php } ?>
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'7') == "T"){ ?> 
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="#" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-chart-line" style="font-size: 13px;"></i>
		      <p>
		        Relatórios
		        <i class="right fas fa-angle-right"></i>
		      </p>
		    </a>
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="#" class="nav-link">
		          <i class="fas fa-caret-right nav-icon"></i>
		          <p>Relatório 1</p>
		        </a>
		      </li>              
		    </ul> 
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="#" class="nav-link">
		          <i class="fas fa-caret-right nav-icon"></i>
		          <p>Relatório 2</p>
		        </a>
		      </li>              
		    </ul> 
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="#" class="nav-link">
		          <i class="fas fa-caret-right nav-icon"></i>
		          <p>Relatório 3</p>
		        </a>
		      </li>              
		    </ul>            
		  </li>
		  <?php } ?>
		  
		  <?php if(permisssao_acesso($_SESSION['us_id'],'8') == "T"){ ?> 
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="#" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-tools" style="font-size: 13px;"></i>
		      <p>
		        Administrativo
		        <i class="right fas fa-angle-right"></i>
		      </p>
		    </a>
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="../../pages/administrativo/index.php?pg=usuarios" class="nav-link">
		          <i class="fas fa-caret-right nav-icon"></i>
		          <p>Usuários</p>
		        </a>
		      </li>	
		      <li class="nav-item">
		        <a href="../../pages/administrativo/index.php?pg=controle-de-acesso" class="nav-link">
		          <i class="fas fa-caret-right nav-icon"></i>
		          <p>Controle de Acesso</p>
		        </a>
		      </li>		                  
		    </ul> 		                
		  </li>
		  <?php } ?>
		  
		  
		  <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; margin-top: 3px !important;">
		    <a href="#" class="nav-link" style="margin-bottom: 3px;">
		      <i class="nav-icon fas fa-exclamation-circle" style="font-size: 13px;"></i>
		      <p>
		        Ajuda
		        <i class="right fas fa-angle-right"></i>
		      </p>
		    </a>
		    <ul class="nav nav-treeview">
		      <li class="nav-item">
		        <a href="../../pages/ajuda/index.php?pg=suporte" class="nav-link">
		          <i class="fas fa-caret-right nav-icon"></i>
		          <p>Suporte</p>
		        </a>
		      </li>              
		    </ul>            
		  </li>
		  
		</ul>
	</nav>
	<!-- /.sidebar-menu -->
	
</div>