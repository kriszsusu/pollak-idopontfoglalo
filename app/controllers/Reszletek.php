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
                // A hozzáadás sikerült, ezért beállítjuk az üzenetet 0-ra
                header('location:' . URLROOT . '/reszletek/' . $esemenyID . '?msg=0');
            }
            else {
                // A hozzáadás nem sikerült ezért beállítjuk az üzenetet 1-re
                header('location:' . URLROOT . '/reszletek/' . $esemenyID . '?msg=1');
            }
        }
    }
}

