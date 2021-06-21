<?php
	
	//VERIFICA PERMISSAO
	function permisssao_acesso($id_usuario,$area_acesso) {
			
		$sql = "
		SELECT 
			tbl_usuario_cargo.id_usuario
		
		FROM
			tbl_permissao, tbl_cargo_permissao, tbl_usuario_cargo
			
		WHERE 
			tbl_permissao.id_permissao = '$area_acesso' AND 
			tbl_permissao.id_permissao = tbl_cargo_permissao.id_permissao AND 
			tbl_cargo_permissao.id_cargo = tbl_usuario_cargo.id_cargo AND 
			tbl_usuario_cargo.id_usuario = '$id_usuario' 
			
		";
		$qry = mysql_query($sql) or die ("Erro 1: ".mysql_error());
		$PERMISSAO = mysql_num_rows($qry);
		
		if($PERMISSAO != ""){ $PERMISSAO = "T"; }else{ $PERMISSAO = "F"; }
		
		return $PERMISSAO;
		
	}
	
	//VERIFICA PERMISSAO
	function verifica_permisssao($id_funcionario,$id_permissao) {
	
		$sql = "
		select
			tbl_usuario.ID_USUARIO,
			tbl_usuario.NOME,
			tbl_usuario_permissao.ID_PERMISSAO
		from
			tbl_usuario, tbl_usuario_permissao
		where
			tbl_usuario.ID_USUARIO = '$id_funcionario' and
			tbl_usuario.ID_USUARIO = tbl_usuario_permissao.ID_USUARIO and
			tbl_usuario_permissao.ID_PERMISSAO = '$id_permissao'
		";
		$qry = mysql_query($sql) or die ("Erro 1: ".mysql_error());
		$PERMISSAO = mysql_num_rows($qry);
		
		return $PERMISSAO;
		
	}
	
	//VERIFICA PERMISSAO MENU
	function verifica_permisssao_menu($id_funcionario,$tipo_permissao) {
	
		$sql = "
		select
		tbl_usuario_permissao.ID_USUARIO
		from
		tbl_usuario_permissao, tbl_permissao
		where
		tbl_usuario_permissao.ID_USUARIO = '$id_funcionario' and
		tbl_usuario_permissao.ID_PERMISSAO = tbl_permissao.ID_PERMISSAO and
		tbl_permissao.GRUPO = '$tipo_permissao'
		";
		$qry = mysql_query($sql) or die ("Erro 1: ".mysql_error());
		$PERMISSAO = mysql_num_rows($qry);
		
		return $PERMISSAO;
		
	}
	
	//VERIFICA PERMISSAO MENU
	function verifica_permisssao_submenu($id_funcionario,$tipo_permissao) {
	
		$sql = "
		select
		tbl_usuario_permissao.ID_USUARIO
		from
		tbl_usuario_permissao, tbl_permissao
		where
		tbl_usuario_permissao.ID_USUARIO = '$id_funcionario' and
		tbl_usuario_permissao.ID_PERMISSAO = tbl_permissao.ID_PERMISSAO and
		tbl_permissao.SUBGRUPO = '$tipo_permissao'
		";
		$qry = mysql_query($sql) or die ("Erro 1: ".mysql_error());
		$PERMISSAO = mysql_num_rows($qry);
		
		return $PERMISSAO;
		
	}
	
	
	//ASSINATURA_USUARIO
	function assinatura_usuario($id_usuario) {
	
		$sql_registro = " 
		SELECT 		
			tbl_usuario.CPF,
			tbl_usuario.NOME,
			tbl_usuario.NUM_REGISTRO, 
			tbl_estado.SIGLA 
		
		FROM 
			tbl_usuario
			
			left join tbl_estado
			on tbl_usuario.SECAO = tbl_estado.ID_ESTADO
				
		WHERE 
			tbl_usuario.ID_USUARIO = '$id_usuario'
		";
		$qry_registro = mysql_query($sql_registro) or die ("Erro 1: ".mysql_error());
		$reg_registro = mysql_fetch_array($qry_registro);
				
		$NOME_USUARIO 			= $reg_registro['NOME'];
		$NUM_REGISTRO_USUARIO 	= $reg_registro['NUM_REGISTRO'];
		$SECAO_REGISTRO			= $reg_registro['SIGLA'];
		
		$ASSINATURA_USUARIO = "<b>".$NOME_USUARIO."</b><br/>ABPp n.º ".$NUM_REGISTRO_USUARIO." - ".$SECAO_REGISTRO;
		
		return $ASSINATURA_USUARIO;
		
	}
	
	
	function calcularIdade($date){
	    $time = strtotime($date);
	    if($time === false){
	      return '';
	    }
	 
	    $year_diff = '';
	    $date = date('Y-m-d', $time);
	    list($year,$month,$day) = explode('-',$date);
	    $year_diff = date('Y') - $year;
	    $month_diff = date('m') - $month;
	    $day_diff = date('d') - $day;
	    if ($day_diff < 0 || $month_diff < 0) $year_diff;
	 
	    return $year_diff;
	}
	
	
	// Retorna mes
	function retorna_mes($rec_Mes) {
	
		if ($rec_Mes == 1) $mes = "JAN";
		if ($rec_Mes == 2) $mes = "FEV";
		if ($rec_Mes == 3) $mes = "MAR";
		if ($rec_Mes == 4) $mes = "ABR";
		if ($rec_Mes == 5) $mes = "MAI";						
		if ($rec_Mes == 6) $mes = "JUN";
		if ($rec_Mes == 7) $mes = "JUL";
		if ($rec_Mes == 8) $mes = "AGO";
		if ($rec_Mes == 9) $mes = "SET";
		if ($rec_Mes == 10) $mes = "OUT";
		if ($rec_Mes == 11) $mes = "NOV";
		if ($rec_Mes == 12) $mes = "DEZ";	
		return $mes;														
		
	}
	
	// Retorna mes extenso
	function retorna_mes_extenso($VerMes) {
	
		if ($VerMes == 1) $mes_ext = "JANEIRO";
		if ($VerMes == 2) $mes_ext = "FEVEREIRO";
		if ($VerMes == 3) $mes_ext = "MARÇO";
		if ($VerMes == 4) $mes_ext = "ABRIL";
		if ($VerMes == 5) $mes_ext = "MAIO";					
		if ($VerMes == 6) $mes_ext = "JUNHO";
		if ($VerMes == 7) $mes_ext = "JULHO";
		if ($VerMes == 8) $mes_ext = "AGOSTO";
		if ($VerMes == 9) $mes_ext = "SETEMBRO";
		if ($VerMes == 10) $mes_ext = "OUTUBRO";
		if ($VerMes == 11) $mes_ext = "NOVEMBRO";
		if ($VerMes == 12) $mes_ext = "DEZEMBRO";	
		return $mes_ext;														
		
	}
	
	// Retorna mes extenso
	function retorna_mes_ext($rec_Mes) {
	
		if ($rec_Mes == 1) $mes = "JANEIRO";
		if ($rec_Mes == 2) $mes = "FEVEREIRO";
		if ($rec_Mes == 3) $mes = "MARÇO";
		if ($rec_Mes == 4) $mes = "ABRIL";
		if ($rec_Mes == 5) $mes = "MAIO";						
		if ($rec_Mes == 6) $mes = "JUNHO";
		if ($rec_Mes == 7) $mes = "JULHO";
		if ($rec_Mes == 8) $mes = "AGOSTO";
		if ($rec_Mes == 9) $mes = "SETEMBRO";
		if ($rec_Mes == 10) $mes = "OUTUBRO";
		if ($rec_Mes == 11) $mes = "NOVEMBRO";
		if ($rec_Mes == 12) $mes = "DEZEMBRO";	
		return $mes;														
		
	}
	
	// Retorna ano mes extenso
	function retorna_ano_mes_ext($rec_Mes) {
		
		$dt_mes	 = $rec_Mes;
		$arr1    = explode('-',$dt_mes);
		$ano_mes = $arr1[0].'-'.$arr1[1];
		
		$v_ano = $arr1[0];
		$v_mes = $arr1[1];
	
		if ($rec_Mes == $v_ano."-01") $mes = "JANEIRO / ".$v_ano;
		if ($rec_Mes == $v_ano."-02") $mes = "FEVEREIRO / ".$v_ano;
		if ($rec_Mes == $v_ano."-03") $mes = "MARÇO / ".$v_ano;
		if ($rec_Mes == $v_ano."-04") $mes = "ABRIL / ".$v_ano;
		if ($rec_Mes == $v_ano."-05") $mes = "MAIO / ".$v_ano;						
		if ($rec_Mes == $v_ano."-06") $mes = "JUNHO / ".$v_ano;
		if ($rec_Mes == $v_ano."-07") $mes = "JULHO / ".$v_ano;
		if ($rec_Mes == $v_ano."-08") $mes = "AGOSTO / ".$v_ano;
		if ($rec_Mes == $v_ano."-09") $mes = "SETEMBRO / ".$v_ano;
		if ($rec_Mes == $v_ano."-10") $mes = "OUTUBRO / ".$v_ano;
		if ($rec_Mes == $v_ano."-11") $mes = "NOVEMBRO / ".$v_ano;
		if ($rec_Mes == $v_ano."-12") $mes = "DEZEMBRO / ".$v_ano;	
		return $mes;														
		
	}
	
	// Retorna ano mes extenso
	function retorna_ano_mes_ext_abv($rec_Mes) {
		
		$dt_mes	 = $rec_Mes;
		$arr1    = explode('-',$dt_mes);
		$ano_mes = $arr1[0].'-'.$arr1[1];
		
		$v_ano = $arr1[0];
		$v_mes = $arr1[1];
	
		if ($rec_Mes == $v_ano."-01") $mes = "JAN / ".$v_ano;
		if ($rec_Mes == $v_ano."-02") $mes = "FEV / ".$v_ano;
		if ($rec_Mes == $v_ano."-03") $mes = "MAR / ".$v_ano;
		if ($rec_Mes == $v_ano."-04") $mes = "ABR / ".$v_ano;
		if ($rec_Mes == $v_ano."-05") $mes = "MAI / ".$v_ano;						
		if ($rec_Mes == $v_ano."-06") $mes = "JUN / ".$v_ano;
		if ($rec_Mes == $v_ano."-07") $mes = "JUL / ".$v_ano;
		if ($rec_Mes == $v_ano."-08") $mes = "AGO / ".$v_ano;
		if ($rec_Mes == $v_ano."-09") $mes = "SET / ".$v_ano;
		if ($rec_Mes == $v_ano."-10") $mes = "OUT / ".$v_ano;
		if ($rec_Mes == $v_ano."-11") $mes = "NOV / ".$v_ano;
		if ($rec_Mes == $v_ano."-12") $mes = "DEZ / ".$v_ano;	
		return $mes;														
		
	}
	
	// Formata numero
	function formata_num($valor) {
		
		$ValorFormatado = number_format($valor,0,'.','.');
		return $ValorFormatado;
	
	}
	
	// Formata numero
	function formata_numero($valor) {
		
		$ValorFormatado = number_format($valor,0,'.','.');
		return $ValorFormatado;
	
	}
	
	// Formata numero
	function formata_num_grafico($valor) {
		
		$ValorFormatado = number_format($valor,2,'.','');
		return $ValorFormatado;
	
	}
	
	// Formata valor
	function formata_valor($valor) {
		
		$ValorFormatado = number_format($valor,2,',','.');
		return $ValorFormatado;
	
	}
	
	// Formata peso
	function formata_peso_g($valor) {
		
		$ValorFormatado = number_format($valor,3,',','.');
		return $ValorFormatado;
	
	}
	
	// Formata valor grava banco
	function formata_valor_grava($valor) {
		
		$ValorFormatado = number_format($valor,2,'.','');
		return $ValorFormatado;
	
	}
	
	// Formata valor calculo
	function formata_valor_calculo($valor) {
		
		$ValorFormatado = number_format($valor,2,',','');
		return $ValorFormatado;
	
	}
	
	// Formata estoque
	function formata_valor_estoque($valor) {
		
		$ValorFormatado = number_format($valor,0,'.','.');
		return $ValorFormatado;
	
	}
	
	// Valor por extenso
	function valorPorExtenso($valor=0) {
		$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
		$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
	 
		$c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
		$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
		$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
		$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
	 
		$z=0;
	 
		$valor = number_format($valor, 2, ".", ".");
		$inteiro = explode(".", $valor);
		for($i=0;$i<count($inteiro);$i++)
			for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
				$inteiro[$i] = "0".$inteiro[$i];
	 
		// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;) 
		$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
		for ($i=0;$i<count($inteiro);$i++) {
			$valor = $inteiro[$i];
			$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
			$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
			$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
		
			$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
			$t = count($inteiro)-1-$i;
			$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
			if ($valor == "000")$z++; elseif ($z > 0) $z--;
			if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t]; 
			if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
		}
	 
		return($rt ? $rt : "zero");
	}
	
	// Remove acento e coloca caixa alta
	function RemoveAcentosCXA($string){

		$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ";
				
		$b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyrr";
		
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"
		$string = strtoupper($string); // passa tudo para maiusculo
	
		return utf8_encode($string); //finaliza, gerando uma saída para a funcao
	}
	
	
	// Remove acento e retira espaco
	function RemoveAcentos($string){

		$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ";
				
		$b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyrr";
		
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"
		$string = str_replace(" ","-",$string); // retira espaco
		$string = strtolower($string); // passa tudo para minusculo
	
		return utf8_encode($string); //finaliza, gerando uma saída para a funcao
	}
	
	// Gera codigo
	function geraChave($digitos) {
		$chave = '';
		$sopinha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		srand((double)microtime()*1000000);
		for($i=0; $i < $digitos; $i++) {
			$chave .= $sopinha[rand()%strlen($sopinha)];
		}
		return $chave;
	}
	
	// Gera Matricula
	function geraMatricula($digitos) {
		$chave = '';
		$sopinha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		srand((double)microtime()*1000000);
		for($i=0; $i < $digitos; $i++) {
			$chave .= $sopinha[rand()%strlen($sopinha)];
		}
		return $chave;
	}
	
	//Valida CPF
	function validaCPF($cpf = null) {
		
		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}
	
		// Elimina possivel mascara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') {
			
			return false;
		 
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		 } else {   
			
			for ($t = 9; $t < 11; $t++) {
				
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}
	
			return true;
		}
	}

	
	function validaCNPJ($cnpj = null) {

		// Verifica se um número foi informado
		if(empty($cnpj)) {
			return false;
		}
	
		// Elimina possivel mascara
		$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
		$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
		
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cnpj) != 14) {
			return false;
		}
		
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cnpj == '00000000000000' || 
			$cnpj == '11111111111111' || 
			$cnpj == '22222222222222' || 
			$cnpj == '33333333333333' || 
			$cnpj == '44444444444444' || 
			$cnpj == '55555555555555' || 
			$cnpj == '66666666666666' || 
			$cnpj == '77777777777777' || 
			$cnpj == '88888888888888' || 
			$cnpj == '99999999999999') {
			return false;
			
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		 } else {   
		 
			$j = 5;
			$k = 6;
			$soma1 = "";
			$soma2 = "";
	
			for ($i = 0; $i < 13; $i++) {
	
				$j = $j == 1 ? 9 : $j;
				$k = $k == 1 ? 9 : $k;
	
				$soma2 += ($cnpj{$i} * $k);
	
				if ($i < 12) {
					$soma1 += ($cnpj{$i} * $j);
				}
	
				$k--;
				$j--;
	
			}
	
			$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
			$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
	
			return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
		 
		}
	}
	
	
?>