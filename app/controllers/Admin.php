<?php
#[AllowDynamicProperties]

class Admin extends Controller {
    public function __construct() {
        $this->adminModel = $this->model('AdminModel');
    }

    public function index() {
        
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        if (isAdmin()) {
            header('location:' . URLROOT . '/admin');
        }
        
        $data = [
            // 'melegEtelek' => $this->mainModel->melegEtelekLekerdezese()
        ];

        $this->view('admin/index', $data);
    }
}

