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
echo "<legend>Cadastro de Campos</legend>";

echo '<div class="grid-6-12">';
echo '<label for="">Digite a descricao do campo <em class="formee-req">*</em></label>';
$a->fldName             = "nome";
$a->fldId               = "nome";
$a->fldType             = "text";
$a->cssStyle            = "";
$a->fldValue            = "";
$a->fldPlaceHolder      = "Digite a descricao do Campo ";
$a->getField();
echo '</div>';

echo '<div class="grid-6-12">';
echo '<label for="">Digite o tipo do campo <em class="formee-req">*</em></label>';
$a->fldName             = "tipo";
$a->fldId               = "tipo";
$a->fldType             = "text";
$a->cssStyle            = "";
$a->fldValue            = "";
$a->fldPlaceHolder      = "Digite o tipo do campo Aqui";
$a->getField();
echo '</div>';


echo '<div class="grid-12-12">';
echo  '<input type="submit" value="Cadastrar Campo" name="salvar" />';
echo '</div>';


//fechando o form com a classe
echo "</fieldset>";
$a->setCloseForm();



if(isset($_POST['salvar'])){
    
extract($_POST);

$quantidade = count($resp);


$cadQues = $func->seleciona("INSERT INTO tipos (id, tipo, nome) VALUES ('', '$tipo', '$nome')");



}
?>
