<?php
#[AllowDynamicProperties]

class Reszletek extends Controller {
    public function __construct() {
        $this->reszletekModel = $this->model('ReszletekModel');
    }

    // Az esemény részleteinek megjelenítése
    public function index($id) {

        $data = [
            'reszletek' => $this->reszletekModel->egyAdottEsemenyReszletei($id)
        ];

        $this->view('reszletek/index', $data);
    }

    $blockedEmails file_get_contents(././emailblock.json);
    json_decode($blockedEmails)
}