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

        //Hozzáadás
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

            $esemenyID = (int)trim($_POST['esemenyID']);
            $email = trim($_POST['email']);

            if ($this->reszletekModel->emailHozzadas($esemenyID, $email)) {
                // A hozzáadás sikerült, átirányítjuk a felhasználót a főoldalra
                header('location:' . URLROOT . '/main');
            }
            else {
                // A hozzáadás nem sikerült ezért vissza irányítjuk a főoldlra
                header('location:' . URLROOT . '/main');
            }
        }
    }
}

