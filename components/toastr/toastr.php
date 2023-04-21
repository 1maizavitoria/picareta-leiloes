<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../components/toastr/toastr.scss">
    <script src="./../../components/toastr/toastr.js"></script>
    <title>Toastr</title>
</head>
<body>
    <?php
    function toastr($type, $message) {
        echo '<div id="toastr" onclick="removerToastr()" class="col-4 col-lg-2 show toastr '.$type.'">'
        .$message.
        '</div>';
        echo '<script>removerToastrAutomaticamente();</script>';
    }
    ?>
</body>
</html>