<?php
session_start();

// Verifica se é um dentista logado
if(!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'dentista'){
    header("Location: login.html");
    exit;
}

// Garante que as consultas existam
if(!isset($_SESSION['consultas'])) {
    $_SESSION['consultas'] = [];
}

// Marcar consulta como realizada
if(isset($_POST['marcar']) && isset($_POST['index'])){
    $_SESSION['consultas'][$_POST['index']]['status'] = "Realizada";
}

// Filtro de pesquisa
$filtro = $_GET['busca'] ?? '';
$consultas_filtradas = [];

if($filtro === ''){
    $consultas_filtradas = $_SESSION['consultas'];
} else {
    foreach($_SESSION['consultas'] as $i => $c){
        if(stripos($c['cliente'], $filtro) !== false || stripos($c['data'], $filtro) !== false){
            $consultas_filtradas[$i] = $c;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Painel do Dentista</title>
<style>
    body{font-family:Arial;background:#e0f7fa;padding:20px;}
    table{width:100%;border-collapse:collapse;margin-top:10px;}
    th,td{border:1px solid #ccc;padding:8px;text-align:left;}
    th{background:#00796b;color:white;}
    h2{color:#004d40;}
    a, button{background:#00796b;color:white;padding:6px 12px;text-decoration:none;border:none;border-radius:6px;cursor:pointer;}
    a:hover, button:hover{background:#004d40;}
    form.busca{margin-bottom:15px;}
    input[type="text"]{padding:6px;border:1px solid #aaa;border-radius:5px;width:250px;}
</style>
</head>
<body>
<h2>Bem-vindo, Dentista</h2>

<form method="get" class="busca">
    🔍 Buscar consulta: 
    <input type="text" name="busca" value="<?= htmlspecialchars($filtro) ?>" placeholder="Digite nome ou data (AAAA-MM-DD)">
    <input type="submit" value="Filtrar">
    <a href="dentista.php">Limpar</a>
</form>

<form method="post">
<table>
    <tr><th>Cliente</th><th>Data</th><th>Hora</th><th>Dentista</th><th>Status</th><th>Ação</th></tr>
    <?php if(count($consultas_filtradas) > 0): ?>
        <?php foreach($consultas_filtradas as $i=>$con): ?>
            <tr>
                <td><?= $con['cliente'] ?></td>
                <td><?= $con['data'] ?></td>
                <td><?= $con['hora'] ?></td>
                <td><?= $con['dentista'] ?></td>
                <td><?= $con['status'] ?></td>
                <td>
                    <?php if($con['status'] === 'Pendente'): ?>
                        <button name="marcar" value="1">Marcar Realizada</button>
                        <input type="hidden" name="index" value="<?= $i ?>">
                    <?php else: ?>
                        ✅
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6">Nenhuma consulta encontrada.</td></tr>
    <?php endif; ?>
</table>
</form>

<br><a href="logout.php">Sair</a>
</body>
</html>