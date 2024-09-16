<?php
#[AllowDynamicProperties]

class Main extends Controller {
    public function __construct() {
        $this->mainModel = $this->model('MainModel');
    }

    public function index() {
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
            'main' => $this->mainModel->kartyaLekerdezes()
        ];

        $this->view('main/index', $data);
    }
}
