<?php
    session_start();

    function autenticar($tipoUsuarioTela) {
        $tipoUsuario = $_SESSION['tipoUsuario'];
        $loginId = $_SESSION['loginId'];
        if ($tipoUsuario == null ||  $loginId == null) {
            header('Location: ./../../pages/login/login.php');
            exit;
        } else {
            if ($tipoUsuario == 1 && $tipoUsuario != $tipoUsuarioTela) {
                header('Location: ./../../pages/dadosCadastrais/dadosCadastrais.php');
            } elseif ($tipoUsuario == 2 && $tipoUsuario != $tipoUsuarioTela) {
                header('Location: ./../../pages/cadastroMarca/cadastroMarca.php');
            }
        }
    }
?>