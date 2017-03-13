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
foreach ($xml as $produto){
   $descricao = (string)$produto->produtodescricao;
   $preco = (float)$produto->produtoprecovenda;
   $codintegracao = (int)$produto->codintegracao;
   $codempresa = (int)$produto->codempresa;
   $tiporegistro = (int) $produto->tiporegistro;
   
   if ($tiporegistro == 0) {
       $sql = "INSERT INTO produto (produtodescricao, produtoprecovenda,codintegracao, codempresa) "
         . "VALUES ('$descricao', $preco, $codintegracao, $codempresa)";
   }else{
       $sql = "UPDATE produto SET produtodescricao = '$descricao', produtoprecovenda = $preco"
               . " WHERE codintegracao =  $codintegracao and codempresa =  $codempresa";
   }
    $conn->query($sql);
}

$conn->close();



