<?php
#[AllowDynamicProperties]

class Versenyreszletek extends Controller {
    public function __construct() {
        $this->VersenyreszletekModel = $this->model('VersenyreszletekModel');
    }

    // Az esemény részleteinek megjelenítése
    public function index($id) {

        $data = [
            'Versenyreszletek' => $this->VersenyreszletekModel->egyAdottEsemenyReszletei($id)
        ];

        $this->view('versenyreszletek/index', $data);

        //Hozzáadás
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

            $versenyID = (int)trim($_POST['versenyID']);
            $email = trim($_POST['email']);
            $neve = trim($_POST['neve']);

                if ($this->VersenyreszletekModel->emailHozzadas($versenyID, $email, $neve)) {
                    // A hozzáadás sikerült, ezért beállítjuk az üzenetet 0-ra
                    header('location:' . URLROOT . '/reszletek/' . $versenyID . '?msg=0');
                }
                else {
                    // A hozzáadás nem sikerült ezért beállítjuk az üzenetet 1-re
                    header('location:' . URLROOT . '/reszletek/' . $versenyID . '?msg=1');
                }
            }
        }
        
    }
