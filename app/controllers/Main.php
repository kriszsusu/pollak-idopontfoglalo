<?php
#[AllowDynamicProperties]

class Main extends Controller {
    public function __construct() {
        $this->mainModel = $this->model('MainModel');
    }

    // A főoldal megjelenítése
    public function index() {

        $data = [
            'main' => $this->mainModel->kartyaLekerdezes()
        ];

        $this->view('main/index', $data);
    }
}
