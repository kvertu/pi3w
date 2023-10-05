<?php

require_once("partitions/base.php");
require_once("classes/LoginCFA.php");

$login_valido = null;

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $l = new LoginCFA;

    if ($l->validate($_POST['email'],$_POST['senha'])) {
        $login_valido = true;
        header("location: index.php");
    } else {
        $login_valido = false;
    }
}

?>

<link rel="stylesheet" href="../css/login.css">

<body class="bg-verdeclaro">
    <div class="container">
        <div class="text-center">
            <img src="../img/logos/headerlogo.png" class="col-2 rounded-circle" id="logo-small" alt="">
            <h5 class="font-24 verdescuro"><strong>Fazer login</strong></h5>
            <p class="font-24 verdescuro">Use a sua conta do Google ou E-mail</p>
            <br>
            <form action="login.php" method="post">
                <div class="input-group vstack gap-3 marginb-74">
                    <div class="align-items-center">
                        <div class="formato row justify-content-center">
                            <div class="col-auto">
                                <label class="col-form-label" for="login">Login:</label>
                            </div>
                            <div class="col-4">
                                <input name="email" class="form-control" placeholder="@gmail.com" type="email">
                            </div>
                        </div>
                    </div>
                    <div class="align-items-center">
                        <div class="formato row justify-content-center">
                            <div class="col-auto">
                                <label class="col-form-label" for="senha">Senha:</label>
                            </div>
                            <div class="col-4">
                                <input name="senha" placeholder="*******" class="form-control" type="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="msg" class="vermelho <?php if (!isset($login_valido) && !$login_valido) { echo "invisible"; } ?>"> Credenciais incorretas!</div>
                <div class="hstack">
                    <div class="col">
                        <a class="col-4 btn btn-outline-primary btn-large" href="cad.php">Criar conta</a>
                    </div>
                    <div class="col">
                        <input type="submit" class="col-4 btn btn-primary btn-large" value="Avançar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>