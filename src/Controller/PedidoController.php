<?php

    namespace App\Controller;

    use App\Db\Db;
    use App\Model\BrandModel;
    use App\Model\ProductModel;
    use App\Model\GroupModel;

    class ProductController {
        
        public $db;
        public $data;
        public $productModel;
        public $products;
        protected $prod_descricao;
        protected $prod_vlr_un;
        protected $prod_cor;
        protected $prod_genero;
        protected $prod_idmarcas;
        protected $prod_idgrupos;
        protected $prod_idsubgrupos;
        public $prodById;

        public function __construct() {
            session_start();
            $this->db = new Db();
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                
            }
        }

       
        

        public function runFunction($operation) {

           

        }

        public function index() {
            $this->data['admin'] = $_SESSION['admin'];
            $this->data['logged'] = $_SESSION['logged'];
           
            
            return $this->data;
        }

    }
