<?php
    namespace App\Model;

use App\Db\Db;

    class TableModel {

        protected $db;
        protected $data;

        public function __construct()
        {
            $this->db = new Db();
        }

        public function getData() : array{
            $this->data = $this->db->getTableByUser('calculadora', $_SESSION['name']);

            return $this->data;
        }


    }