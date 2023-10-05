<?php

    $filename = "ofertas.php";
    require_once('classes/ProductPage.php');
    $productpage = new ProductPage(4);

    require_once("partitions/acesso.php");
    require_once("partitions/purchase.php");

    include("partitions/header.php");
    
    // Consulta da parte superior
    $onsale1 = $productpage->viewOnSale(0);

?>

    <!-- CSS exclusivo dessa página -->
    <link rel="stylesheet" href="../css/ofertas.css">

    <div class="container">
        <h2 class="verdescuro marginb-40">Ofertas em destaque</h2>
        <div class="row">
            <?php if ($onsale1) : ?>
                <?php foreach ($onsale1 as $product) : ?>
                    <?php
                        require("partitions/compravel.php")
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-5 <?php if ($product['disponibilidade'] == 0) {echo "text-muted";} ?>">
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
        </div>
        <img class="col-12" id="banner-ofertas" src="../img/banners/banner_ofertas.png" alt="">
        <h2 class="verdescuro marginb-40">Ofertas do dia! <strong class="verde xbold">Aproveite agora</strong></h2>
        <?php
        
            // Consulta da parte inferior
            $onsale2 = $productpage->viewOnSale(4);

        ?>
        <div class="row">
            <?php if ($onsale2) : ?>
                <?php foreach ($onsale2 as $product) : ?>
                    <?php
                        require("partitions/compravel.php")
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-5 <?php if ($product['disponibilidade'] == 0) {echo "text-muted";} ?>">
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
        </div>
    </div>

<?php

    include("partitions/footer.php");

?>