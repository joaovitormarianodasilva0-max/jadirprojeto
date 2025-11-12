<?php
session_start();

if(!isset($_SESSION['clientes'])) $_SESSION['clientes'] = [];
if(!isset($_SESSION['consultas'])) $_SESSION['consultas'] = [];
if(!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [
        ['usuario' => 'admin', 'senha' => '111', 'perfil' => 'admin'],
        ['usuario' => 'dentista', 'senha' => '222', 'perfil' => 'dentista'],
        ['usuario' => 'recep', 'senha' => '333', 'perfil' => 'recepcionista']
    ];
}

?>