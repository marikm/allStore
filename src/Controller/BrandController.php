<?php

    namespace App\Controller;

    use App\Db\Db;
    use App\Model\BrandModel;

    class BrandController {
        public $db;
        public $data;
        public $brandModel;
        public $brands;
        protected $brand_description;
        public $brand_description_edit;
       
       

        public function __construct() {
            session_start();
            $this->db = new Db();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['brand_description'])) {
                    $this->brand_description = filter_input(INPUT_POST, "brand_description", FILTER_SANITIZE_STRING);
                }
                
            }
            $this->brands = (new BrandModel())->getAllBrands($this->db);
             

        }

        public function insertBrand($description) {
            $reg = (new BrandModel())->insertBrand($description, $this->db);
            if($reg) {
                header('Content-Type: application/json');
                echo json_encode([
                    'id' => $this->db->lastInsertId(),
                    'nome' => $this->brand_description,
                    'redirect' => $_SERVER["REQUEST_URI"]
                ]);
                exit;
            }

            echo "Não foi possivel inserir marca";
            exit;

        }

        public function getBrandDescription(int $id) {
            $reg = (new BrandModel())->getBrandById($this->db, $id);
            return $reg["marca_descricao"];
        }

        public function updateBrand(int $id, $data) {
        
            $success = (new BrandModel())->editBrand($id, $data, $this->db);      
            if ($success) {
                echo "Registro alterado ";
                exit;
            }
            
            // Se falhar
            echo "Não foi possivel alterar registro";
            exit;
        }

        public function deleteBrand(int $id) {
        
            $success = (new BrandModel())->delete($id, $this->db);      
            if ($success) {
                echo "Registro excluído ";
                exit;
            }
            
            // Se falhar
            echo "Não foi possivel excluir registro";
            exit;
        }

        public function runFunction($operation) {

            if($operation == "insertBrand") {
                $description = filter_input(INPUT_POST, "brand_description");

                $this->insertBrand($description);
                exit;
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
            $this->data['admin'] = $_SESSION['admin'];
            $this->data['logged'] = $_SESSION['logged'];

            $this->data["brand_description"] = $this->brand_description;
            $operation = filter_input(INPUT_POST, 'operation');
            if(isset($operation)){
                $this->runFunction($operation);
            }
            $this->data = array_merge($this->data, [
                "brands" => $this->brands,
                "brand_description_edit" => $this->brand_description_edit
            ]);
 

            return $this->data;
        }

    }
