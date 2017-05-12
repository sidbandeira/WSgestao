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
$qryLista = mysqli_query($conn, "SELECT * FROM produto" 
    ." INNER JOIN empresa USING(CodEmpresa)" 
    ." INNER JOIN produtofornecedor USING(idproduto)"
    ." INNER JOIN fornecedor USING(idfornecedor)"
    ." WHERE empresa.codempresa = $codEmpresa "
        . "ORDER BY idproduto");
if ($qryLista->num_rows > 0) {

    while ($row = $qryLista->fetch_assoc()) {
        $data = $row["produtodtultimacompra"];
        $old_date = Date_create($data);
        $new_date = Date_format($old_date, "d/m/Y");
        
        $linha = array("idproduto" => $row["idproduto"], 
                        "produtocodbarras" => $row["produtocodbarras"],
                        "produtodescricao" => $row["produtodescricao"],
                        "produtoprecovenda" => $row["produtoprecovenda"],
                        "produtoprecocusto" => $row["produtoprecocusto"],
                        "produtodtultimacompra" =>  $new_date,
                        "produtosaldo" => $row["produtosaldo"]
            );
        $produto['produtos'][] = $linha;
    }
} else {

    $produto = 0;
}

//Passando vetor em forma de json
echo json_encode($produto);
?>