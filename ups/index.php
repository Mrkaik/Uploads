<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Área de Arquivos</title>
</head>
<body>
    <h1>Área de Arquivos</h1>
    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?>!</p>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <h2>Upload de Arquivo</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">Enviar</button>
        </form>
    <?php endif; ?>
    <h2>Arquivos Disponíveis</h2>
    <ul>
        <?php
        $files = array_diff(scandir('uploads/'), array('.', '..'));
        foreach ($files as $file) {
            echo "<li><a href='uploads/$file' download>$file</a>";
            if ($_SESSION['role'] === 'admin') {
                echo " <a href='admin.php?delete=$file'>Excluir</a>";
            }
            echo "</li>";
        }
        ?>
    </ul>
    <a href="logout.php">Sair</a>
</body>
</html>
