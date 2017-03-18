<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastrows";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
 $dataRet = array("wsId"=>0,
 "wsMsg"=>utf8_encode("Erro de Acesso ao Banco de Dados"));
 echo json_encode($dataRet);
 return;
}
$nome = htmlspecialchars($_POST["nome"]);
$email = htmlspecialchars($_POST["email"]);
$sql = "INSERT INTO clientes (nome, email) VALUES ('$nome', '$email')";
// se a execução do comando retornar true
if ($conn->query($sql) === TRUE) {
 $last_id = $conn->insert_id;
 $dataRet = array("wsId"=>1,
 "wsMsg"=>utf8_encode("Ok! Cliente ".$nome." Inserido com Sucesso - Id: ".$last_id));
} else {
 $dataRet = array("wsId"=>0,
 "wsMsg"=>utf8_encode("Erro no Cadastro " . $conn->error));
}
echo json_encode($dataRet);
$conn->close();