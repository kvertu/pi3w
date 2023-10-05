<?php

    $filename = "index.php";
    require_once('classes/ProductPage.php');
    $productpage = new ProductPage(4);

    require_once("partitions/acesso.php");
    require_once("partitions/purchase.php");

    include("partitions/header.php");
    $mostsold = $productpage->viewMostSold();

?>

    <!-- CSS exclusivo dessa página -->
    <link rel="stylesheet" href="../css/inicio.css">

    <div id="corpo">
        <div class="banner" id="banner-index<?php if (isset($_SESSION['user'])) {echo "-logged";} ?>">
            <div class="container">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <div id="btn-banner-index" class="start-50 translate-middle-x vstack gap-16">
                        <a id="btn-entrar" class="btn btn-primary btn-large col-lg-4 col-sm-6 col-10" href="login.php">ENTRAR</a><br>
                        <a id="btn-cadastrar" class="btn btn-outline-secondary btn-large col-lg-4 col-sm-6 col-10" href="cad.php">CADASTRE-SE</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="container">
            <div id="mais-vendidos" class="row">
                <h2 class="verdescuro marginb-40">Mais vendidos</h2>
                <?php if ($mostsold) : ?>
                    <?php foreach ($mostsold as $product) : ?>
                        <?php
                            require("partitions/compravel.php")
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-5">
                            <div class="card card-product">
                                <img class="card-img-top" src="../img/products/<?php echo $product['img_url']; ?>" alt="">
                                <div class="card-body">
                                    <p style="height: 64px;" class="cinza"><?php echo $product['nome']; if ($product['disponibilidade'] == 0) {echo "(Indisponível)";} ?></p>
                                    <p class="cinza"><?php if ($product['valor_temp'] <= 0 or $product['valor_temp'] == $product['valor_venda']) { echo "R$" . $product['valor_venda']; } else { echo "<span class=\"crossed-out vermelho\"> R$" . $product['valor_venda'] . "</span>&nbsp R$" . $product['valor_temp']; }?></p>
                                    <p class="cinza">Qtde.: <?php echo $product['qtde']; ?></p>
                                    <a class="btn btn-primary btn-medium <?php if (!$compravel) {echo "disabled";} ?>" href="<?php echo $filename . "?cod=" . $product['cod_prod']; ?>">Comprar</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
            <hr>
            <div id="promo" class="row">
                <h2 class="verdescuro marginb-40">Promoções</h2>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" id="promo1"><img class="promo" src="../img/banners/promo1.png" alt="Produtos com até 30% OFF"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" id="promo2"><img class="promo" src="../img/banners/promo2.png" alt="Dipirona com até 50% OFF"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" id="promo3"><img class="promo" src="../img/banners/promo3.png" alt="Leve 5 pague 3"></div>
            </div>
            <div id="forn" class="row">
                <div class="col-md-2 col-sm-4 col-6"><a href=""><img class="forn" src="../img/brands/ems.png" alt="EMS"></a></div>
                <div class="col-md-2 col-sm-4 col-6"><a href=""><img class="forn" src="../img/brands/divino.png" alt="Divino Remédio"></a></div>
                <div class="col-md-2 col-sm-4 col-6"><a href=""><img class="forn" src="../img/brands/buscopan.png" alt="Buscopan"></a></div>
                <div class="col-md-2 col-sm-4 col-6"><a href=""><img class="forn" src="../img/brands/allegra.png" alt="Allegra"></a></div>
                <div class="col-md-2 col-sm-4 col-6"><a href=""><img class="forn" src="../img/brands/maisaude.png" alt="MaisSaúde"></a></div>
                <div class="col-md-2 col-sm-4 col-6"><a href=""><img class="forn" src="../img/brands/pg.png" alt="P&G"></a></div>
            </div>
        </div>
    </div>

<?php

    include("partitions/footer.php");

?>