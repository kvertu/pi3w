<?php
    include("partitions/header.php");
?>

<link rel="stylesheet" href="../css/fimcompra.css">
<div class="container">
    <div class="hstack marginb-96">
        <p class="col-8 font-32 verdescuro marginless">PEDIDO FINALIZADO COM SUCESSO!</p>
        <div class="text-end col-4">
            <a class="btn btn-primary btn-large" href="index.php">Continuar Comprando</a>
        </div>
    </div>
    <div class="text-center bg-branco marginb-88" id="banner-fimcompra">
        <p class="font-32 verdescuro">Todas as informações do seu pedido foram encaminhadas para o seu e-mail.</p>
        <img class="col-2" src="../img/banners/fimcompra.png" alt="">
    </div>
</div>

<?php
    include("partitions/footer.php");
?>