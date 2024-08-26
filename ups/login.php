<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
        exit();
    } else {
        $error = 'Usuário ou senha incorretos';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel='stylesheet' type='text/css' media='screen' href='./lo.css'>   
</head>
<body>
    <form method="post" class="form">
        <div class="control block-cube block-input">
            <input type="text" id="username" name="username" required placeholder="Usuário">
            <div class="bg-top">
                <div class="bg-inner"></div>
            </div>
            <div class="bg-right">
                <div class="bg-inner"></div>
            </div>
            <div class="bg">
                <div class="bg-inner"></div>
            </div>
        </div>
        <div class="control block-cube block-input">
            <input type="password" id="password" name="password" required placeholder="Senha">
            <div class="bg-top">
                <div class="bg-inner"></div>
            </div>
            <div class="bg-right">
                <div class="bg-inner"></div>
            </div>
            <div class="bg">
                <div class="bg-inner"></div>
            </div>
        </div>
        <button type="submit" class="btn block-cube block-cube-hover">
            <div class="bg-top">
                <div class="bg-inner"></div>
            </div>
            <div class="bg-right">
                <div class="bg-inner"></div>
            </div>
            <div class="bg">
                <div class="bg-inner"></div>
            </div>
            <div class="text">Entrar</div>
        </button>
    </form>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?> 
</body>
</html>


