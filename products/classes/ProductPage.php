<?php

require_once('../config.php');
require_once(dbapi);

class ProductPage {
    public $db;
    private $productsperpage = null;
    public $currentline = 0;

    function __construct($respage = 50) {
        $this->productsperpage = $respage;
        $this->db = new Database();
    }
    public function viewAllProducts () {
        return $this->db->findAll('vw_prod', $this->currentline, $this->productsperpage);
    }
    public function viewMostSold () {
        return $this->db->findAll('vw_maisvendidos', 0, $this->productsperpage);
    }
    public function viewOnSale ($i) {
        return $this->db->findAll('vw_desconto', $i, $this->productsperpage);
    }
    public function viewProduct ($cod) {
        return $this->db->find('vw_prod', $cod, 'cod_prod');
    }
    public function searchProduct ($product) {
        return $this->db->findSearched('vw_prod', $product, $this->currentline, $this->productsperpage);
    }
    public function getRowCount ($search = null) {
        return $this->db->getTableSize('vw_prod', $search);
    }
    public function getPageCount($search = null) {
        return $this->db->getPageCount('vw_prod', $this->productsperpage, $search);
    }
    public function getProductsPerPage() {
        return $this->productsperpage;
    }
}

?>