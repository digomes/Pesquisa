<?php

/**
 * Descrição do arquivo funcoes
 *
 * @descrição
 * @versão 
 * @autor diego
 * @data 17/08/2012
 */
//criando a class
class recordset{
  //declarando variaveis publicas
    
    public $banco = 'forms';
    public $usuario = 'root';
    public $senha = '210190';
    public $hostname = 'localhost';
    
    //funcao de conexao ao BD
    function conexao(){
        header('Content-Type: text/html; charset=utf-8');
        $conn = mysql_connect($this->hostname,$this->usuario,$this->senha);
        mysql_select_db($this->banco) or die('Não foi possível conectar ao Banco de Dados'.mysql_error());
        
        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');
    }
    
    //funcao selecionar os dados BD
    function seleciona($sql){
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
    }
    
    //funcao para inserir dados no BD
    function inserir($tabela, $dados){
        //pegar campos do array
        $arrCampos = array_keys($dados);
        //pegar valores do array
        $arrValores = array_values($dados);
        //contando numero de campos
        $numCampo = count($arrCampos);
        //contando numero de valores
        $numValores = count($arrValores);
        //validacao se os campos tem o mesmo numero de valores
        if($numCampo == $numValores){
        $sql = "INSERT INTO ".$tabela." ("; 
            foreach ($arrCampos as $campo){
                $sql .= "$campo,"; 
            }
        $sql = substr_replace($sql,")", -1, 1);
        $sql .= " VALUES (";
            foreach($arrValores as $valores){
                $sql .= "'".$valores."',";
            }
        $sql = substr_replace($sql,")", -1, 1);

        }else{
            echo "Há um erro em sua query";
        }
        
        $this->seleciona($sql);
    }
    
    //funcao para atualizar dados 
    
    function alterar($tabela, $dados, $string){
        //pegar campos do array
        $arrCampos = array_keys($dados);
        //pegar valores do array
        $arrValores = array_values($dados);
        //contando numero de campos
        $numCampo = count($arrCampos);
        //contando numero de valores
        $numValores = count($arrValores);
        //Construindo a String 
        if($numCampo == $numValores && $numValores > 0){
            $sql = "UPDATE ".$tabela." SET ";
            for($i = 0; $i < $numCampo; $i++){
                $sql .= $arrCampos[$i]." = '".$arrValores[$i]."',";
            }
            $sql = substr_replace($sql," ", -1, 1);
            $sql .= "WHERE $string";
        }else{
            echo 'Houve um erro na sua query';
        }
        
        $this->seleciona($sql);
    }
    
}
?>
