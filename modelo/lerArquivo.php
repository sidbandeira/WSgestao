<?php
$_UP['extensoes'] = array('xml');


//if ($_FILES['arquivo']['error'] != 0) {
//  die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
//  exit; // Para a execução do script
//}
//
//$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
//if (array_search($extensao, $_UP['extensoes']) === false) {
//  echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
//  exit;
//}

$_FILES['arquivo']['name'];

//$xml = simplexml_load_file('E:\Modelos\lista_contatos.xml'); /* Lê o arquivo XML e recebe um objeto com as informações */

$xml = simplexml_load_file($_FILES['arquivo']['tmp_name']);
 
/* Percorre o objeto e imprime na tela as informações de cada contato */
foreach ($xml as $contato){
    $a = "Id: " . $contato->idcontato . "<br>";
    $a .= "Nome: " . $contato->nome . "<br>";
    $a .= "Email: " . $contato->email. "<br><br>";
    echo $a;
}
