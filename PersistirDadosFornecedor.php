<!DOCTYPE HTML>
<html>
    <body>
        <h2>Arquivo importado com sucesso!</h2>
        <a href="menu.php"> Voltar</a>
    </body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temporario";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
 $dataRet = array("wsId"=>0,
 "wsMsg"=>utf8_encode("Erro de Acesso ao Banco de Dados"));
 echo json_encode($dataRet);
 return;
}
$_FILES['arquivo']['name'];

$xml = simplexml_load_file($_FILES['arquivo']['tmp_name']);
 
/* Percorre o objeto e imprime na tela as informações de cada contato */
foreach ($xml as $fornecedor){
   $codempresa = (int) $fornecedor->codempresa;
   $codintegracao = (int) $fornecedor->codintegracao;
   $tiporegistro = (int) $fornecedor->tiporegistro;
   
   if ($tiporegistro == 0) {
       $sql = "INSERT INTO fornecedor (fornecedorrazaosocial, codintegracao, codempresa) "
         . "VALUES (' $fornecedor->fornecedorrazaosocial',$codintegracao, $codempresa)";
   }else{
       $sql = "UPDATE fornecedor SET fornecedorrazaosocial = '$fornecedor->fornecedorrazaosocial'"
               . "WHERE codintegracao =  $codintegracao and codempresa =  $codempresa";
   }
    $conn->query($sql);
}

$conn->close();



