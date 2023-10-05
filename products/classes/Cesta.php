<?php

require_once('../config.php');
require_once(dbapi);

class Cesta {

    public function __construct() {
        if (!isset($_SESSION['cesta'])) {
            // session_start();
            $_SESSION['cesta'] = [];
        }
    }
    public function addItem($product) {
        $product['amount'] = 1;
        array_push($_SESSION['cesta'], $product);
        // header('location: cesta.php');
    }
    public function removeItem($cod) {
        // unset($_SESSION['cesta'][$cod]);
        if (isset($_SESSION['cesta'][$cod + 1])) {
            for ($i=$cod; $i < count($_SESSION['cesta']) - 1; $i++) { 
                $_SESSION['cesta'][$i] = $_SESSION['cesta'][$i + 1];
                $_SESSION['cesta'][$i + 1] = [];
            }
        }
        unset($_SESSION['cesta'][count($_SESSION['cesta']) - 1]);
        
    }
    public function clearItems() {
        $_SESSION['cesta'] = [];
    }
    public function endPurchase() {
        $db = new Database();

        // Criação da compra
        $args1 = array(
            'codcli' => $_SESSION['user']['cod_cli']
        );
        // var_dump($args1);

        $db->execute('sp_addven', $args1);

        // Criação dos itens da compra
        $p = $db->getLatestPurchase($_SESSION['user']['cod_cli']);
        for ($i=0; $i < count($_SESSION['cesta']); $i++) {

            $args2 = array('codven' => $p['cod_ven'],'codprod' => $_SESSION['cesta'][$i]['cod_prod'],'qtdeitem' => $_SESSION['cesta'][$i]['amount']);
            // var_dump($args2);
            $db->execute('sp_additem', $args2);
        }

        $this->clearItems();
        header("location: fimcompra.php");    
        
    }

}

?>