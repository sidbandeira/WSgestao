<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastrows";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    //verifica se não deu erro na conexao
    $dataRet = array ("wsId" => 0, 
                      "wsMsg"=> utf8_encode("Erro de Acesso ao Banco de dados"));
    
    echo json_encode($dataRet);
    return;
} 
//RECUPERA OS DADOS DA TELA
$nome = $_GET["nome"];
$email = $_GET["email"];

echo '' + $nome;
// SQL DE INSERÇÃO
$sql = "INSERT INTO clientes (nome, email)VALUES ('$nome','$email')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    // 
    $dataRet= array("wsId"=> 1,
                    "wsMsg"=>  utf8_encode("Ok! Cliente ". $nome . " Inserido com Sucesso - id: " .$last_id ));
} else {
    $dataRet = array ("wsId" => 0, 
                      "wsMsg"=> utf8_encode("Erro no cadastro" . $conn-> error));
}

echo json_encode($dataRet);

$conn->close();
?>