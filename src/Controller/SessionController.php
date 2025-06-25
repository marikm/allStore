<?php
    namespace App\Controller;
    use App\Db\Db;
    use App\Model\UserModel;

    class SessionController {
        

        public function __construct( ) {
            if (!isset($_SESSION)) {
                session_start();
            }
        }

        public function setLogged($name, $email, $admin) : void {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['logged'] = true;
            $_SESSION['admin'] = $admin;
            header('Location: /allStore/src/');

        }

        public function logout() : void {
            $_SESSION['name'] = null;
            $_SESSION['email'] = null;
            $_SESSION['logged'] = false;
            $_SESSION['admin'] = false;
            header('Location: /allStore/src/');
        }

        public function getLogged(): bool {
            if(isset($_SESSION['name']) && isset($_SESSION['email'])) {
                return true;
            }
            return false;
        }
    
    }