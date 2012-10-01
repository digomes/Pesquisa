<?php
//arquivo do sistema de login verifica se existe sessão
include ("includes/Restrict.php");

//armazenando os dados da sessão em variaveis
	$id = $_SESSION['id_usuario'];
	$usuario = $_SESSION['usuario'];
	$nomeUsuario = $_SESSION['nome_usuario'];
	$nivel = $_SESSION['nivel'];
	$setor = $_SESSION['setor'];
	$expira = $_SESSION['expira'];
	$idPosto = $_SESSION['id_posto'];
	$ativo = $_SESSION['ativo'];
	$idAdmin = $_SESSION['id_adm'];
	$walita = $_SESSION['walita'];
	$saeco = $_SESSION['saeco'];
	$tv = $_SESSION['tv'];
	$naoTv = $_SESSION['nao_tv'];
	
include ("../tpvision/includes/classes/Mysql.php");
$Mysql = new Mysql();
$Mysql->conectar();	
	$dadosPosto = "SELECT * FROM posto WHERE id = '$idPosto'";
		$exePosto = $Mysql->consulta($dadosPosto);
			$dadosPosto = $Mysql->resultado($exePosto);
				$codigo_posto_logado = $dadosPosto['codigo'];
                                $cepLogado = $dadosPosto['cep'];
                                $newCep = explode("-", $cepLogado);
                                $CepCompra = $newCep['0'].$newCep['1'];
                                
                               

if($tv != '1'){
header("Location: ../tpvision/login.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pesquisa Suporte Técnico</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/formee.js"></script>
        <script type="text/javascript" src="js/addCampo.js"></script>
        <script type="text/javascript" src="js/highcharts.js"></script>
        <script type="text/javascript" src="js/modules/exporting.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/html5shiv.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/buscaSelect.js"></script>
        <link rel="stylesheet" href="css/form-structure.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/form-style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/painel.css" type="text/css" media="screen" />
    </head>
<body>
    <!--Inicio Topo-->
<header class="topo">
    <div class="logo"></div>
</header>
    <!--Fim Topo-->
    
    <!--Inicio menu Lateral-->
<aside class="left">
    <nav>
        <ul>
            <li><a href="?pag=funForm">Cadastro de Formulario</a></li>
            <li><a href="?pag=cadastroPesquisa">Cadastro de Perguntas</a></li>
            <li><a href="?pag=consultaResposta">Consulta de Respostas</a></li>
            <li><a href="?pag=graficoPesquisa">Graficos de Respostas</a></li>
            <li><a href="?pag=exportaConsulta">Exportar Pesquisa</a></li>
            <li><a href="?pag=pesquisasAbertas">Pesquisas Abertas</a></li>
        </ul>
    </nav>
</aside>
 <!--Fim Menu Lateral--> 
 
 <!--Inicio Section-->
<section>
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
//Incluir a classe excelwriter
include("excelwriter.inc.php");

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
</section>
 <!--Fim Section-->
 
 <!--Inicio Footer-->
<footer>
    
</footer>   
 <!--Fim Footer-->
</body>
</html>        