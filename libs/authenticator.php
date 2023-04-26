<?php
    
    function autenticar($tipoUsuarioTela) {
        if (!isset($_SESSION['tipoUsuario']) ||  !isset($_SESSION['loginId'])) {
            header('Location: ./../../pages/login/login.php');
            exit;
        } else {
            $tipoUsuario = $_SESSION['tipoUsuario'];
        $loginId = $_SESSION['loginId'];
            if ($tipoUsuario == 1 && $tipoUsuario != $tipoUsuarioTela) {
                header('Location: ./../../pages/dadosCadastrais/dadosCadastrais.php');
            } elseif ($tipoUsuario == 2 && $tipoUsuario != $tipoUsuarioTela) {
                header('Location: ./../../pages/cadastroMarca/cadastroMarca.php');
            }
        }
    }
?>