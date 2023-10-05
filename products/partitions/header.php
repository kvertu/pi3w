<?php

if (isset($_GET['disconnect'])) {
    $l = new LoginCFA;
    $l->disconnect();
}

require_once("partitions/base.php");

?>

<body class="bg-verdeclaro">
    <header>
        <nav class="fixed-top navbar navbar-expand-lg bg-verde">
            <div class="container" style="min-height: 74px;">
                <div class="col sm-auto">
                    <a class="navbar-brand" href="index.php"><img id="header-logo" src="../img/logos/headerlogo.png" alt="Logo CFA"></a>
                </div>
                <div class="col-6">
                    <input id="searchbar" type="search" class="form-control input-menu lg-6" placeholder="O que deseja encontrar?">
                </div>
                <div class="col lg-0 sm-auto text-end">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-content">
                    <ul class="navbar-nav">
                        <div class="col-10">
                        <?php if (isset($_SESSION['user'])) : ?>
                            <li class="nav-item dropdown">
                                <!-- Relacionado ao login -->
                                <div id="acesso" class="branco">
                                    <a class="dropdown-toggle branco" data-bs-toggle="dropdown" href="#"><strong class="branco font-20">Olá <?php echo $_SESSION['user']['nome']; ?>!</strong></a>
                                    <ul class="dropdown-menu text-end">
                                        <li>
                                            <a class="dropdown-item" href="index.php?disconnect=1"><span class="bi bi-box-arrow-right"></span>Sair</a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </li>
                            <?php else : ?>
                                <li class="nav-item branco">
                                    <strong class="branco font-20">Olá visitante!</strong><br>
                                    <a class="navbar-link branco" href="cad.php">Cadastre-se</a> | <a class="navbar-link branco" href="login.php">Login</a>
                                </li>
                            <?php endif; ?>
                        </div>
                        <div class="col-auto">
                            <li id="cesta" class="nav-item">
                                <a class="navbar-link <?php if ($filename == "cesta.php") { echo "cesta-active"; } else { echo "branco";} ?>" href="cesta.php">minha cesta</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="header-bg-nav" class="bg-verdeclaro2">
        <div class="container">
            <ul class="nav nav-pills">
                <li class="navegacao nav-item">
                    <a class="nav-link <?php if($filename == "index.php"){ echo "active"; } ?>" aria-current="page" href="index.php">Início</a>
                </li>
                <li class="navegacao nav-item">
                    <a class="nav-link <?php if($filename == "ofertas.php"){ echo "active"; } ?>" href="ofertas.php">Ofertas</a>
                </li>
                <li class="navegacao nav-item">
                    <a class="nav-link <?php if($filename == "med.php"){ echo "active"; } ?>" href="med.php">Medicamentos</a>
                </li>
            </ul>
        </div>
    </div>

<!-- Script para a pesquisa -->
<script src="js/search.js"></script>