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

//Consultando banco de dados
$qryLista = mysqli_query($conn, "SELECT * "
        . "FROM tanque "
        . "WHERE ativo = '0' AND codunidade = $codUnidade");
if ($qryLista->num_rows > 0) {

    while ($row = $qryLista->fetch_assoc()) {
        
        $linha = array("codintegracao" => $row["codintegracao"], 
                          "descricao" => $row["tanquecombustivel"],
                          "volumetotal" => $row["tanquecapacidade"],
                          "volume" => $row["tanquesaldo"],
                          "dataultimacompra" => $row["dataultimacompra"],
                          "datasaldo" => $row["datasaldo"]);
        $tanque['tanques'][] = $linha;
    }
} else {

    $tanque = 0;
}

//Passando vetor em forma de json
echo json_encode($tanque);
?>