<?php
require_once("../inc_dbConexao.php");
require_once("../inc/funcoes.php");

//busca valor digitado no campo autocomplete "$_GET['term']
$cnpj = $_GET['cnpj'];

$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default

$query = "
select
	ID_PESSOA, CNPJ, RAZAO_SOCIAL, NOME_FANTASIA, INSCRICAO_MUNICIPAL, INSCRICAO_ESTADUAL,  
	EMAIL, TELEFONE_1, TELEFONE_2, 
	CEP, ENDERECO, COMPLEMENTO, BAIRRO, CIDADE, UF, 
	CPF_RESPONSAVEL, NOME_RESPONSAVEL, CARGO_RESPONSAVEL, EMAIL_RESPONSAVEL, TELEFONE_1_RESPONSAVEL, TELEFONE_2_RESPONSAVEL
from
	tbl_pessoa
where
	CNPJ = '$cnpj'
";
$result = mysql_query($query);
//formata o resultado para JSON

$first = true;
while($row = mysql_fetch_array($result)){
	
	$ID_PESSOA     = $row['ID_PESSOA'];
	$CNPJ 		   = $row['CNPJ'];
	$RAZAO_SOCIAL  = $row['RAZAO_SOCIAL'];
	$NOME_FANTASIA = $row['NOME_FANTASIA'];
	$INSCRICAO_MUNICIPAL = $row['INSCRICAO_MUNICIPAL'];
	$INSCRICAO_ESTADUAL  = $row['INSCRICAO_ESTADUAL'];
	
	$EMAIL      = $row['EMAIL'];
	$TELEFONE_1 = $row['TELEFONE_1'];
	$TELEFONE_2 = $row['TELEFONE_2'];
	
	$CEP 		 = $row['CEP'];
	$ENDERECO	 = $row['ENDERECO'];
	$COMPLEMENTO = $row['COMPLEMENTO'];
	$BAIRRO 	 = $row['BAIRRO'];
	$CIDADE 	 = $row['CIDADE'];
	$UF 		 = $row['UF'];
	
	$CPF_RESPONSAVEL   = $row['CPF_RESPONSAVEL'];
	$NOME_RESPONSAVEL  = $row['NOME_RESPONSAVEL'];
	$CARGO_RESPONSAVEL = $row['CARGO_RESPONSAVEL'];
	$EMAIL_RESPONSAVEL = $row['EMAIL_RESPONSAVEL'];
	$TELEFONE_1_RESPONSAVEL = $row['TELEFONE_1_RESPONSAVEL'];
	$TELEFONE_2_RESPONSAVEL = $row['TELEFONE_2_RESPONSAVEL'];
	
	if (!$first) { $json .=  ','; } else { $first = false; }
	$json .= '{	
		"ID_CLIENTE":"'.$ID_CLIENTE.'",
		"CNPJ":"'.$CNPJ.'",
		"RAZAO_SOCIAL":"'.$RAZAO_SOCIAL.'",
		"NOME_FANTASIA":"'.$NOME_FANTASIA.'",
		"INSCRICAO_MUNICIPAL":"'.$INSCRICAO_MUNICIPAL.'",
		"INSCRICAO_ESTADUAL":"'.$INSCRICAO_ESTADUAL.'",
		
		"EMAIL":"'.$EMAIL.'",
		"TELEFONE_1":"'.$TELEFONE_1.'",
		"TELEFONE_2":"'.$TELEFONE_2.'",
		
		"CEP":"'.$CEP.'",
		"ENDERECO":"'.$ENDERECO.'",
		"COMPLEMENTO":"'.$COMPLEMENTO.'",
		"BAIRRO":"'.$BAIRRO.'",
		"CIDADE":"'.$CIDADE.'",
		"UF":"'.$UF.'",
		
		"CPF_RESPONSAVEL":"'.$CPF_RESPONSAVEL.'",
		"NOME_RESPONSAVEL":"'.$NOME_RESPONSAVEL.'",
		"CARGO_RESPONSAVEL":"'.$CARGO_RESPONSAVEL.'",
		"EMAIL_RESPONSAVEL":"'.$EMAIL_RESPONSAVEL.'",
		"TELEFONE_1_RESPONSAVEL":"'.$TELEFONE_1_RESPONSAVEL.'",
		"TELEFONE_2_RESPONSAVEL":"'.$TELEFONE_2_RESPONSAVEL.'"
		
	}';
	
}
 
echo $json;

?>



