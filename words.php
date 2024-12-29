<?php
function gerarFrase($tamanhoMaximo = 280) {
    $frase = "";
    $tamanhoAtual = 0;

    while ($tamanhoAtual < $tamanhoMaximo) {
        // Atualize para o endpoint correto
        $apiUrl = "https://api.dicionario-aberto.net/random";
        
        $response = @file_get_contents($apiUrl);
        if ($response === false) {
            echo "Erro ao consultar a API.";
            break;
        }

        $palavra = json_decode($response, true)['word'] ?? ''; // Ajuste conforme a resposta da API
        if (!$palavra) {
            echo "Nenhuma palavra encontrada.";
            break;
        }

        if ($tamanhoAtual + strlen($palavra) + 1 > $tamanhoMaximo) {
            break;
        }

        $frase .= (empty($frase) ? "" : " ") . $palavra;
        $tamanhoAtual += strlen($palavra) + 1;
    }

    return $frase;
}

echo gerarFrase();
?>
