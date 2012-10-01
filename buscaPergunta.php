<?php

mysql_connect("localhost", "root", "210190");
mysql_select_db("forms");

$tipo = $_POST['tipo'];

$sql = "SELECT * FROM perguntas WHERE form_id = '$tipo' ORDER BY id ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   echo  '<option value="0">'.htmlentities('Nenhuma pergunta foi localizada...').'</option>';
   
}else{
   	  echo '<option value="">Escolha a pergunta...</option>';
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['id'].'">'.utf8_encode($ln['ques']).'</option>';
	  
   }
}

?>