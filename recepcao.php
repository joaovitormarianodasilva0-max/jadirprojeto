<?php
session_start();

// Garante que apenas recepcionistas entrem
if(!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'recepcionista'){
    header("Location: login.html");
    exit;
}

// Garante que as variáveis de "banco" existam
if(!isset($_SESSION['clientes']))  $_SESSION['clientes']  = [];
if(!isset($_SESSION['consultas'])) $_SESSION['consultas'] = [];

// 🧾 Cadastro de cliente
if(isset($_POST['acao']) && $_POST['acao'] === 'cadastrar_cliente'){
    $novo = [
        'nome' => $_POST['nome'],
        'telefone' => $_POST['telefone']
    ];
    $_SESSION['clientes'][] = $novo;
}

// Agendar consulta
if(isset($_POST['acao']) && $_POST['acao'] === 'agendar_consulta'){
    $consulta = [
        'cliente'  => $_POST['cliente'],
        'data'     => $_POST['data'],
        'hora'     => $_POST['hora'],
        'dentista' => $_POST['dentista'],
        'status'   => 'Pendente'
    ];
    $_SESSION['consultas'][] = $consulta;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Recepção - Clínica Odontológica</title>
<style>
    body{font-family:Arial;background:#fff3e0;padding:20px;}
    form{background:white;padding:15px;border-radius:10px;margin-bottom:20px;}
    table{width:100%;border-collapse:collapse;margin-top:10px;}
    th,td{border:1px solid #ccc;padding:8px;text-align:left;}
    th{background:#ff9800;color:white;}
    h2{color:#ff9800;}
    a{background:#ff9800;color:white;padding:8px 15px;text-decoration:none;border-radius:6px;}
</style>
</head>
<body>
<h2>Bem-vinda, Recepcionista</h2>

<form method="post">
    <h3>Cadastrar Cliente</h3>
    <input type="hidden" name="acao" value="cadastrar_cliente">
    Nome: <input type="text" name="nome" required>
    Telefone: <input type="text" name="telefone" required>
    <input type="submit" value="Cadastrar">
</form>

<form method="post">
    <h3>Agendar Consulta</h3>
    <input type="hidden" name="acao" value="agendar_consulta">
    Cliente:
    <select name="cliente" required>
        <?php foreach($_SESSION['clientes'] as $c): ?>
            <option value="<?= $c['nome'] ?>"><?= $c['nome'] ?></option>
        <?php endforeach; ?>
    </select>
    Data: <input type="date" name="data" required>
    Hora: <input type="time" name="hora" required>
    Dentista: <input type="text" name="dentista" required>
    <input type="submit" value="Agendar">
</form>

<h3>Clientes Cadastrados</h3>
<table>
    <tr><th>Nome</th><th>Telefone</th></tr>
    <?php foreach($_SESSION['clientes'] as $c): ?>
        <tr><td><?= $c['nome'] ?></td><td><?= $c['telefone'] ?></td></tr>
    <?php endforeach; ?>
</table>

<h3>Consultas Agendadas</h3>
<table>
    <tr><th>Cliente</th><th>Data</th><th>Hora</th><th>Dentista</th><th>Status</th></tr>
    <?php foreach($_SESSION['consultas'] as $con): ?>
        <tr>
            <td><?= $con['cliente'] ?></td>
            <td><?= $con['data'] ?></td>
            <td><?= $con['hora'] ?></td>
            <td><?= $con['dentista'] ?></td>
            <td><?= $con['status'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<br><a href="logout.php">Sair</a>
</body>
</html>