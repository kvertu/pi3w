<?php

session_start();
mysqli_report(MYSQLI_REPORT_STRICT);

class Database{

    private function open_database(){
        try {
            // Abrindo uma nova conexão
            $conn = new mysqli(db_host, db_user, db_password, db_name);
            $conn->set_charset("utf8");
            return $conn;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
    
    private function close_database($conn){
        try {
            // Fechando uma conexão (PS: Nunca esquecer de fechar uma conexão)
            mysqli_close($conn);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function findDetailed($table = null, $search = null, $firstline = null, $nlines = null){
        $database = $this->open_database();
        $found = null;
        
        /*
         +---------+
         |Variáveis|
         +---------+

         *$table = tabela a ser consultada
         $firstline = em que codigo a consulta iniciará
         $nlines = quantidade de linhas na consulta
         $search = termo pesquisado pelo usuário

         *Obrigatório
        */
        
        try {
            $limite = !is_null($firstline) and !is_null($nlines);

            $sql = "select * from " . $table;

            // Pode retornar multiplas linhas
            if (!is_null($search)) {
                // Se houver pesquisa, adicionar LIKE
                $sql .= ' where nome like "%' . $search . '%"';
            }
            if ($limite) {
                // Se um limite estiver determinado, adicionar a sintaxe do LIMIT
                $sql .= " limit " . $firstline . ", " . $nlines;
            }
            
            $result = $database->query($sql);
            if ($result->num_rows > 0) {
                // Pegar todas as linhas da consulta
                $found = $result->fetch_all(MYSQLI_ASSOC);
            }
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger'; 
        }
        $this->close_database($database);
        return $found;
    }

    public function findSearched($table = null, $search = null, $firstline = null, $nlines = null){
        // Faz a mesma coisa que findDetailed, mas não tem os parametros $value e $column
        return $this->findDetailed($table, $search, $firstline, $nlines);
    }

    public function find($table = null, $value = null, $column = null){
        $database = $this->open_database();

        try {
            $sql = "select * from " . $table . " where " . $column . " = " . $value;

            $result = $database->query($sql);
            if ($result->num_rows > 0) {
                // Pegar uma única linha da consulta
                $found = $result->fetch_assoc();
            }
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger'; 
        }

        $this->close_database($database);
        return $found;
    }
    
    public function findAll($table = null, $firstline = null, $nlines = null){
        // Faz a mesma coisa que find, mas não tem os parametros $value e $column
        return $this->findDetailed($table, null, $firstline, $nlines);
    }

    public function execute($procedure, $params) {
        $db = $this->open_database();
        $values = "";

        foreach ($params as $argument) {
            $values .= $argument . ",";
        }
        $values = rtrim($values, ',');

        $sql = "call " . $procedure . " ($values)";

        try {
            $return = $db->query($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
            $return = false;            
        }

        $this->close_database($db);
        return $return;
    }

    public function getLatestPurchase($cod) {
        $db = $this->open_database();

        // Vai retornar apenas um registro
        $sql = "select max(cod_ven) as cod_ven from tbl_ven where cod_cli = $cod;";

        try {
            $found = $db->query($sql);
            $return = $found->fetch_assoc();
        } catch (Exception $e) {
            echo $e->getMessage();
            $return = false;            
        }

        $this->close_database($db);
        return $return;
    }
    
    public function insert($table = null, $data = null) {
        $database = $this->open_database();
        // Columns: String bem longa com todos os campos da tabela, separados por vírgula
        $columns = null;
        // values: Vetor com todas os dados do registro
        $values = null;
    
        foreach ($data as $key => $value) {
            // Tratamento de dados
            // Entrada: 'cod','nome','email', ...
            // Saída: cod,nome,email, ...
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
        }
    
        // Mais tratamento de dados (Remoção da ultima virgula)
        // Entrada: ... ,tel_residencial,tel_celular,
        // Saída: ... , tel_residencial,tel_celular
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
    
        // Formação do comando sql
        $sql = "insert into " . $table . " ($columns)" .
        " values " . " ($values);";
        
        try {
            // Inserção do registro na tabela
            if ($database->query($sql) === TRUE) {
                $_SESSION['message'] = "Cadastrado com sucesso!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Falha ao cadastrar.";
                $_SESSION['type'] = "error";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->close_database($database);
    }

    public function getTableSize($table, $search) {
        // Pegar o tamanho da tabela (quantidade de registros)
        $database = $this->open_database();
        $linecount = null;

        try {
            $sql = "select * from " . $table;
            if (!is_null($search)) {
                $sql .= " where nome like \"%$search%\"";
            }
            $result = $database->query($sql);
            // var_dump($result->num_rows);
            $linecount = $result->num_rows;
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        $this->close_database($database);
        return $linecount;
    }

    public function getPageCount($table, $linesperpage, $search){
        /*
            +---------+
            |Variáveis|
            +---------+

            $table = tabela a ser consultada
            $linesperpage = qtde. de linhas por página (valor varia com a página)
        */

        $totalines = $this->getTableSize($table, $search);
        $pagecount = ceil($totalines / $linesperpage);

        return $pagecount;
    }

    public function login($table=null, $login=null, $senha=null) {
        $db = $this->open_database();
        $retorno = false;
        $query = "select * from $table where email = \"$login\" and senha = \"$senha\" limit 1";

        try {
            $results = $db->query($query);

            if ($results && $results->num_rows === 1) {
                $retorno = true;
                $loggeduser = $results->fetch_assoc();

                $_SESSION['user'] = $loggeduser;
            }
        } catch (Exception $e) {
            var_dump($e);
        }
        
        $this->close_database($db);
        return $retorno;
    }
}

?>