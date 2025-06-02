<?php
    namespace App\Controller;

    use App\Model\TableModel;

    class TableController {

        public $data;

        public function __construct()
        {
            session_start();
            if(!isset($_SESSION['logged']) || !$_SESSION['logged'] == true) {
                header("Location: home");
                die();
            }
            $this->data['content'] = (new TableModel())->getData();

        }

        public function index() {
            $this->data['logged'] = $_SESSION['logged'];
            return $this->data;
        }

    }