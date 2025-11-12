<?php
session_start();

// Carrega (ou cria) o "banco de dados" da sessão
if(!isset($_SESSION['usuarios'])){
    $_SESSION['usuarios'] = [
        ['usuario' => 'admin', 'senha' => '111', 'perfil' => 'admin'],
        ['usuario' => 'dentista', 'senha' => '222', 'perfil' => 'dentista'],
        ['usuario' => 'recep', 'senha' => '333', 'perfil' => 'recepcionista']
    ];
}

// Captura os dados do formulário
$usuario = $_POST['usuario'] ?? '';
$senha   = $_POST['senha'] ?? '';

$login_valido = false;
$perfil = '';

// Verifica login e senha
foreach($_SESSION['usuarios'] as $u){
    if($u['usuario'] === $usuario && $u['senha'] === $senha){
        $login_valido = true;
        $perfil = $u['perfil'];
        break;
    }
}

// Se o login for válido, define o perfil e redireciona
if($login_valido){
    $_SESSION['usuario'] = $usuario;
    $_SESSION['perfil']  = $perfil;

    switch($perfil){
        case 'admin':
            header("Location: admin.php");
            break;
        case 'dentista':
            header("Location: dentista.php");
            break;
        case 'recepcionista':
            header("Location: recepcao.php");
            break;
    }
    exit;
}

// Se o login for inválido, volta para o login com aviso
echo "
    <script>
        alert('Usuário ou senha incorretos!');
        window.location.href = 'login.html';
    </script>
";
exit;
?>