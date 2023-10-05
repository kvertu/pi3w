<?php

require_once("classes/LoginCli.php");
require_once("classes/Cesta.php");

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['user']['cnpj'])) {
        $_SESSION['usertype'] = "cli";
    } else {
        $_SESSION['usertype'] = "func";
    }
}

?>