<?php

    $filename = "med.php";
    require_once('classes/ProductPage.php');

    require_once("partitions/acesso.php");
    require_once("partitions/purchase.php");
    
    include("partitions/header.php");

    $productpage = new ProductPage(8);
    if (isset($_GET['page'])) {
        $productpage->currentline = (($_GET['page'] - 1) * $productpage->getProductsPerPage());
        $page = $_GET['page'];
    } else {
        $productpage->currentline = 0;
        $page = 1;
    }
    if (!isset($_GET['search'])) {
        $med = $productpage->viewAllProducts();
        $searchurl = "";
        $searchterm = null;
        $pesquisa = false;
    } else {
        $med = $productpage->searchProduct($_GET['search']);
        // var_dump($med);
        $searchurl = "&search=" . $_GET['search'];
        $searchterm = $_GET['search'];
        $pesquisa = true;
    }

?>

    <div class="container">
        <?php if ($pesquisa) : ?>
            <h2 class="verdescuro marginb-40">Resultados de "<?php echo $_GET['search']; ?>"</h2>
        <?php else : ?>
            <h2 class="verdescuro marginb-40">Mais procurados</h2>
        <?php endif; ?>
        <div class="row">
            <?php if ($med) : ?>
                <?php foreach ($med as $product) : ?>
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
        <?php if ($productpage->getRowCount($searchterm) > $productpage->getProductsPerPage()) : ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($page <= 1) { echo "disabled"; } ?>"><a class="bi bi-chevron-double-left page-link" href="med.php?page=1<?php echo $searchurl; ?>"></a></li>
                    <li class="page-item <?php if ($page - 1 <= 0) { echo "disabled"; } ?>"><a class="bi bi-chevron-left page-link" href="med.php?page=<?php echo ($page - 1) . $searchurl; ?>"></a></li>
                    <?php for ($i = $page - 2; $i < $page + 3; $i++) :?>
                        <?php if ($i > 0 and $i <= $productpage->getPageCount($searchterm)) :?>
                            <li class="page-item"><a class="page-link <?php if ($i == $page) { echo "active active-page"; } ?>" href="med.php?page=<?php echo $i . $searchurl; ?>"><?php echo $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($page + 1 > $productpage->getPageCount($searchterm)) { echo "disabled"; } ?>"><a class="bi bi-chevron-right page-link" href="med.php?page=<?php echo ($page + 1) . $searchurl; ?>"></a></li>
                    <li class="page-item <?php if ($page >= $productpage->getPageCount($searchterm)) { echo "disabled"; } ?>"><a class="bi bi-chevron-double-right page-link" href="med.php?page=<?php echo ($productpage->getPageCount($searchterm)) . $searchurl; ?>"></a></li>
                </ul>
            </nav>
                
        <?php endif; ?>
    </div>

<?php

    include("partitions/footer.php");

?>