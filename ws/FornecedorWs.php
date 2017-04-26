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
$codEmpresa = htmlspecialchars($_GET["codempresa"]);

//Consultando banco de dados
$qryLista = mysqli_query($conn, "SELECT idfornecedor, fornecedorrazaosocial"
        . " FROM fornecedor "
        . " WHERE codempresa = $codEmpresa");
if ($qryLista->num_rows > 0) {

    while ($row = $qryLista->fetch_assoc()) {
        
        $linha = array("id" => $row["idfornecedor"], 
                          "razaosocial" => $row["fornecedorrazaosocial"]);
        $fornecedor['fornecedores'][] = $linha;
    }
} else {

    $fornecedor = 0;
}

//Passando vetor em forma de json
echo json_encode($fornecedor);
?>