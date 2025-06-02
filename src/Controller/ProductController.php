<?php

    namespace App\Controller;

    use App\Db\Db;
    use App\Model\ProductModel;

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

        public function __construct() {
            $this->db = new Db();
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['prod_descricao'])) {
                    $this->prod_descricao = filter_input(INPUT_POST, "prod_descricao", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
                if(isset($_POST['prod_vlr_un'])) {
                    $this->prod_vlr_un = filter_input(INPUT_POST, "prod_vlr_un", FILTER_SANITIZE_NUMBER_FLOAT);
                }
                if(isset($_POST['prod_cor'])) {
                    $this->prod_cor = filter_input(INPUT_POST, "prod_cor", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
                if(isset($_POST['prod_genero'])) {
                    $this->prod_genero =  filter_input(INPUT_POST, "prod_genero", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
                if(isset($_POST['prod_idmarcas'])) {
                    $this->prod_idmarcas = filter_input(INPUT_POST, "prod_idmarcas", FILTER_SANITIZE_NUMBER_INT);
                }
                if(isset($_POST['prod_idgrupos'])) {
                    $this->prod_idgrupos = filter_input(INPUT_POST, "prod_idgrupos", FILTER_SANITIZE_NUMBER_INT);
                }
                if(isset($_POST['prod_idsubgrupos'])) {
                    $this->prod_idsubgrupos = filter_input(INPUT_POST, "prod_idsubgrupos", FILTER_SANITIZE_NUMBER_INT);
                }
            }
        }

          public function index() {
            $this->data = [
                'prod_descricao' => $this->prod_descricao,
                'prod_vlr_un' => $this->prod_vlr_un,
                'prod_cor' => $this->prod_cor,
                'prod_genero' => $this->prod_genero,
                'prod_idmarcas' => $this->prod_idmarcas,
                'prod_idgrupos' => $this->prod_idgrupos,
                'prod_idsubgrupos' => $this->prod_idsubgrupos
            ];

            if(isset($_POST) and !empty($_POST)) {
                $this->productModel = (new ProductModel())->insertProduct($this->data, $this->db);
            }

            return $this->data;
        }

    }
