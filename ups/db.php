<?php
$host = 'localhost';
$dbname = 'file_sharing';
$user = 'root'; // ou o usuário do seu banco de dados
$pass = 'Rp753159'; // ou a senha do seu banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexão falhou: ' . $e->getMessage();
}
?>
