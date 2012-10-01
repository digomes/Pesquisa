  
      $(document).ready(function(){
        // Evento change no campo tipo  
         $("select[name=formulario]").change(function(){
            // Exibimos no campo marca antes de concluirmos
			$("select[name=quest]").html('<option value="">Carregando...</option>');
            // Exibimos no campo marca antes de selecionamos a marca, serve também em caso
			// do usuario ja ter selecionado o tipo e resolveu trocar, com isso limpamos a
			// Passando tipo por parametro para a pagina ajax-marca.php
            $.post("buscaPergunta.php",
                  {tipo:$(this).val()},
                  // Carregamos o resultado acima para o campo marca
				  function(valor){
                     $("select[name=quest]").html(valor);
                  }
                  )
         })

	 
	  })
      
