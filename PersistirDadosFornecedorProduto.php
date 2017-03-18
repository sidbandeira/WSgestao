<!DOCTYPE HTML>
<html>
    <body>
        <h2>Arquivo importado com sucesso!</h2>
        <a href="index.php"> Voltar</a>
    </body>
</html>

<?php
//$servername = "mysql.hostinger.com.br";
//$username = "u655756784_sid";
//$password = "021082";
//$dbname = "u655756784_temp";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbgestao";
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
   $codintegracaoproduto = (int)$produto->codintegracaoproduto;
   $codintegracaofornecedor = (int)$produto->codintegracaofornecedor;
   $codempresa = (int)$produto->codempresa;
      
   //if ($tiporegistro == 0) {
       $sql = "INSERT INTO produtofornecedor (idproduto,idfornecedor, codempresa)"
               ."SELECT idproduto,idfornecedor , $codempresa"
               ." FROM(SELECT  idproduto"
                    ." FROM PRODUTO WHERE CodIntegracao = $codintegracaoproduto ) AS CONSULTA1"
               ." CROSS JOIN"
                    ." (SELECT idfornecedor"
                    ." FROM fornecedor WHERE CodIntegracao = $codintegracaofornecedor ) AS CONSULTA2 ";           
   //}
    $conn->query($sql);
}

$conn->close();



