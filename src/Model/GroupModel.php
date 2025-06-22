<?php
    namespace App\Model;

    use App\Db\Db;
    use App\Utils\Helpers;
    use TypeError;

    class GroupModel {

        public function getGroupById(Db $db, int $id) {
            return $db->getOne($id, "grupos", 'idgrupos');
        }

        public function getAllGroups(Db $db) {
           return $db->getFieldId("grupos", "idgrupos", "grupo_descricao");
        }
        
        public function insertGroup(string $data, Db $db) {
           $success = $db->insert("grupo_descricao", "'$data'", "grupos");
            if($success) {
                return true;
            }
            return false;
        }

        public function editGroup($id, string $data, Db $db) {
            $success = $db->update($id, 'grupo_descricao', "'$data'", 'grupos', 'idgrupos');
            if($success) {
                return true;
            }
            return false;

        }

        public function delete($id, Db $db) {
            $success = $db->delete($id, 'grupos', 'idgrupos');
            if($success) {
                return true;
            }
            return false;
        }
        
    }