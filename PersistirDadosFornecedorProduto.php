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



