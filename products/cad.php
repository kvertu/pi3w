<?php

require_once("partitions/base.php");
require_once("classes/LoginCli.php");

if (isset($_POST['info'])) {
    $l = new LoginCli();
    $l->setInfo($_POST['info']);
    $l->signUp();
    header("location: index.php");
}

?>

<!-- CSS exclusivo dessa tela -->
<link rel="stylesheet" href="../css/login.css">

<!-- JS para cadastro -->
<script src="js/cad.js"></script>

<body style="overflow-y: hidden; overflow-x: hidden;" class="bg-verdeclaro">
    <div class="container-flex">
        <div class="col-6" id="biglogo"></div>
        <div id="conteudo" class="col-6 justify-content-right">
            <form action="cad.php" method="post" class="vstack">
                <p class="verdescuro font-24 form login"><strong>Criar sua conta</strong></p>
                <!-- Info sobre o cliente -->
                <div class="align-items-center form row login">
                    <label for="cnpj" class="col-form-label col-md-4 col-lg-3 text-end">CNPJ:</label>
                    <div class="col-sm-8">
                        <input placeholder="55178364000158" name="info[cnpj]" onkeyup="cadCnpj()" id="cnpj" required class="form-control" type="text">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="nome" class="col-form-label col-md-4 col-lg-3 text-end">Nome:</label>
                    <div class="col-sm-8">
                        <input placeholder="Nome de exemplo" name="info[nome]" id="nome" required class="form-control" type="text">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="cep" class="col-form-label col-md-4 col-lg-3 text-end">CEP:</label>
                    <div class="col-sm-8">
                        <input placeholder="59122601" name="info[cep]" onkeyup="cadCep()" required class="form-control" id="cep" type="text">
                    </div>
                </div>

                <!-- Será preenchido automáticamente (exceto o número) -->
                <div class="align-items-center form row login">
                    <label for="logra" class="col-form-label col-md-4 col-lg-3 text-end">Logradouro:</label>
                    <div class="col-sm-8">
                        <input disabled placeholder="Travessa São Francisco" name="info[rua]" id="logra" required class="form-control" readonly type="text">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="bairro" class="col-form-label col-md-4 col-lg-3 text-end">Bairro:</label>
                    <div class="col-sm-8">
                        <input disabled placeholder="Redinha" name="info[bairro]" id="bairro" required class="form-control" readonly type="text">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="cidade" class="col-form-label col-md-4 col-lg-3 text-end">Cidade:</label>
                    <div class="col-sm-8">
                        <input disabled placeholder="Natal" name="info[cidade]" id="cidade" required class="form-control" readonly type="text">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="uf" class="col-form-label col-md-4 col-lg-3 text-end">UF:</label>
                    <div class="col-sm-8">
                        <input disabled placeholder="RN" name="info[uf]" id="uf" required class="form-control" readonly type="text">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="numero" class="col-form-label col-md-4 col-lg-3 text-end">Número:</label>
                    <div class="col-sm-8">
                        <input placeholder="154" name="info[numero]" onkeyup="cadSenha()" id="numero" required class="form-control" min="1" max="9999" type="number">
                    </div>
                </div>

                <!-- Informações de acesso -->
                <div class="align-items-center form row login">
                    <label for="email" class="col-form-label col-md-4 col-lg-3 text-end">E-mail:</label>
                    <div class="col-sm-8">
                        <input placeholder="@gmail.com" name="info[email]" id="email" required class="form-control" type="email">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="senha" class="col-form-label col-md-4 col-lg-3 text-end">Senha:</label>
                    <div class="col-sm-8">
                        <input placeholder="*******" name="info[senha]" id="senha" required class="form-control" type="password">
                    </div>
                </div>
                <div class="align-items-center form row login">
                    <label for="csenha" class="col-form-label col-md-4 col-lg-3 text-end">Confirmar senha:</label>
                    <div class="col-sm-8">
                        <input placeholder="*******" onkeyup="cadSenha()" id="csenha" required class="form-control" type="password">
                    </div>
                </div>
                <span class="vermelho text-nowrap" id="aviso-senha"></span>

                <span class="login" id="btn-avancar"><input type="submit" disabled class="btn btn-primary btn-large" value="Concluir"></span>
            </form>
        </div>
    </div>
</body>