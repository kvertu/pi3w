<?php

    $filename = "cesta.php";
    include("partitions/header.php");
    require_once("classes/Cesta.php");
    $c = new Cesta;

    // $c->clearItems();
    if (isset($_GET['finish'])) {
        $c->endPurchase();
    }

    if (isset($_GET['deletecod'])) {
        $c->removeItem($_GET['deletecod']);
        header("location: cesta.php");
    }

?>

    <!-- CSS exclusivo da cesta -->
    <link rel="stylesheet" href="../css/cesta.css">

    <div class="container">

        <?php if (!isset($_SESSION['user'])) : ?>
            <div id="acesso-negado" class="bg-branco">
                <p class="cinza text-center font-24 marginb-44">Entre com a sua conta para ter acesso a sua lista de produtos!</p>
            
                <div class="col-4 gap-3 vstack mx-auto">
                    <a class="btn text-center btn-primary btn-large" href="login.php">Entrar</a>
                    <a class="btn text-center btn-outline-primary btn-large" href="cad.php">Cadastre-se</a>
                </div>
            </div>
        <?php elseif ($_SESSION['cesta']) : ?>

            <div class="hstack">
                <p class="col-7 font-32 verdescuro">Meus pedidos</p>
                <p class="col-5 font-24 verdescuro text-end">Total da compra: R$ <span id="total">0</span></p>
            </div>
            <div class="text-end">
                <a class="col-2 btn btn-primary btn-large marginb-56" href="cesta.php?finish=1">FINALIZAR</a>
            </div>
            
            <div class="row justify-content-center">
                <?php $cont = 0; foreach ($_SESSION['cesta'] as $product) : ?>
                    <?php
                        if ($product['valor_temp'] <= 0 or $product['valor_temp'] == $product['valor_venda']) {
                            $desconto = false;
                            $preco = $product['valor_venda'];
                        } else {
                            $desconto = true;
                            $preco = $product['valor_temp'];
                        }
                    ?>
                    <div class="card card-cesta col-lg-10 col-sm-12 hstack">
                        <div class="col-lg-4 col-sm-12">
                            <img class="img-fluid" src="../img/products/<?php echo $product['img_url']; ?>" alt="">
                        </div>
                        <div class="card-body col-auto">
                            <a class="exclusao vermelho bi bi-x-lg streched-link font-24" href="cesta.php?deletecod=<?php echo $cont; ?>"></a>
                            <p class="cinza font-32"><?php echo $product['nome']; ?></p>
                            <p class="cinza font-32">
                                <?php if (!$desconto) {
                                    echo 'R$ <span id="price-' . $cont .'">' . $product['valor_venda'] . "</span>";
                                } else {
                                    echo "<span class=\"crossed-out vermelho\"> R$ " . $product['valor_venda'] . '</span>&nbsp R$ <span id="price-' . $cont .'">' . $product['valor_temp'] . "</span>";
                                }?>
                            </p>
                            <div class="hstack">
                                <p class="font-24 marginless cinza col-8 text-end">R$ <span id="subtotal-<?php echo $cont; ?>"><?php echo ($preco * $product['amount']); ?></span></p> &nbsp;
                                <div class="input-group">
                                    <button type="button" onclick="minus(<?php echo $cont; ?>)" class="bi bi-chevron-left font-24 btn btn-primary"></button>
                                    <input class="form-control bg-verdeclaro verdescuro font-24" readonly type="number" id="counter-<?php echo $cont; ?>" value="<?php echo $product['amount']; ?>" min="1" max="1000">
                                    <button type="button" onclick="plus(<?php echo $cont; ?>)" class="bi bi-chevron-right font-24 btn btn-primary"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $cont++; endforeach; if ($cont > 5) :?>
                    <div class="row justify-content-center">
                        <a class="col-2 btn btn-primary btn-large" id="btn-f-bottom" href="cesta.php?finish=1">FINALIZAR</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <div id="acesso-negado" class="bg-branco">
                <p class="cinza text-center font-24 marginb-44">Você ainda não adicionou nada</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Script para os contadores -->
    <script src="js/counter.js"></script>
    <script type="text/javascript">
        define_tamanho_cesta(<?php echo $cont; ?>);
        total();
    </script>

<?php

    include("partitions/footer.php");

?>