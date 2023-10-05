<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    if ($_GET['op'] == 0) {
        echo $_SESSION['cesta'][$_GET['cod']]['amount'] -= 1;
    } else {
        if ($_SESSION['cesta'][$_GET['cod']]['amount'] + 1 <= $_SESSION['cesta'][$_GET['cod']]['qtde'] and $_SESSION['cesta'][$_GET['cod']]['amount'] < 1000) {
            echo $_SESSION['cesta'][$_GET['cod']]['amount'] += 1;
        } else {
            echo $_SESSION['cesta'][$_GET['cod']]['amount'];
        }
    }
    
    
?>