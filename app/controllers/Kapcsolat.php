<?php
#[AllowDynamicProperties]

class Kapcsolat extends Controller {
    public function __construct() {
        $this->kapcsolatModel = $this->model('KapcsolatModel');
    }

    // A kapcsolat megjelenítése
    public function index() {

        $data = [
            
        ];

        $this->view('kapcsolat/index', $data);
    }
}
