<?php
    namespace App\Model;

    use App\Db\Db;
    use App\Utils\Helpers;
    use TypeError;

    class ProductModel {

        public function getAllProducts(Db $db) {
           return $db->getTable("produtos");
        }

        public function insertProduct(array $data, Db $db) {
            $reg = array();
            $keys = "";
            $values = "";

            $reg["prod_descricao"] = Helpers::addQuotes($data["prod_descricao"]);
            $reg["prod_vlr_un"] = Helpers::decimalFormat($data["prod_vlr_un"]);
            $reg["prod_cor"] = Helpers::addQuotes($data["prod_cor"]);
            $reg["prod_genero"] = Helpers::addQuotes($data["prod_genero"]);
            $reg["prod_idmarcas"] = Helpers::intFormat($data["prod_idmarcas"]);
            $reg["prod_idgrupos"] =  Helpers::intFormat($data["prod_idgrupos"]);
            // $reg["prod_foto"] =  Helpers::addQuotes($data["foto"]);

            $keys = Helpers::getArrayKeysValues($reg);
            $values = Helpers::getArrayKeysValues($reg, "values");
            $db->insert($keys, $values, "produtos");
        }

        public function editProduct(array $data, Db $db) {
            $reg = array();
            $keys = "";
            $values = "";

            $reg["prod_descricao"] = Helpers::addQuotes($data["prod_descricao"]);
            $reg["prod_vlr_un"] = Helpers::decimalFormat($data["prod_vlr_un"]);
            $reg["prod_cor"] = Helpers::addQuotes($data["prod_cor"]);
            $reg["prod_genero"] = Helpers::addQuotes($data["prod_genero"]);
            $reg["prod_idmarcas"] = Helpers::intFormat($data["prod_idmarcas"]);
            $reg["prod_idgrupos"] =  Helpers::intFormat($data["prod_idgrupos"]);

            $keys = Helpers::getArrayKeysValues($reg);
            $values = Helpers::getArrayKeysValues($reg, "values");
            $db->update($data["idprodutos"], $keys, $values, "produtos", "idprodutos");
        }

        public function getById(Db $db, $id){
            return $db->getOne($id, "produtos", "idprodutos");
        }
    }