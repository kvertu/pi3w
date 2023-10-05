<?php

require_once('../config.php');
require_once(dbapi);

class LoginCFA {
    private $info;

    public function setInfo($info) {
        $this->info = $info;
    }
    public function getInfo() {
        return $this->info;
    }
    public function validate($email, $password) {
        // Vai retornar true se estiver válido e falso se for inválido
        $db = new Database();
        
        if ($db->login('tbl_usercfa', $email, $password)) {
            return true;
        } else {
            if ($db->login('tbl_cli', $email, $password)) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function disconnect() {
        session_destroy();
        unset($_SESSION['user']);
        header("location: index.php");
    }
}

?>