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

//echo '<form action="" class="form">';
//echo '<fieldset>';
//echo '<legend>Pesquisas Cadastradas</legend>';

while($resuPesq = mysql_fetch_assoc($selPesquisas)){
    $idPesq = $resuPesq['id'];
    $nomePesq = $resuPesq['nome'];
    
    $host = $_SERVER['HTTP_HOST']."/pesquisa/index.php?id=".$idPesq;
    
    echo '<form action="" class="form">';
    echo '<fieldset>';
    echo '<div class="grid-12-12">
            <label for="">'.$nomePesq.'</label>
            <input type="text" value="'.$host.'" readonly="readonly"/>
        </div>';
    echo '</fieldset>';
    echo '</form>';
}
//echo '</fieldset>';
//echo '</form>';
?>
