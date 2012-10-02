<?php

/**
 * Descrição do arquivo pesquisasAbertas
 *
 * @descrição
 * @versão 
 * @autor diego
 * @data 02/10/2012
 */

//pegando todas as pesquisas abertas no sistema
$selPesquisas = $func->seleciona("SELECT * FROM formularios ORDER BY id ASC");

echo '<form action="" class="form">';
echo '<fieldset>';
echo '<legend>Pesquisas Cadastradas</legend>';

while($resuPesq = mysql_fetch_assoc($selPesquisas)){
    $idPesq = $resuPesq['id'];
    $nomePesq = $resuPesq['nome'];
    
    $host = $_SERVER['HTTP_HOST']."/pesquisa/index.php?id=".$idPesq;
    

    echo '<div class="grid-12-12">';
    echo '<label for="">'.$nomePesq.'</label>';
    echo '<input type="text" value="'.$host.'" id="'.$idPesq.'" readonly="readonly" class="input"/>';
    echo '<a href="#" class="delete" id="'.$idPesq.'">Deletar Pesquisa</a>';           
    echo '</div>';

}
echo '</fieldset>';
echo '</form>';
?>
