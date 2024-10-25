<?php
#[AllowDynamicProperties]

class Versenyreszletek extends Controller {
    public function __construct() {
        $this->VersenyreszletekModel = $this->model('VersenyreszletekModel');
    }

    // Az esemény részleteinek megjelenítése
    public function index($id) {

        $data = [
            'Versenyreszletek' => $this->VersenyreszletekModel->egyAdottEsemenyReszletei($id),
            'iskolak' => $this->VersenyreszletekModel->iskolakLekerdezes(),
            'evfolyamok' => $this->VersenyreszletekModel->evfolyamLekerdezes(),
            'versenyJelentkezok56' => $this->VersenyreszletekModel->versenyJelentkezokLekerzdezese56($id),
            'versenyJelentkezok78' => $this->VersenyreszletekModel->versenyJelentkezokLekerzdezese78($id)
        ];

        $this->view('versenyreszletek/index', $data);

        //Hozzáadás
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

            $versenyID = (int)trim($_POST['versenyID']);
            $email = trim($_POST['email']);
            $tanarNeve = trim($_POST['tanarNeve']);
            $tanuloNeve = trim($_POST['tanuloNeve']);
            $iskola = trim($_POST['iskola']);

            if($iskola == 'egyeb') {
                $iskola = trim($_POST['iskolaNeve']);
            }
            $evfolyam = trim($_POST['evfolyamok']);

            if ($this->VersenyreszletekModel->emailHozzadas($versenyID, $email, $tanarNeve, $tanuloNeve, $iskola, $evfolyam)) {
                // A hozzáadás sikerült, ezért beállítjuk az üzenetet 0-ra
                header('location:' . URLROOT . '/versenyreszletek/' . $versenyID . '?msg=0');
            }
            else {
                // A hozzáadás nem sikerült ezért beállítjuk az üzenetet 1-re
                header('location:' . URLROOT . '/versenyreszletek/' . $versenyID . '?msg=1');
            }
        }
    }
        
}
