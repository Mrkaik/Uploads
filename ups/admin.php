<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['delete'])) {
    $file = $_GET['delete'];
    $file_path = 'uploads/' . $file;
    if (file_exists($file_path)) {
        unlink($file_path);
        echo "Arquivo excluído com sucesso.";
    } else {
        echo "Arquivo não encontrado.";
    }
}
header('Location: index.php');
?>
