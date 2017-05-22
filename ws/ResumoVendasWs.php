<?php

$servername = "mysql.hostinger.com.br";
$username = "u655756784_sid";
$password = "021082";
$dbname = "u655756784_temp";

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "dbgestao";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

if (mysqli_connect_errno()) {
    trigger_error(mysqli_connect_error());
}
$codUnidade = htmlspecialchars($_GET["codunidade"]);
$ano = htmlspecialchars($_GET["ano"]);

//Consultando banco de dados
$qryLista = mysqli_query($conn, "SELECT *"
        . "FROM vendames "
        . "WHERE codunidade = $codUnidade AND vendamesano = $ano") ;
if ($qryLista->num_rows > 0) {

    while ($row = $qryLista->fetch_assoc()) {
        
        $linha = array("codunidade" => $row["codunidade"], 
                        "vendames" => $row["vendames"],
                        "vendamesano" => $row["vendamesano"],
                        "vendamesvalor" => $row["vendamesvalor"]);
        $unidade['venda'][] = $linha;
    }
} else {

    $unidade = 0;
}

//Passando vetor em forma de json
echo json_encode($unidade);
?>