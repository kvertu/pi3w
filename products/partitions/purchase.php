<?php

$c = new Cesta;

if (isset($_GET['cod'])) {
    $p = new ProductPage();
    $item = $p->viewProduct($_GET['cod']);
    // var_dump($item);
    $c->addItem($item);
    header("location: cesta.php");
}

?>