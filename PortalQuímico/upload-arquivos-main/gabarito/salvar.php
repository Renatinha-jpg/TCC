<?php
session_start();
$_SESSION['mensagem'] = "";
$pasta = "/uploads";

$fazerUpload = true;

$nome = $_FILES['arquivo']['name'];
// "verificamos" a extensão do arquivo
$img = getimagesize($_FILES['arquivo']['tmp_name']);
//var_dump($_FILES);
//die;
if ($img != false) {
    if (
        $img[2] != IMAGETYPE_JPEG && $img[2] != IMAGETYPE_PNG
        && $img[2] != IMAGETYPE_JPEG2000 && $img[2] != IMAGETYPE_BMP
        && $img[2] != IMAGETYPE_GIF
    ) {
        $fazerUpload = false;
        $_SESSION['mensagem'] .= "Extensão inválida! " .
            "Selecione um arquivo de imagem.";
    }
} else {
    $fazerUpload = false;
    $_SESSION['mensagem'] .= "Arquivo inválido! " .
        "Selecione um arquivo de imagem.";
}

// tamanho máximo do arquivo
if ($_FILES['arquivo']['size'] > 3145728) {
    $fazerUpload = false;
    $_SESSION['mensagem'] .= "Tamanho do arquivo excedido! " .
        "Selecione um arquivo de tamanho menor.";
}

$nomeArquivo = bin2hex(random_bytes(20));
$explodido = explode("/", $img['mime']);
$ext = $explodido[1];
$nomeArquivoExtensao = $nomeArquivo . "." . $ext;
$pastaArquivoExtensao = $pasta . "/" . $nomeArquivoExtensao;

if (file_exists(__DIR__ . $pastaArquivoExtensao)) { // precisa ser caminho absoluto
    $fazerUpload = false;
    $_SESSION['mensagem'] .= "O arquivo já existe! " .
        "Tente novamente.";
}

if ($fazerUpload) {
    // fazer o upload
    $deuCerto = move_uploaded_file(
        $_FILES['arquivo']['tmp_name'],
        __DIR__ . $pastaArquivoExtensao
    );
    if ($deuCerto) {
        $conexao = mysqli_connect("localhost", "root", "", "upload");
        if (!isset($_POST['id_arquivo'])) { // novo arquivo
            $sql = "INSERT INTO arquivo (nome) VALUES ('$nomeArquivoExtensao')";
            $result = mysqli_query($conexao, $sql);
            if ($result) {
                $_SESSION['mensagem'] = "Upload realizado com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Problemas ao gravar no " .
                    "banco de dados. " . mysqli_errno($conexao) . ": " .
                    mysqli_error($conexao);
            }
        } else { // alterar um arquivo
            $idArquivo = $_POST['id_arquivo'];
            $sql3 = "SELECT * FROM arquivo WHERE id_arquivo = $idArquivo";
            $resultSet3 = mysqli_query($conexao, );
            // excluir o arquivo antigo
            // fazer o update no banco
        }
    }
}
header("Location: index.php");
