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
foreach ($xml as $empresa){
   $codempresa = (int) $empresa->codempresa;
   $razaosocial= (string)$empresa->empresarazaosocial;
   $token = (string)$empresa->token;
    $sql = "INSERT INTO empresa (empresarazaosocial, codempresa,token) VALUES ('$razaosocial', $codempresa, '$token')";
    $conn->query($sql);
    //echo $a;
}
$conn->close();