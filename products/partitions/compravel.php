<?php
if ($product['disponibilidade'] == 1 and isset($_SESSION['user']) and $product['qtde'] > 0) {
    $compravel = true;
    for ($i=0; $i < count($_SESSION['cesta']); $i++) { 
        if ($_SESSION['cesta'][$i]['cod_prod'] == $product['cod_prod']) {
            $compravel = false;
        }
    }
} else {
    $compravel = false;
}
?>