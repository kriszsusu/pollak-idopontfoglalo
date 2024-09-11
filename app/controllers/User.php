<?php
#[AllowDynamicProperties]

class User extends Controller {
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function login() {
        /*
        if (!isLoggedIn()) {
            echo "Nem vagy bejelentkezve.";
            die;
        }

        if (isAdmin()) {
            header('location:' . URLROOT . '/admin');
        }
        */

        $data = [
            // 'melegEtelek' => $this->mainModel->melegEtelekLekerdezese()
        ];

        $this->view('user/login', $data);
    }
}