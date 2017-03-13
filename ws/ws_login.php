<?php
header("Content-type: application/json; charset=utf-8");

$servername = "mysql.hostinger.com.br";
$username = "u655756784_sid";
$password = "021082";
$dbname = "u655756784_temp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email = htmlspecialchars($_GET["email"]);
$senha = htmlspecialchars($_GET["senha"]);

$sql = "SELECT * FROM usuario WHERE emailusuario = '$email' and senhausuario = '$senha'";
$result = $conn->query($sql);

$usuario = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $linha = array("idusuario"=>(int)$row["idusuario"], "email"=>$row["emailusuario"], "senha"=>$row["senhausuario"],
                    "empresa"=>$row["codempresa"]);
        $ocorrencia[] = $linha; 
    }
}else{
    $linha = array("id"=>0, "email"=>"Não achou registro", "senha"=>"","empresa"=>"");
    $ocorrencia[] = $linha;        
}

$lista = array("usuario"=>$ocorrencia);

$conn->close();
echo json_encode($lista, JSON_PRETTY_PRINT);


//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "dbos";

//$idos = htmlspecialchars($_GET["idos"]);
//$idcliente = htmlspecialchars($_GET["idcliente"]);
//
//$sql = "SELECT ocorrencia.id, ocorrencia.data, ocorrencia.descricao, ocorrencia.resposta, os.idstatus, "
//        . "os.idcliente "
//        . "from ocorrencia inner join os on ocorrencia.idos = os.id "
//        . "where idos=$idos and idcliente=$idcliente and idstatus=1";
//
//$result = $conn->query($sql);
//
//$ocorrencia = array();
//
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        $linha = array("id"=>$row["id"], "data"=>"Data: ".$row["data"], "descricao"=>utf8_encode("Status: " . $row["descricao"]),  "resposta"=>utf8_encode("Resposta: ".$row["resposta"]), "idstatus"=>$row["idstatus"], "idcliente"=>$row["idcliente"]);
//        $ocorrencia[] = $linha;        
//    }
//} else {
//    $linha = array("id"=>0, "data"=>"", "descricao"=>utf8_encode("OS Incorreta ou fechada no sistema"),  "resposta"=>"", "idstatus"=>"", "idcliente"=>"");    
//    $ocorrencia[] = $linha;        
//}
//
//$lista = array("ocorrencia"=>$ocorrencia);
//
//$conn->close();
//echo json_encode($lista, JSON_PRETTY_PRINT);
?>
