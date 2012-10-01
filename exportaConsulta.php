<form action="" class="form" method="POST">
    <fieldset>
        <legend>Exportar Pesquisa Para Excel</legend>
        <?php
        echo '<div class="grid-12-12">';
        echo '<label for="">Selecione a Pesquisa para exportar<em class="formee-req">*</em></label>';

            $selForm = $func->seleciona("Select * from formularios ORDER BY id ASC");
            
            echo '<select name="formulario" id="formulario" class="formee-small">';
            
            echo "<option value='0'>Selecione a Pesquisa</option>";
            
            while($resForm = mysql_fetch_assoc($selForm)){
    
            $v1 = $resForm['id'];
            $v2 = $resForm['nome'];
    
            echo "<option value=".$v1.">".$v2."</option>";

            }
        echo '</select>';
        echo '</div>';
        ?>
    <div class="grid-8-12">
        <input type="submit" value="Ok" name="ok"/>
    </div>   
    </fieldset>
</form>
<?php
if(isset($_POST['ok'])){
    
    extract($_POST);



   //Você pode colocar aqui o nome do arquivo que você deseja salvar.
    $excel = new ExcelWriter("formulario".$formulario.".xls");

    if($excel==false){
        echo $excel->error;
   }

   //Escreve o nome dos campos de uma tabela
   $myArr=array('PERGUNTA','RESPOSTA','USUARIO', 'NOME', 'DATA');
   $excel->writeLine($myArr);


    
   $consulta = $func->seleciona("SELECT  p.ques, v.resp_id, u.usuario, u.nome, v.data FROM cakes.usuarios u INNER JOIN (forms.votos v INNER JOIN forms.perguntas p ON p.id = v.perg_id) ON v.user_id = cakes.u.id WHERE p.form_id = '$formulario'");    

      while($linha = mysql_fetch_array($consulta)){
          
         $myArr=array($linha['ques'],$linha['resp_id'],$linha['usuario'],$linha['nome'],$linha['data']);
         
         $excel->writeLine($myArr);
         
      }
      
  

    $excel->close();
    
    echo "<div class='form-msg-info'><h2>O arquivo foi salvo com sucesso. <a href=formulario".$formulario.".xls>Baixar o Arquivo</a></h2></div>";
}
?>

