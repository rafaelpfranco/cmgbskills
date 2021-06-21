<!-- MASCARAS -->
<script type="text/javascript">
	
	function dat(z){  
	v = z.value;
	v=v.replace(/\D/g,"")  //permite digitar apenas números
	v=v.replace(/[0-9]{9}/,"")   //limita pra máximo 9999-9999
	v=v.replace(/(\d{1})(\d{6})$/,"$1/$2")  //coloca ponto antes dos últimos 8 digitos
	v=v.replace(/(\d{1})(\d{4})$/,"$1/$2")  //coloca ponto antes dos últimos 5 digitos
	//v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function horas(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{12}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{9})$/,"$1")  //coloca ponto antes dos últimos 8 digitos
		//v=v.replace(/(\d{1})(\d{8})$/,"$1:$2")  //coloca ponto antes dos últimos 5 digitos
		//v=v.replace(/(\d{1})(\d{5})$/,"$1:$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{2})$/,"$1:$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function numcep(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{9}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{9})$/,"$1")  //coloca ponto antes dos últimos 8 digitos
		v=v.replace(/(\d{1})(\d{6})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{3})$/,"$1-$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function numhoras(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{9}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{9})$/,"$1")  //coloca ponto antes dos últimos 8 digitos
		//v=v.replace(/(\d{1})(\d{6})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{2})$/,"$1:$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function mtel(z) {
	    v = z.value;
	    v=v.replace(/\D/g,"");
	    v=v.replace(/^(\d{2})(\d)/g,"($1)$2");
	    v=v.replace(/(\d)(\d{4})$/,"$1-$2");
	    	z.value = v;
	}
	
	function somentenum(z) {
	    v = z.value;
	    v=v.replace(/\D/g,"");
	    //v.replace(/^(\d{2})(\d)/g,"($1)$2");
	    v=v.replace(/(\d)(\d{3})$/,"$1");
	    	z.value = v;
	}
	
	function somente_num(z) {
	    v = z.value;
	    v=v.replace(/\D/g,"");
	    //v.replace(/^(\d{2})(\d)/g,"($1)$2");
	    v=v.replace(/(\d)(\d{5})$/,"$1");
	    	z.value = v;
	}
	
	function letras(e){
	    var expressao;
		expressao = /[a-zA-Z]/;
	
	    if(expressao.test(String.fromCharCode(e.keyCode))){
	            return true;
	    }else{
	            return false;
	    }
    }
    
    function numcpf(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{12}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{9})$/,"$1")  //coloca ponto antes dos últimos 8 digitos
		v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{2})$/,"$1-$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function numcnpj(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{18}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{9})$/,"$1")  //coloca ponto antes dos últimos 8 digitos
		v=v.replace(/(\d{1})(\d{12})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{9})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{6})$/,"$1/$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{2})$/,"$1-$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function val(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{9}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
		//v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function peso(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{9}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
		//v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{1,3})$/,"$1,$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function valo(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{9}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
		//v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{1,2})$/,"$1.$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function aniversario(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
		v=v.replace(/[0-9]{5}/,"")   //limita pra máximo 9999-9999
		//v=v.replace(/(\d{1})(\d{9})$/,"$1")  //coloca ponto antes dos últimos 8 digitos
		//v=v.replace(/(\d{1})(\d{6})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
		v=v.replace(/(\d{1})(\d{2})$/,"$1/$2")        //coloca virgula antes dos últimos 2 digitos
			z.value = v;
	}
	
	function cpfCnpj(z){  
		
		v = z.value;
		
		tamanho = v.replace(/\D/g,"").length;
		
		if(tamanho <= 11){
			
			v = v.replace(/\D/g,"")  //permite digitar apenas números
			v = v.replace(/[0-9]{14}/,"")   //limita pra máximo 9999-9999
			v = v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
			v = v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
			v = v.replace(/(\d{1})(\d{2})$/,"$1-$2")        //coloca virgula antes dos últimos 2 digitos
		
		}else{
			
			v = v.replace(/\D/g,"")  //permite digitar apenas números
			v = v.replace(/[0-9]{18}/,"")   //limita pra máximo 9999-9999
			v = v.replace(/(\d{1})(\d{12})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
			v = v.replace(/(\d{1})(\d{9})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
			v = v.replace(/(\d{1})(\d{6})$/,"$1/$2")  //coloca ponto antes dos últimos 5 digitos
			v = v.replace(/(\d{1})(\d{2})$/,"$1-$2")        //coloca virgula antes dos últimos 2 digitos
			
		}
				
		z.value = v;
		
	}
	
		
		
</script>
<!--FIM MASCARAS -->