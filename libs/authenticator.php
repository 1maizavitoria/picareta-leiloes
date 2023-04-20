<?php
    session_start();

    function autenticar($tipoUsuarioTela) {
        $tipoUsuario = $_SESSION['tipoUsuario'];
        $loginId = $_SESSION['loginId'];
        if (!isset($loginId) || $loginId == null || $tipoUsuario !== $tipoUsuarioTela) {
            header('Location: ./../../pages/login/login.php');
            exit;
        } else {
            if ($tipoUsuario == 1) {
                header('Location: ./../../pages/dadosCadastrais/dadosCadastrais.php');
            } else {
                header('Location: ./../../pages/cadastroMarca/cadastroMarca.php');
            }
        }
    }
?>