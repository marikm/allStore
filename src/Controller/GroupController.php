<?php

    namespace App\Controller;

    use App\Db\Db;
    use App\Model\GroupModel;

    class GroupController{
        public $db;
        public $data;
        public $groupModel;
        public $groups;
        protected $grupo_descricao;
        public $grupo_descricao_edit;
       
       

        public function __construct() {
            $this->db = new Db();

            $this->groups = (new GroupModel())->getAllGroups($this->db);
             

        }

        public function insertGroup($grupo_descricao) {
            $success = (new GroupModel())->insertGroup($grupo_descricao, $this->db);
            if ($success) {
                header('Content-Type: application/json');
                echo json_encode([
                    'id' => $this->db->lastInsertId(),
                    'nome' => $grupo_descricao,
                    'redirect' => $_SERVER["REQUEST_URI"]
                ]);
                exit;
            }
            
            // Se falhar
            echo "Não foi possivel cadastrar registro";
            exit;
        }

        public function getGroupDescription(int $id) {
            $reg = (new GroupModel())->getGroupById($this->db, $id);
            return $reg["grupo_descricao"];
        }

        public function updateGroup(int $id, $data) {
        
            $success = (new GroupModel())->editGroup($id, $data, $this->db);      
            if ($success) {
                echo "Registro alterado ";
                exit;
            }
            
            // Se falhar
            echo "Não foi possivel alterar registro";
            exit;
        }

        public function deleteGroup(int $id) {
        
            $success = (new GroupModel())->delete($id, $this->db);      
            if ($success) {
                echo "Registro excluído ";
                exit;
            }
            
            // Se falhar
            echo "Não foi possivel excluir registro";
            exit;
        }

        public function runFunction($operation) {

            if($operation == "insertGroup") {

                $grupo_descricao = filter_input(INPUT_POST, "grupo_descricao");

                $this->insertGroup($grupo_descricao);
                
                exit;
            }

            if($operation == "getGroupDescription") {
                $id = filter_input(INPUT_POST, 'id_cadastro', FILTER_VALIDATE_INT);
                $this->grupo_descricao_edit = $this->getGroupDescription($id); 
                echo $this->grupo_descricao_edit;
                exit;
            }

            if($operation == "updateGroup") {
                $id = filter_input(INPUT_POST, 'id_cadastro', FILTER_VALIDATE_INT);
                $data = filter_input(INPUT_POST, 'descricao');
                $this->updateGroup($id, $data);
                exit;
            }
            if($operation == "deleteGroup") {
                $id = filter_input(INPUT_POST, 'id_cadastro', FILTER_VALIDATE_INT);
                $this->deleteGroup($id);
                exit;
            }

        }

        public function index() {
            // $this->data["grupo_descricao"] = $this->grupo_descricao;
             $this->data["grupo_descricao"] = "";
            $operation = filter_input(INPUT_POST, 'operacao');
            if(isset($operation)){
                $this->runFunction($operation);
            }
            $this->data = array_merge($this->data, [
                "grupos" => $this->groups,
                "grupo_descricao_edit" => $this->grupo_descricao_edit
            ]);
 

            return $this->data;
        }

    }
