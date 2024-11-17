<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados</title>
    <link rel="stylesheet" href="estilo.css" type="text/css">
    <link rel="stylesheet" href="estilo2.css" type="text/css">
</head>
<body>

<?php 
    include("topo.php")
?>

<?php
// Variáveis criadas para armazenar dados pelo formulário
$nome = ($_POST['nome']);
$email = ($_POST['email']);
$cidade = ($_POST['cidade']);
$estado = ($_POST['estado']);
$mensagem = ($_POST['mensagem']);

// Escrevendo as variáveis criadas com o conteúdo recebido pelo formulário
echo "Nome: " . $nome . "<br>";
echo "E-mail: " . $email . "<br>";
echo "Cidade: " . $cidade . "<br>";
echo "Estado: " . $estado . "<br>";
echo "Mensagem: " . $mensagem . "<br>";

// Criando vetor no PHP para armazenar
$contato = array("Nome" => $nome, "E-mail" => $email, "Cidade" => $cidade, "Estado" => $estado, "Mensagem" => $mensagem);

// Escrevendo o vetor PHP criado com todas as variáveis
echo "<hr> Vetor criado: <br>";
print_r($contato);

// Verificar se o arquivo dados.json já existe
if (file_exists("dados.json")) {
    $string = file_get_contents("dados.json");
    $json = json_decode($string, true);
} else {
    $json = array(); // Inicializa um vetor vazio
}

// Adicionando no vetor $json o vetor $contato
if (!isset($json["contato"])) {
    $json["contato"] = array();
}
$json["contato"][] = $contato;

// Abre o arquivo dados.json em modo de escrita
$fp = fopen('dados.json', 'w');
if ($fp === false) {
    die("Erro ao abrir o arquivo.");
}

// Escreve no arquivo em formato JSON
fwrite($fp, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
fclose($fp);
?>

        </main>
    
</body>
</html>