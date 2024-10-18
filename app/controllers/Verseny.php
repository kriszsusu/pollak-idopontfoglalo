<?php
#[AllowDynamicProperties]

class Verseny extends Controller {
    public function __construct() {
        $this->versenyModel = $this->model('VersenyModel');
    }

    // A főoldal megjelenítése
    public function index() {

        $data = [
            'verseny' => $this->versenyModel->kartyaLekerdezes(),
        ];

        $this->view('verseny/index', $data);
    }
}