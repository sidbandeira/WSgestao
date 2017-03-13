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
foreach ($xml as $tanque){
   $descricao = (string)$tanque->combustivel;
   $capacidade = (float)$tanque->capacidade;
   $dtUltimaCompra = (string)$tanque->dtultimacompra;
   $saldo = (float)$tanque->saldo;
   $dtSaldo =(string) $tanque->dtsaldo;
   $codIntegracao = (int)$tanque->codintegracao;
   $codEmpresa = (int)$tanque->codempresa;
   $tiporegistro = (int)$tanque->tiporegistro;
   
   
   if ($tiporegistro == 0) {
       $sql = "INSERT INTO tanque (tanquecombustivel, tanquecapacidade, dataultimacompra, tanquesaldo, datasaldo, codintegracao, codempresa)"
         . "VALUES ('$descricao', $capacidade, $dtUltimaCompra, $saldo, $dtSaldo, $codIntegracao, $codEmpresa)";
   }else{
       $sql = "UPDATE tanque SET tanquecombustivel = '$descricao', tanquecapacidade = $preco, dataultimacompra = $dtUltimaCompra',"
                            . "tanquesaldo = $saldo, datasaldo = $dtSaldo"
               . " WHERE codintegracao =  $codintegracao and codempresa =  $codempresa";
   }
    $conn->query($sql);
}

$conn->close();



