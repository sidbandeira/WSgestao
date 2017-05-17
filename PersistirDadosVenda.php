<!DOCTYPE HTML>
<html>
    <body>
        <h2>Arquivo importado com sucesso!</h2>
        <a href="index.php"> Voltar</a>
    </body>
</html>

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
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    $dataRet = array("wsId" => 0,
        "wsMsg" => utf8_encode("Erro de Acesso ao Banco de Dados"));
    echo json_encode($dataRet);
    return;
}
$_FILES['arquivo']['name'];

$xml = simplexml_load_file($_FILES['arquivo']['tmp_name']);

/* Percorre o objeto e imprime na tela as informações de cada venda */
foreach ($xml as $venda) {
    $datavenda = (string) $venda->datavenda;
    $totalvenda = (float) $venda->totalvenda;
    $declaradovenda = (float) $venda->totalvendadeclarado;
    $horaatualizacao = (String) $venda->horaatualizacao;
    $nomevendedor = (String) $venda->nomevendedor;
    $codintegracao = (int) $venda->codintegracao;
    $tiporegistro = (int) $venda->tiporegistro;

    $qryLista = mysqli_query($conn,"SELECT codunidade FROM unidadenegocio"
            . " WHERE codintegracao = $codintegracao");

    if ($qryLista->num_rows > 0) {
        while ($row = $qryLista->fetch_assoc()) {
            $codunidade = $row[codunidade];
        }
    }   
    
    if ($tiporegistro == 0) {
        if ($codunidade > 0) {
            $sql = "INSERT INTO venda (datavenda,totalvenda, declaradovenda, horaatualizacao,"
                    . "nomevendedor,codunidade)"
                    . "VALUES ('$datavenda',$totalvenda, $declaradovenda, '$horaatualizacao', '$nomevendedor',"
                    . " $codunidade)";
        }
    } else {
        $sql = "UPDATE venda SET datavenda = '$datavenda', totalvenda = $totalvenda, declaradovenda = $declaradovenda, horaatualizacao = '$horaatualizacao',"
                . " nomevendedor = '$nomevendedor'"
                . " WHERE codunidade =  $codunidade";
    }
    $conn->query($sql);
}

$conn->close();



