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
        <script type="text/javascript" src="js/sliding.form.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <link rel="stylesheet" href="css/form-structure.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/form-style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" />
    </head>
    <body>
<div id="content">
    <h1>Pesquisa</h1>

       <div id="wrapper">  
<?php
require("includes/form.class.php");
require("includes/funcoes.class.php");

$func = new recordset();
$func->conexao();

$idQuestion = intval($_GET['id']);

$selConf = $func->seleciona("SELECT * FROM confirma WHERE user_id = '$id' AND id_quest = '$idQuestion'");
    
    
    $nrLinhas = mysql_num_rows($selConf);
    

    if($nrLinhas == '1'){
        echo '<div class="form-msg-info">
                <h2>Obrigado por ter participado de nossa pesquisa !</h2>
              </div>';
        exit;
       
    }

    //iniciio da div steps
echo '<div id="steps">';



$a = new GEN_FORM();



//$select = $func->seleciona("SELECT q.*, o.* FROM questions q INNER JOIN options o ON q.id = o.ques_id ");
$select = $func->seleciona("SELECT p.id as idqs, p.*, f.* FROM formularios f INNER JOIN perguntas p ON f.id = p.form_id WHERE f.id = '$idQuestion'");
$nrQuestions = mysql_num_rows($select);

//
if($nrQuestions == '0'){
    echo '<div class="form-msg-info"><h3>Nenhuma pesquisa foi encontrada</h3></div>';
}
//iniciando o formulário
$a->setOpenForm();

//pegando a variavel com a quantidade de perguntas e fazendo um laço de repetição com for
for($i=1; $i <= $nrQuestions; $i++){

//aqui inicia cada pergunta     
echo '<fieldset class="step">'; 

// retornando os dados da consulta realizada acima
$resp = mysql_fetch_assoc($select);
$questId = $resp['idqs'];
$questionName  = $resp['ques']; 
   
            
//Aqui é o titulo da pergunta exibida acima do campo da pesquisa    
echo "<legend>".$questionName."</legend>"; 

//realizando a consulta das respostas de acordo com o id da pergunta
$selResposta = $func->seleciona("SELECT r.*, t.tipo FROM respostas r INNER JOIN tipos t ON r.tipo_id = t.id WHERE r.ques_id = '$questId'");

//abrindo a div para o campo do formulário


//laço de repetição para retornar os dados da pesquisa acima
while($res = mysql_fetch_assoc($selResposta)){

    //dados retornados 
    $idValue = $res['id'];
    $quesId = $res['ques_id'];
    $valueQuest = $res['value'];
    $tipoId = $res['tipo'];
  


//verificando se o tipo de campo é radio se for usa ul li para formar a pesquisa se não faz normal
if($tipoId == 'radio'){
    
echo '<div class="grid-11-12">';
    //criando os campos radio com a função de gerar formularios 
echo '<ul class="form-list">';
echo '<li>'; 
$a->fldName = $questId;
$a->fldId = "";
$a->fldType = "$tipoId";
$a->cssStyle ="";
$a->fldValue= "$valueQuest";
$a->fldReadOnly = 0;
$a->fldDisabled = 0;
$a->getField();
echo "<label for='$valueQuest'>".$valueQuest."</label>";  
echo '</li>';
echo '</ul>';
echo '</div>';

}else{
    
echo '<div class="grid-11-12">';   
echo "<label for='$valueQuest'>$valueQuest</label>";
if($tipoId == 'text'){
$a->fldName = $questId."-t".$idValue;
}else{
$a->fldName = $questId;  
}
$a->fldId = "";
$a->fldType = "$tipoId";
$a->cssStyle ="";
$a->fldValue= "";
$a->fldReadOnly = 0;
$a->fldDisabled = 0;
$a->getField();
echo '</div>';

} // termino do if else

} // termino do while 

//fim da div  campo do formulário e o fieldset que marca até onde vai a pergunta usando para criar o separador

echo    '</fieldset>';

} // fim do for com a quantidade

//pulando linha e fim de linha 
echo "\n<br>";
echo "\n\n";

// inicio da ultima parte com o botão de envio do formulário
echo '<fieldset class="step">';
echo "<legend>Obrigado por participar !!</legend>";
echo    '<p class="submit">';
echo    '<button id="registerButton" type="submit" name="ok">Enviar Resposta</button>';
echo    '</p>';

echo '</fieldset>';

//finalizando o formulario
$a->setCloseForm();
?>

    </div>
           <!--campo de navegação da pesquisa-->
        <div id="navigation" style="display:none;">
            <ul>
              <?php for($i=0; $i <= $nrQuestions; $i++){ ?>
                <li>
                    <a href="#"><?php echo $i; ?> </a>
                </li>
              <?php } ?>
            </ul>
        </div> 
    </div>
</div>
        
<?php 
        if(isset($_POST['ok'])){
            echo "<div class='form-msg-success'><h3>Pesquisa enviada com sucesso!</h3></div>";
            
        //$nrPostNull = count($_POST[$questId."-t"])."<br />";
           
           
            if($_POST[$questId."-t".$idValue] == ''){ 
                
                unset($_POST[$questId."-t".$idValue]);     
                $_POST[$questId];
                
            }
            
            
            
            $post = $_POST;
            
            $count = count($post);
            
            unset($post['ok']);
            
           
            $hoje = date('Y-m-d H:i:s');
            
            
            foreach($post as $idQuest => $Resp){
                
               if($Resp == ''){
                   unset($idQuest);
               }
                
                
                $cadResp = $func->seleciona("INSERT INTO votos (id, perg_id, resp_id, user_id, data) VALUES ('', '$idQuest', '$Resp', '$id', '$hoje')");
                
            }
                $delNull = $func->seleciona("DELETE FROM votos WHERE perg_id = '0'");
                $confirmaPesquisa = $func->seleciona("INSERT INTO confirma (id, user_id, id_quest, conf) VALUES ('', '$id', '$idQuestion', '1')");
            //print_r($post);
           
            
        }
        ?>
    </body>
</html>
