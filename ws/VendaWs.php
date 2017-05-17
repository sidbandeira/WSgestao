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
$codunidade = htmlspecialchars($_GET["codunidade"]);
$datavenda = htmlspecialchars($_GET["datavenda"]);

//Consultando banco de dados
$qryLista = mysqli_query($conn, "SELECT * FROM venda" 
    ." WHERE codunidade = $codunidade"
	." AND datavenda = '$datavenda'"
        . "ORDER BY nomevendedor");
if ($qryLista->num_rows > 0) {

    while ($row = $qryLista->fetch_assoc()) {
        $data = $row["datavenda"];
        $old_date = Date_create($data);
        $new_date = Date_format($old_date, "d/m/Y");
        
        $linha = array("datavenda" => $new_date, 
                        "totalvenda" => $row["totalvenda"],
                        "declaradovenda" => $row["declaradovenda"],
                        "horaatualizacao" => $row["horaatualizacao"],
                        "nomevendedor" => $row["nomevendedor"]
						);
        $venda['vendas'][] = $linha;
    }
} else {

    $venda = 0;
}

//Passando vetor em forma de json
echo json_encode($venda);
?>