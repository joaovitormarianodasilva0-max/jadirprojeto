<?php
session_start();
if(!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin'){
    header("Location: login.html");
    exit;
}
if(isset($_POST['criar'])){
    $novo = [
        'usuario' => $_POST['usuario'],
        'senha' => $_POST['senha'],
        'perfil' => $_POST['perfil']
    ];
    $_SESSION['usuarios'][] = $novo;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Admin - Clínica Odontológica</title>
<style>
    body{font-family:Arial;background:#e8f5e9;padding:20px;}
    form{background:white;padding:15px;border-radius:10px;}
    table{width:100%;border-collapse:collapse;margin-top:10px;}
    th,td{border:1px solid #ccc;padding:8px;}
    th{background:#2e8b57;color:white;}
    a{background:#2e8b57;color:white;padding:8px 15px;text-decoration:none;border-radius:6px;}
</style>
</head>
<body>
<h2>Bem-vindo, Administrador</h2>

<form method="post">
    <h3>Criar Novo Usuário</h3>
    Usuário: <input type="text" name="usuario" required>
    Senha: <input type="text" name="senha" required>
    Perfil:
    <select name="perfil">
        <option value="admin">Admin</option>
        <option value="dentista">Dentista</option>
        <option value="recepcionista">Recepcionista</option>
    </select>
    <input type="submit" name="criar" value="Criar">
</form>

<h3>Usuários Existentes</h3>
<table>
    <tr><th>Usuário</th><th>Perfil</th></tr>
    <?php foreach($_SESSION['usuarios'] as $u): ?>
        <tr><td><?= $u['usuario'] ?></td><td><?= $u['perfil'] ?></td></tr>
    <?php endforeach; ?>
</table>

<br><a href="logout.php">Sair</a>
</body>
</html>