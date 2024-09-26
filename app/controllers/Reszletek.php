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
            //Tiltott email-ek beolvasása            
            $json = file_get_contents('emailBlock.json');
            
                if ($json === false){
                    die('Nem sikerült beolvasni a JSON file-t');
                }
            $json_data = json_decode($json, true);
                if ($json_data === null){
                    die('Nem sikerült dekódolni a JSON file-t');
                }
            //Ellenőrzi, hogy az email benne van-e a listában
            if (in_array($email,$json_data)){
                echo "Ezt az email-t nem használhatod!";
                }
            else{
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
}

