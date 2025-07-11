<?php
    namespace App\Model;

    use App\Db\Db;
    use App\Utils\Helpers;
    use TypeError;

    class BrandModel {

        public function getBrandById(Db $db, int $id) {
            return $db->getOne($id, "marcas", 'idmarcas');
        }

        public function getAllBrands(Db $db) {
           return $db->getFieldId("marcas", "idmarcas", "marca_descricao");
        }
        
        public function insertBrand(string $data, Db $db) {
            $success = $db->insert("marca_descricao", "'$data'", "marcas");

             if($success) {
                return true;
            }
            return false;

        }

        public function editBrand($id, string $data, Db $db) {
            $success = $db->update($id, 'marca_descricao', "'$data'", 'marcas', 'idmarcas');
            if($success) {
                return true;
            }
            return false;

        }

        public function delete($id, Db $db) {
            $success = $db->delete($id, 'marcas', 'idmarcas');
            if($success) {
                return true;
            }
            return false;
        }
        
    }