<?php

/**
 * Descrição do arquivo consultaResposta
 *
 * @descrição
 * @versão 
 * @autor diego
 * @data 25/09/2012
 */
?>
<form action="" class="form" method="POST">
    <fieldset>
        <legend>Consulta respostas</legend>
        <?php
        echo '<div class="grid-10-12">';
        echo '<label for="">Selecione o Formulario <em class="formee-req">*</em></label>';

            $selForm = $func->seleciona("Select * from formularios ORDER BY id ASC");
            echo '<select name="formulario" class="formee-small">';
            while($resForm = mysql_fetch_assoc($selForm)){
    
            $v1 = $resForm['id'];
            $v2 = $resForm['nome'];
    
            echo "<option value=".$v1.">".$v2."</option>";

            }
        echo '</select>';
        echo '</div>';
        ?>
        
        <div class="grid-12-12">
            <label for="">Digite o Usuário<em></em></label>
            <input type="text" name="posto" placeholder="Digite aqui o usuário do posto para consulta"/>
        </div>
        
        <div class="grid-12-12">
                <input type="submit" name="enviar" value="Buscar"/>
        </div>
    </fieldset>
</form>
<?php

if(isset($_POST['enviar'])){
    extract($_POST);
    
    
    $selUser = $func->seleciona("SELECT * FROM cakes.usuarios WHERE usuario = '$posto'");
    $numLinha = mysql_num_rows($selUser);
    
    if($numLinha == '0'){
        echo '<div class="form-msg-error">
            <h2>Nenhum resultado foi localizado para esse usuário.</h2>
        </div>';
       return;
    }
    
    $resUser = mysql_fetch_assoc($selUser);
    
    $idUsuario = $resUser['id'];
    $nomeUsuario = $resUser['nome'];
    
    $selResp = $func->seleciona("SELECT v.*, p.ques FROM votos v INNER JOIN perguntas p ON  p.id = v.perg_id WHERE v.user_id = '$idUsuario' AND p.form_id = '$formulario'");
    
    
    echo '<div class="form-msg-info">
        <h2>Respostas enviadas pelo usuário '.$nomeUsuario.'</h2>
    </div>';
    while($results = mysql_fetch_assoc($selResp)){
    
    $pergunta = $results['ques'];
    $respId = $results['resp_id'];

  
    echo '<form action="" class="form">';
    
    echo '<div class="grid-11-12">';
    echo '<label for="">'.$pergunta.'<em></em></label>';
    $a->fldName = "";
    $a->fldId = "";
    $a->fldType = "text";
    $a->cssStyle ="";
    $a->fldValue= "$respId";
    $a->fldReadOnly = 1;
    $a->fldDisabled = 0;
    $a->getField();
    echo '</div>';
    
    echo '</form>';
  
    }
}

?>