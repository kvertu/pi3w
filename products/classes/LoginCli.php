<?php

require_once('classes/LoginCFA.php');

class LoginCli extends LoginCFA {

    public function signUp() {
        $info = parent::getInfo();
        $db = new Database();

        $db->insert('tbl_cli', $info);
        parent::validate($info['email'], $info['senha']);
    }
}

?>