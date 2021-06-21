<?php
require_once("../inc_dbConexao.php");
require_once("../inc/funcoes.php");

//busca valor digitado no campo autocomplete "$_GET['term']
$codigo_aprendente = $_GET['codigo'];

$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default

$query = "
select
	ID_APRENDENTE,
	NOME,
	DATA_NASCIMENTO,
	IDADE,
	NOME_MAE,
	NOME_PAI,
	TELEFONE_1,
	TELEFONE_2,
	MORA_COM,
	CEP, LOGRADOURO, NUMERO, COMPLEMENTO, BAIRRO, CIDADE, UF
from
	tbl_aprendente
where
	ID_APRENDENTE = '$codigo_aprendente'
	SITUACAO = 'CADASTRADO'
";
$result = mysql_query($query);
//formata o resultado para JSON

$first = true;
while($row = mysql_fetch_array($result)){
	
	$ID_APRENDENTE    = $row['ID_APRENDENTE'];
	$NOME 		      = $row['NOME'];
	$DATA_NASCIMENTO  = $row['DATA_NASCIMENTO'];
	$IDADE            = $row['IDADE'];
	
	$NOME_MAE   = $row['NOME_MAE'];
	$NOME_PAI   = $row['NOME_PAI'];
	$TELEFONE_1 = $row['TELEFONE_1'];
	$TELEFONE_2 = $row['TELEFONE_2'];
	$MORA_COM   = $row['MORA_COM'];
	
	$CEP 		 = $row['CEP'];
	$LOGRADOURO	 = $row['LOGRADOURO'];
	$NUMERO  	 = $row['NUMERO'];
	$COMPLEMENTO = $row['COMPLEMENTO'];
	$BAIRRO 	 = $row['BAIRRO'];
	$CIDADE 	 = $row['CIDADE'];
	$UF 		 = $row['UF'];
		
			
	if (!$first) { $json .=  ','; } else { $first = false; }
	$json .= '{
			
		"ID_APRENDENTE":"'.$ID_APRENDENTE.'",
		"NOME":"'.$NOME.'",
		"DATA_NASCIMENTO":"'.$DATA_NASCIMENTO.'",
		"IDADE":"'.$IDADE.'",
		
		"NOME_MAE":"'.$NOME_MAE.'",
		"NOME_PAI":"'.$NOME_PAI.'",
		"TELEFONE_1":"'.$TELEFONE_1.'",
		"TELEFONE_2":"'.$TELEFONE_2.'",
		"MORA_COM":"'.$MORA_COM.'",
		
		"CEP":"'.$CEP.'",
		"LOGRADOURO":"'.$LOGRADOURO.'",
		"NUMERO":"'.$NUMERO.'",
		"COMPLEMENTO":"'.$COMPLEMENTO.'",
		"BAIRRO":"'.$BAIRRO.'",
		"CIDADE":"'.$CIDADE.'",
		"UF":"'.$UF.'"
						
	}';
	
}
 
echo $json;

?>



