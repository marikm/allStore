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
           return $db->getTable("grupos");
        }
        
        public function insertGroup(array $data, Db $db) {
            $description = $data["grupo_descricao"];
           
            $db->insert("grupo_descricao", "'$description'", "grupos");

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