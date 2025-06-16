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

        public function __construct() {
            $this->db = new Db();
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['prod_descricao'])) {
                    $this->prod_descricao = filter_input(INPUT_POST, "prod_descricao", FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['prod_vlr_un'])) {
                    $this->prod_vlr_un = filter_input(INPUT_POST, "prod_vlr_un", FILTER_SANITIZE_NUMBER_FLOAT);
                }
                if(isset($_POST['prod_cor'])) {
                    $this->prod_cor = filter_input(INPUT_POST, "prod_cor", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
                if(isset($_POST['prod_genero'])) {
                    $this->prod_genero =  filter_input(INPUT_POST, "prod_genero", FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['prod_idmarcas'])) {
                    $this->prod_idmarcas = filter_input(INPUT_POST, "prod_idmarcas", FILTER_SANITIZE_NUMBER_INT);
                }
                if(isset($_POST['prod_idgrupos'])) {
                    $this->prod_idgrupos = filter_input(INPUT_POST, "prod_idgrupos", FILTER_SANITIZE_NUMBER_INT);
                }
                
            }
        }

        public function insertProduct() {
            $this->productModel = (new ProductModel())->insertProduct($this->data, $this->db);

        }

        public function runFunction($operation) {

            if($operation == "insertProduct") {
                $this->insertProduct();
            }

            if($operation == "getBrandDescription") {
                $id = filter_input(INPUT_POST, 'id_cadastro', FILTER_VALIDATE_INT);
                $this->brand_description_edit = $this->getBrandDescription($id); 
            
                echo $this->brand_description_edit;
                exit;
            }

            if($operation == "updateBrand") {
                $id = filter_input(INPUT_POST, 'id_cadastro', FILTER_VALIDATE_INT);
                $data = filter_input(INPUT_POST, 'descricao');
                $this->updateBrand($id, $data);
                exit;
            }
            if($operation == "deleteBrand") {
                $id = filter_input(INPUT_POST, 'id_cadastro', FILTER_VALIDATE_INT);
                $this->deleteBrand($id);
                exit;
            }

        }

        public function index() {
            // Grupos e Marcas cadastrados
            $grupos = (new GroupModel())->getAllGroups($this->db);
            $marcas = (new BrandModel())->getAllBrands($this->db);
            // Dados da roupa para cadastrar
            $this->data['prod_descricao'] = $this->prod_descricao;
            $this->data['prod_vlr_un'] = $this->prod_vlr_un;
            $this->data['prod_cor'] = $this->prod_cor;
            $this->data['prod_genero'] =$this->prod_genero;
            $this->data['prod_idmarcas'] = $this->prod_idmarcas;
            $this->data['prod_idgrupos' ]=$this->prod_idgrupos;
            $this->data['prod_idsubgrupos'] =$this->prod_idsubgrupos;
            $this->data['grupos'] = $grupos;
            $this->data['marcas'] = $marcas;

            $operation = filter_input(INPUT_POST, 'operation');
            if(isset($operation)){
                $this->runFunction($operation);
            }
            
            return $this->data;
        }

    }
