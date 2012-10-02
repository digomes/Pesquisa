<?php

/**
 * Descrição do arquivo cadastroPesquisa
 *
 * @descrição
 * @versão 
 * @autor diego
 * @data 17/09/2012
 */

//abrindo o form com a classe
$a->setOpenForm();
echo "<fieldset>";
echo "<legend>Cadastro de Pesquisa</legend>";

echo '<div class="grid-10-12">';
echo '<label for="">Selecione o Formulario <em class="formee-req">*</em></label>';

$selForm = $func->seleciona("Select * from formularios ORDER BY id DESC");
echo '<select name="formulario" class="formee-small">';
while($resForm = mysql_fetch_assoc($selForm)){
    
    $v1 = $resForm['id'];
    $v2 = $resForm['nome'];
    
    echo "<option value=".$v1.">".$v2."</option>";

}
echo '</select>';
echo '</div>';


echo '<div class="grid-10-12">';
echo '<label for="">Digite a Pergunta <em class="formee-req">*</em></label>';
$a->fldName             = "ques";
$a->fldId               = "ques";
$a->fldType             = "text";
$a->cssStyle            = "";
$a->fldValue            = "";
$a->fldPlaceHolder      = "Digite Sua Pergunta Aqui ";
$a->getField();
echo '</div>';


echo '<div class="grid-6-12">';
echo '<div class="modelos">';
echo '<p class="campomodelos">';
echo '<label>Resposta da Pergunta<em class="formee-req">*</em></label>';

$a->fldName             = "resp[]";
$a->fldId               = "auto";
$a->fldType             = "text";
$a->cssStyle            = "";
$a->fldValue            = "";
$a->fldPlaceHolder      = "Digite a Resposta Aqui";
$a->getField();

//echo '<div class="grid-10-12">';
echo '<label for="">Selecione o Tipo do Campo <em class="formee-req">*</em></label>';

$selTipo = $func->seleciona("Select * from tipos ORDER BY id ASC");
echo '<select name="tipo[]" class="formee-small">';
while($resTipo = mysql_fetch_assoc($selTipo)){
    
    $v1 = $resTipo['id'];
    $v2 = $resTipo['tipo'];
    $v3 = $resTipo['nome'];
    
    echo "<option value=".$v1.">".$v2."</option>";

}
echo '</select>';
//echo '</div>';

echo '<a href="#" class="removerCampo"><img src="img/delete.png"></a>';
echo '</p>';
echo '</div>';			
echo '<p>';
echo '<a href="#" class="adicionarCampo"><img src="img/add.png"></a>';
echo '</p>';
echo '</div>';
echo '<div class="grid-12-12">';
echo  '<input type="submit" value="Cadastrar Pesquisa" name="salvar" />';
echo '</div>';


//fechando o form com a classe
echo "</fieldset>";
$a->setCloseForm();



if(isset($_POST['salvar'])){
    
extract($_POST);

$quantidade = count($resp);
$hoje       = date('Y-m-d H:i:s');


$cadQues = $func->seleciona("INSERT INTO perguntas (id, ques, form_id, created, modified) VALUES ('', '$ques', '$formulario', '$hoje', '')");

$UltId = $func->seleciona("SELECT last_insert_id() as last FROM perguntas");

$resId = mysql_fetch_assoc($UltId);

$idQues = $resId['last'];

for ($i=0; $i<$quantidade; $i++) {
    
$cadOpt = $func->seleciona("INSERT INTO respostas (id, ques_id, value, tipo_id) VALUES ('', '$idQues', '$resp[$i]', '$tipo[$i]')"); 
    
}


$host = $_SERVER['HTTP_HOST']."/pesquisa/index.php?id=".$formulario;

echo '<form class="form">';
echo '<fieldset>';
echo '<div class="grid-6-12">';
echo '<label>Url da pesquisa</label>';
echo "<input type='text' value='$host'/>";
echo '</div>';
echo '</fieldset>';
echo '</form>';

}
?>
