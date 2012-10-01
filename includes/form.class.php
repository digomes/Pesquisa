<?php

/**
 * Descrição do arquivo form
 *
 * @descrição
 * @versão 
 * @autor diego
 * @data 17/09/2012
 * @package Class.Form
 * @version 1.0
 */

class GEN_FORM{

/*******************
FORMULÁRIO
*******************/

/**
* Define o NOME do formulario ( default = "frm")
*
* @var string $frmName
*/ var $frmName = "form";

/**
* Define a Ação do formulário ( default = " ")
*
* @var string $frmAction
*/ var $frmAction = "";

/**
* Define o Metodo de envio do formulário
* (post ou get) ( default = "post")
*
* @var string $frmMethod
*/
var $frmMethod = "post";

/**
* Define comandos javascript caso for usado onSubmit()
*
* @var string $frmEvento
*/
var $frmEvento = "";

/**
* Define a ID do formulário ( default = "frm")
*
* @var string $frmId
*/ var $frmId = "form";
/**
* Define a classe do formulario
*
* @var string $fldClass
*/
var $frmClass = "form";

/**
* Desine o Enctype do formulário
* ( default = "multipart/form-data")
*
* @var string $frmEnctype
*/ var $frmEnctype = "multipart/form-data";


/*******************
CSS
*******************/

/**
* Defina a classe do css
*
* @var string $cssClass
*/
var $cssClass;

/**
* Define o estilo com css
*
* @var string $cssStyle
*/
var $cssStyle;

/*******************
Campos
*******************/

/**
* Define o Nome do Campo
*
* @var string $fldName
*/
var $fldName;

/**
* Define a ID do Campo
*
* @var string $fldId
*/
var $fldId;

/**
* Define o tipo de campo que será utilizado * Normais
* (text, hidden, checkbox, radio, file, image) *
* Especiais (select, textarea) * Botões (reset, submit, button)
*
* @var string $fldType
*/
var $fldType;

/**
* Bloqueia o campo " disabled " ( Default = 0)
*
* @var int
*/ var $fldDisabled = 0;

/**
* Seta o campo como ReadOnly ( Default = 0 )
*
* @var bool
*/
var $fldReadOnly = 0;

/**
* Define o option do select(ComboBox)
* como selected ( Default = 0)
*
* @var int
*/
var $fldSelected = 0;

/**
* Define o CheckBox como checked ( Default = 0)
*
* @var int
*/
var $fldChecked = 0;

/**
* Define o Máximo de caracteres do campo (se não setado unlimited )
*
* @var int
*/
var $fldMaxLength;

/**
* Define o valor inicial do campo ( Default = " ")
*
* @var mixed
*/ var $fldValue = "";

/**
* Define o valor inicial do campo ( Default = " ")
*
* @var mixed
*/ var $fldPlaceHolder = "";


/**
* Define os valores do option do $fldSelect ( Default = array() )
*
* @var array
*/
var $fldOptions = array();

/**
* Define a imagem caso o $fldType for " image " ( Default = " ")
*
* @var string
*/ var $fldSrc = "";

/**
* Atribui um evento de javascript ao Campo ( Default = " " )
*
* @var mixed $fldEvento
*/ var $fldEvento = "";

/**
* Seta a tag ALT do campo ( Default = "")
*
* @var String $fldAlt
*/ var $fldAlt = "";

/**
* Seta a TAG title do campo ( Default = "" )
*
* @var string $fldTitle
*/ var $fldTitle = "";


/*************************
SET
*************************/

/**
* Abre o Formulario utilizando as variaveis $frmAction, $frmMethod,
* $frmEnctype, $frmName, $frmId, $frmTarget
*
* @return mixed (Codigo HTML que começa um Form)
*/
function setOpenForm(){

print "<form action=\"$this->frmAction\" method=\"$this->frmMethod\" enctype=\"$this->frmEnctype\" name=\"$this->frmName\" id=\"$this->frmId\"  class=\"$this->frmClass\" $this->frmEvento>";

}

/**
* Fecha o formulário
*
* @return mixed (Codigo HTML que fecha o Form)
*/
function setCloseForm(){
print "</form>";
}

/**
* Vrifica qual é o tipo do campo a ser gerado
*
* @return mixed (HTML code)
*/
function getField(){
switch (strtolower($this->fldType)){
case "text":
print $this->setFldNormal();
break;
case "hidden":
print $this->setFldNormal();
break;
case "checkbox":
print $this->setFldNormal();
break;
case "radio":
print $this->setFldNormal();
break;
case "image":
print $this->setFldNormal();
break;
case "file":
print $this->setFldNormal();
break;

case "reset":
print $this->setFldNormal();
break;
case "submit":
print $this->setFldNormal();
break;
case "button":
print $this->setFldNormal();
break;
case "password":
print $this->setFldNormal();
break;
case "select":
print $this->setFldSelect();
break;
case "textarea":
print $this->setFldtextArea();
break;
}

/*reseta as variaveis*/
$this->doClear();
}

/**
* Seta o campo como Disabled
*
* @return string
*/
function setDisabled(){
switch ($this->fldDisabled){
case 1 :
return " disabled=\"disabled\" ";
break;
default: return "";
}
}

/**
* Seta o campo como Checked
*
* @return string
*/
function setChecked(){
switch ($this->fldChecked){
case 1 :
return " checked=\"checked\" ";
break;
}
}

/**
* Seta o campo como Checked
*
* @return string
*/
function setSelected(){
switch ($this->fldSelected){
case 1 :
return " selected=\"selected\" ";
break;
}
}

/**
* Seta o campo com readonly
*
* @return mixed (HTML TAG CODE)
*/
function setReadOnly(){
switch ($this->fldReadOnly){
case 1 :
return " readonly ";
break;
default: return "";
}
}

/**
* Gera o campo do form tipo Normal (text, hidden, checkbox, radio...)
*
* @return mixed $input ( "Código html do campo" )
*/ function setFldNormal(){
$input = "<input name=\"$this->fldName\" id=\"$this->fldId\" type=\"$this->fldType\" src=\"$this->fldSrc\" ".$this->setDisabled() . $this->setChecked ." value=\"$this->fldValue\" maxlength=\"$this->fldMaxLength\" " . $this->setReadOnly() . "alt=\"$this->fldAlt\" title=\"$this->fldTitle\" style=\"$this->cssStyle\" class=\"$this->cssClass\"  placeholder=\"$this->fldPlaceHolder\" $this->fldEvento />";
return $input;
}

/**
* Gera o campo do form tipo Select
*
* @return mixed ( print "Código html do campo")
*/ function setFldSelect(){
$tag = "<select name=\"$this->fldName\" id=\"$this->fldId\" style=\"$this->cssStyle\" class=\"$this->cssClass\" $this->fldEvento >";
$tag .= $this->setFldSelectOption();
$tag .= "</select>";

}

/**
* Gera os options do campo select (ComboBox)
*
* @return mixed $op ( print "Código html do campo")
*/ function setFldSelectOption(){
foreach($this->fldOptions as $Key => $Value) {
$v1 = $key;
$v2 = $value;
if ($v2 <> ''){
$op .= "<option value=\"$v1\" $this->setSelected()>".$v2."</option>";
}
}
return $op;
}

/**
* Gera o campo de textarea
*
* @return mixed ( HTML TAG CODE )
*/
function setFldTextArea(){
$Field .= "<textarea name=\"$this->fldName\" id=\"$this->fldId\" class=\"$this->cssClass\" style=\"$this->cssStyle\" title=\"$this->fldTitle\"" . $this->setReadOnly() ." ". $this->setDisabled() . " $this->fldEvento >";
$Field .= $this->fldValue;
$Field .= "</textarea>";
return $Field;
}

/**
* Limpa todas as Variaveis da Classe
*
* @return void
*
*/
function doClear(){
$this->frmName = "form";
$this->frmAction = "";
$this->frmMethod = "post";
$this->frmEvento = "";
$this->frmId = "form";
$this->frmClass = "form";
$this->frmEnctype = "multipart/form-data";
$this->cssClass = "";
$this->cssStyle = "";
$this->fldName = "";
$this->fldId = "";
$this->fldType = "";
$this->fldDisabled = 0;
$this->fldReadOnly = 0;
$this->fldSelected = 0;
$this->fldChecked = 0;
$this->fldMaxLength = "";
$this->fldValue = "";
$this->fldOptions = array();
$this->fldSrc = "";
$this->fldEvento = "";
$this->fldAlt = "";
$this->fldTitle = "";
}

}
?>

