<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dadosCadastrais.scss">
    <script type="module" src="./dadosCadastrais.js"></script>
    <title>Dados Cadastrais</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $loginId = $_SESSION['loginId'];

        $dadosPessoa = executeQuery("SELECT * FROM pessoa WHERE loginId = '$loginId'");
        $name = $_POST['nome'];
        $imagemBlob = null;
        
        if (isset($_FILES['foto']) && strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION) != null)) {

            $tipoImagem = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['foto']['tmp_name'];
                $imagemBlob = addslashes(file_get_contents($imagemTemp));
            }
        }

        $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
        $rg = preg_replace('/[^0-9]/', '', $_POST['rg']);
        $telefone = preg_replace('/[^0-9]/', '', $_POST['telefone']);
        $dataNascimento = $_POST['dataNascimento'];
        $estadoCivil = $_POST['estadoCivil'];
        $sexo = $_POST['sexo'];

        $dadosEndereco = executeQuery("SELECT * FROM endereco WHERE loginId = '$loginId'");
        $logradouro = $_POST['logradouro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $numeroResidencia = $_POST['numeroResidencia'];
        $complemento = $_POST['complemento'];
        $cep = preg_replace('/[^0-9]/', '', $_POST['cep']);

        $dadosLogin = executeQuery("SELECT email FROM login WHERE loginId = '$loginId'");
        $email = $_POST['email'];
        $_SESSION['email'] = $email;

        if (mysqli_num_rows($dadosPessoa) == 0) {
            executeQuery("INSERT INTO pessoa (loginId, nome, foto, cpf, rg, telefone, dataNascimento, estadoCivil, sexo) VALUES ('$loginId', '$name', '$imagemBlob', '$cpf', '$rg', '$telefone', '$dataNascimento', '$estadoCivil', '$sexo')");
        } else {
            if ($imagemBlob != null)
                executeQuery("UPDATE  pessoa SET nome = '$name', foto = '$imagemBlob', cpf = '$cpf', rg = '$rg', telefone = '$telefone', dataNascimento = '$dataNascimento', estadoCivil = '$estadoCivil', sexo = '$sexo' WHERE loginId = '$loginId'");
            else 
                executeQuery("UPDATE  pessoa SET nome = '$name', cpf = '$cpf', rg = '$rg', telefone = '$telefone', dataNascimento = '$dataNascimento', estadoCivil = '$estadoCivil', sexo = '$sexo' WHERE loginId = '$loginId'");

        }

        if (mysqli_num_rows($dadosEndereco) == 0) {
            executeQuery("INSERT INTO endereco (loginId, logradouro, cidade, uf, numeroResidencia, complemento, cep) VALUES ('$loginId', '$logradouro', '$cidade', '$uf', '$numeroResidencia', '$complemento', '$cep')");
        } else {
            executeQuery("UPDATE endereco SET logradouro = '$logradouro', cidade = '$cidade', uf = '$uf', numeroResidencia = '$numeroResidencia', complemento = '$complemento', cep = '$cep' WHERE loginId = '$loginId'");
        }

        if (mysqli_num_rows($dadosLogin) == 1) {
            executeQuery("UPDATE login SET email = '$email' WHERE loginId = '$loginId'");
        }
    }
    ?>
    
    <div class="content">

        <div class="left">
            <?php
            include './../../components/sidebar/sidebar.php';
            ?>
        </div>

        <div class="right">

            <div class="d-flex justify-content-center my-5">
                <h2>Dados Cadastrais</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST" enctype="multipart/form-data">

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="text" id="name" name="nome" class="form-control" placeholder="Nome completo*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-name">Informe um nome válido.<br> <em>Ex: Tyler Durden</em></div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-email">Informe um e-mail válido.<br> <em>Ex: nome@dominio.com</em></div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" id="userImage" accept="image/*">
                            <label class="custom-file-label" for="userImage">Foto de perfil</label>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="text" id="cpf" name="cpf" maxLength="14" class="form-control" placeholder="CPF*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-cpf">Informe um CPF válido.<br> <em>Ex: 123.456.789-00</em></div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="text" id="rg" name="rg" maxLength=12 class="form-control" placeholder="RG*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-rg">Informe um RG válido.<br> <em>Ex: 12.345.678-9</em></div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <input type="tel" maxLength="15" name="telefone" id="phone" class="form-control" placeholder="Celular*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-phone">Informe um celular válido.<br> <em>Ex: (00) 90000-0000</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="date" id="birthDate" name="dataNascimento" class="form-control" placeholder="Data de nascimento*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-birthDate">Informe uma data de nascimento válida.<br> <em>Ex: 01/01/2000</em></div>
                    </div>
                    <div class="col-5 col-lg-3">
                        <select class="form-select" id="maritalStatus" name="estadoCivil" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Estado civil*</option>
                            <option value="1">Solteiro</option>
                            <option value="2">Casado</option>
                            <option value="3">Separado</option>
                            <option value="4">Divorciado</option>
                            <option value="5">Viúvo</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-maritalStatus">Informe um estado civil válido.</div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select" id="gender" name="sexo" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Sexo*</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-gender">Informe um sexo válido.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="text" id="address" name="logradouro" class="form-control" placeholder="Logradouro*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-address">Informe um logradouro válido.<br> <em>Ex: Rua São Francisco de Sales</em></div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="text" id="city" name="cidade" class="form-control" placeholder="Cidade*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-city">Informe uma cidade válida.<br> <em>Ex: Curitiba</em></div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <select class="form-select" name="uf" id="state" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Estado*</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federel</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goías</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-state">Informe uma sigla de Estado válida</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="text" id="houseNumber" name="numeroResidencia" class="form-control" placeholder="Número da residência*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-houseNumber">Informe uma número de residência válido.<br> <em>Ex: 338</em></div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="text" id="complement" name="complemento" class="form-control" placeholder="Complemento" onblur="validateInput(this)">
                        <div class="invalid-feedback" id="invalid-message-complement">Informe um complemento válido.<br> <em>Ex: Sobrado 20</em></div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <input type="tel" id="cep" maxLength="9" name="cep" class="form-control" placeholder="CEP*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-cep">Informe um CEP válido.<br> <em>Ex: 81720-290</em></div>
                    </div>
                </div>        

                <div class="col-6 col-lg-3 mx-auto d-flex justify-content-center">
                    <button type="submit" value="salvar" class="btn btn-outline-success col-6" onclick="checkAllFields('form')">Salvar</button>
                </div>

            </form>

        </div>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>

    <?php
    include './../../libs/authenticator.php';
    autenticar(1);

    $loginId = $_SESSION['loginId'];

    $dadosPessoa = executeQuery("SELECT * FROM pessoa WHERE loginId = '$loginId'");
    $dadosEndereco = executeQuery("SELECT * FROM endereco WHERE loginId = '$loginId'");
    $dadosLogin = executeQuery("SELECT email FROM login WHERE loginId = '$loginId'");

    if (mysqli_num_rows($dadosPessoa) == 1) {
        $dadosPessoa = mysqli_fetch_assoc($dadosPessoa);

        $cpfFormatado = substr($dadosPessoa['cpf'], 0, 3) . '.' . substr($dadosPessoa['cpf'], 3, 3) . '.' . substr($dadosPessoa['cpf'], 6, 3) . '-' . substr($dadosPessoa['cpf'], 9, 2);
        $rgFormatado = substr($dadosPessoa['rg'], 0, 2) . '.' . substr($dadosPessoa['rg'], 2, 3) . '.' . substr($dadosPessoa['rg'], 5, 3) . '-' . substr($dadosPessoa['rg'], 8, 1);
        $celularFormatado = '(' . substr($dadosPessoa['telefone'], 0, 2) . ') ' . substr($dadosPessoa['telefone'], 2, 5) . '-' . substr($dadosPessoa['telefone'], 7, 4);

        echo "
        <script>
            document.getElementsByName('nome')[0].value = '" . $dadosPessoa['nome'] . "';
            document.getElementsByName('cpf')[0].value = '" . $cpfFormatado . "';
            document.getElementsByName('rg')[0].value = '" . $rgFormatado . "';
            document.getElementsByName('dataNascimento')[0].value = '" . $dadosPessoa['dataNascimento'] . "';
            document.getElementsByName('telefone')[0].value = '" . $celularFormatado . "';
            document.getElementsByName('estadoCivil')[0].value = '" . $dadosPessoa['estadoCivil'] . "';
            document.getElementsByName('sexo')[0].value = '" . $dadosPessoa['sexo'] . "';
            document.currentScript.remove();
        </script>
        ";
    }

    if (mysqli_num_rows($dadosLogin) == 1) {
        $dadosLogin = mysqli_fetch_assoc($dadosLogin);
        echo "
        <script>
            document.getElementsByName('email')[0].value = '" . $dadosLogin['email'] . "';
            document.currentScript.remove();
        </script>
        ";
    }

    if (mysqli_num_rows($dadosEndereco) == 1) {
        $dadosEndereco = mysqli_fetch_assoc($dadosEndereco);

        $cepFormatado = substr($dadosEndereco['cep'], 0, 5) . '-' . substr($dadosEndereco['cep'], 5, 3);

        echo "
        <script>
            document.getElementsByName('cep')[0].value = '" . $cepFormatado . "';
            document.getElementsByName('cidade')[0].value = '" . $dadosEndereco['cidade'] . "';
            document.getElementsByName('complemento')[0].value = '" . $dadosEndereco['complemento'] . "';
            document.getElementsByName('logradouro')[0].value = '" . $dadosEndereco['logradouro'] . "';
            document.getElementsByName('numeroResidencia')[0].value = '" . $dadosEndereco['numeroResidencia'] . "';
            document.getElementsByName('uf')[0].value = '" . $dadosEndereco['uf'] . "';
            document.currentScript.remove();
        </script>
        ";
    }
    ?>
    
</body>
</html>
