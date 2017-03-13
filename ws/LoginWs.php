<?php

$servername = "mysql.hostinger.com.br";
$username = "u655756784_sid";
$password = "021082";
$dbname = "u655756784_temp";

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "temporario";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    $dataRet = array("wsCodempresa"=>0,
                     "wsMsg"=>utf8_encode("Erro de Acesso ao Banco de Dados"));
    echo json_encode($dataRet);
    return;
} 

$email = htmlspecialchars($_GET["email"]);
$senha = htmlspecialchars($_GET["senha"]);

//$senha = md5($senha1);

$sql = "SELECT * FROM usuario where emailusuario='$email' and senhausuario='$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $codEmpresa = $row["codempresa"];
    
    $dataRet = array("wsCodempresa"=>$codEmpresa,
                        "wsMsg"=>utf8_encode("Ok!"));

} else {
    $dataRet = array("wsCodempresa"=>0,
                    "wsMsg"=>utf8_encode("Usuário ou senha inválidos."));
}
echo json_encode($dataRet);
$conn->close();

?>