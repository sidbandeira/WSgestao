<?php 

// Transformando arquivo XML em Objeto
$xml = simplexml_load_file('e:\modelos\vendas.xml');


// Exibe as informações do XML
echo 'Título: ' . $xml->titulo . '<br>';
echo 'Data de Atualização: ' . $xml->data_atualizacao . '<br>';

// Percorre todos os registros de vendas
foreach($xml->venda as $registro):
	echo 'Código da Venda: ' . $registro->cod_venda . '<br>';
	echo 'Cliente: ' . $registro->cliente . '<br>';
	echo 'Email: ' . $registro->email . '<br>';

        // Percorre todos os itens da venda
	foreach($registro->itens->item as $item):
		echo 'Código do Produto: ' . $item->cod_produto . '<br>';
		echo 'Quantidade: ' . $item->qtde . '<br>';
		echo 'Descrição do Produto: ' . $item->descricao . '<br>';
	endforeach;

	echo '<hr>';
endforeach;