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

//$email = htmlspecialchars($_GET["email"]);
//$data = da;
//$senha = htmlspecialchars($_GET["senha"]);

$sql = "SELECT * FROM usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
 // output data of each row
    $row = $result->fetch_assoc();
    $id = $row["idusuario"];  
    $nome = $row["emailusuario"];
    echo $id;
    echo$nome;
}

//$os = array();

//if ($result > 0) {
//    echo "Logou";
    // output data of each row
    //$sql1 = "SELECT * FROM os where idcliente=$id";
    //$result2 = $conn->query($sql1);
 
    //while($row = $result2->fetch_assoc()) {
    //    $linha = array("id"=>$row["id"], "dataos"=>$row["dataos"], "descricaoos"=>$row["descricaoos"], "defeito"=>$row["defeito"], "idcliente"=>$row["idcliente"], "idstatus"=>$row["idstatus"]);
    //    $os[] = $linha;        
    //}
//}
 else {
    echo "0 results";
}

//$lista = array("os"=>$os);

$conn->close();
//echo json_encode($lista, JSON_PRETTY_PRINT);
?>
