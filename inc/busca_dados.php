<!-- BUSCA CEP -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript">
function BuscarCep() {
	
	// CEP PAI
	if($.trim($("#cep").val()) != ""){
	
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
		// o getScript dá um eval no script, então é só ler!
		//Se o resultado for igual a 1
					
		if (resultadoCEP["tipo_logradouro"] != '') {
			if (resultadoCEP["resultado"]) {
			// troca o valor dos elementos
				$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#uf").val(unescape(resultadoCEP["uf"]));
				$("#numero_endereco").focus();
				}
			}		
		});
	}
	
	
}

function BuscarCnpj() {

	if($.trim($("#cnpj").val()) != ""){
	
		$.getJSON('../inc/busca_cnpj.php?cnpj='+$("#cnpj").val(), function(data){
			
			$('#id_cliente').val(data.ID_CLIENTE);
			$('#cnpj').val(data.CNPJ);
			$('#razao_social').val(data.RAZAO_SOCIAL);
			$('#nome_fantasia').val(data.NOME_FANTASIA);
			$('#inscricao_municipal').val(data.INSCRICAO_MUNICIPAL);
			$('#inscricao_estadual').val(data.INSCRICAO_ESTADUAL);
			
			$('#email').val(data.EMAIL);
			$('#telefone_1').val(data.TELEFONE_1);
			$('#telefone_2').val(data.TELEFONE_2);
			
			$('#cep').val(data.CEP);
			$('#endereco').val(data.ENDERECO);
			$('#complemento').val(data.COMPLEMENTO);
			$('#bairro').val(data.BAIRRO);
			$('#cidade').val(data.CIDADE);
			$('#uf').val(data.UF);
			
			$('#cpf_responsavel').val(data.CPF_RESPONSAVEL);
			$('#nome_responsavel').val(data.NOME_RESPONSAVEL);
			$('#cargo_responsavel').val(data.CARGO_RESPONSAVEL);
			$('#email_responsavel').val(data.EMAIL_RESPONSAVEL);
			$('#telefone_1_responsavel').val(data.TELEFONE_1_RESPONSAVEL);
			$('#telefone_2_responsavel').val(data.TELEFONE_2_RESPONSAVEL);
			
		});
	
	}
	
}
</script>
<!-- FIM BUSCA CEP -->