<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pesquisa Suporte Técnico</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/formee.js"></script>
        <script type="text/javascript" src="js/addCampo.js"></script>
        <link rel="stylesheet" href="css/form-structure.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/form-style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" />
    </head>
    <body>

<?php

/**
 * Descrição do arquivo painel
 *
 * @descrição
 * @versão 
 * @autor diego
 * @data 17/09/2012
 */
require("includes/form.class.php");
require("includes/funcoes.class.php");

$func = new recordset();
$func->conexao();

$a = new GEN_FORM();


$pagina = mysql_real_escape_string(trim($_GET['pag']));

switch($pagina){
  
	/*
        case "";
	include utf8_decode("listaInicial.php");
	break;
        */
    
	case $pagina:
	if(isset($_GET['pag'])){
	if(file_exists($pagina.'.php')){
		include utf8_decode($pagina.'.php');
	}else{
		include '404.php';
	}}
	break;

}
?>
    </body>
</html>