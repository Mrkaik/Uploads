<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "uploads/"; // Nota: Adicione a barra no final
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
    // Verifica se o arquivo é um tipo permitido
    $allowed_types = ['jpg', 'png', 'pdf', 'docx'];
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, $allowed_types)) {
        echo "Desculpe, apenas arquivos JPG, PNG, PDF e DOCX são permitidos.";
        exit();
    }

    // Verifica se o arquivo já existe
    if (file_exists($target_file)) {
        echo "Desculpe, o arquivo já existe.";
        exit();
    }

    // Tenta mover o arquivo para o diretório de uploads
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "O arquivo ". htmlspecialchars(basename($_FILES["file"]["name"])) . " foi enviado com sucesso.";
    } else {
        echo "Desculpe, ocorreu um erro ao enviar seu arquivo.";
    }
} else {
    echo "Nenhum arquivo enviado ou ocorreu um erro no envio.";
}

header('Location: index.php');
