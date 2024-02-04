<?php

    namespace App\Modules\Authentication\Contracts;

    interface IAuthentication {
        
        public function login($data);
        public function loginById($data);
        public function register($data);
        public function me();
        public function logout();
        public function refresh();
        public function tokenById($data);
        public function servicesByUserId($id);
    }

?>