<?php

/**
 * Descrição do arquivo graficoPesquisa
 *
 * @descrição
 * @versão 
 * @autor diego
 * @data 27/09/2012
 */

if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0){
header("location: ../index.php");
}

include ("includes/PieChart.php");


?>
<form action="" class="form" method="POST">
    <fieldset>
        <legend>Grafico de Respostas</legend>
        <?php
        echo '<div class="grid-3-12">';
        echo '<label for="">Selecione o Formulario <em class="formee-req">*</em></label>';

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
        
        <div class="grid-12-12">
        <label for="">Selecione o Formulario <em class="formee-req">*</em></label>
        <select name="quest" id="quest" class="formee-small">
        </select>
        </div>
        
    <div class="grid-8-12">
        <input type="submit" value="Ok" name="ok"/>
    </div>    
   </fieldset> 
</form>

<?php 
if(isset($_POST['ok'])){
    
extract($_POST);
echo "<script>";
 
$selectDados = $func->seleciona("SELECT COUNT(v.resp_id) as Total, v.resp_id as Quest FROM votos v INNER JOIN (perguntas p INNER JOIN respostas r ON r.ques_id = p.id) ON r.value = v.resp_id  WHERE p.form_id = '$formulario' AND v.perg_id = '$quest' AND r.tipo_id = '4' GROUP BY v.resp_id");


    while($resDados = mysql_fetch_assoc($selectDados)){
       
               $name[] = array($resDados['Quest'], $resDados['Total'],) ;
        
        }

             
$dados = $name;

/* Grafico em Coluna
 * 
 $dados = array(
  'Perguntas' => $name,
); 
 * 
 */
 
$charts = new LineChart(array( 
   "title"      => array("Grafico de Respostas",""), 
   "container"   => "container",
   "y" => array( 
      "title"=>"Grafico de Respostas" 
   ),
   "series"   => $dados
)); 
?> 
$(document).ready(function() { 
   <?php echo $charts->render(); ?> 
});
</script>

<?php } 
?>

<div id="container">
    
</div>