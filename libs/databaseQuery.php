<?php
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "picaretaleiloes";
        $conexao = new mysqli($servername, $username, $password, $dbname);

        function executeQuery($sql){
            global $conexao;
            $result = $conexao->query($sql);
            return $result;
        }
    } catch (mysqli_sql_exception $e) {
        echo "<div class='alert alert-danger' role='alert'>Erro ao conectar ao banco de dados: " . $e->getMessage() . "</div>";
    }
?>