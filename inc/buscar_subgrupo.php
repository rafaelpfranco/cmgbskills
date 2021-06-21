<?php

include ("../inc_dbConexao.php");

$id_grupo_lancamento = $_POST['id_grupo_lancamento'];

if($id_grupo_lancamento != ""){
	
	$sql = " SELECT ID_LAN_SUBGRUPO, SUBGRUPO FROM tbl_lan_subgrupo WHERE ID_LAN_GRUPO = '$id_grupo_lancamento' and SITUACAO = 'CADASTRADO' ";
	$qry = mysql_query($sql) or die(mysql_error());

	if(mysql_num_rows($qry) == 0){
   		echo '<option value="">'.htmlentities('Nao encontrado').'</option>';
   
	}else{
		//echo '<option value="">selecione...</option>';
		while($ln = mysql_fetch_assoc($qry)){
      			
      		$ID_SUBGRUPO_LANCAMENTO = $ln['ID_LAN_SUBGRUPO'];
			$SUBGRUPO_LANCAMENTO    = $ln['SUBGRUPO'];
			
			echo '<option value="'.$ID_SUBGRUPO_LANCAMENTO.'">'.$SUBGRUPO_LANCAMENTO.'</option>';
			
		}
   
   }
   
}else{

	echo "<option value=''>---</option>";
   	
}

?>