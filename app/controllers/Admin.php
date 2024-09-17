<?php
#[AllowDynamicProperties]

class Admin extends Controller {
    public function __construct() {
        $this->adminModel = $this->model('AdminModel');
        $this->filefeltoltesModel = $this->model('FilefeltoltesModel');
    }

    // Az admin oldal megjelenítése
    public function index() {
        
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'main' => $this->adminModel->kartyaLekerdezes()
        ];

        $this->view('admin/index', $data);
    }

    // Esemény hozzáadása
    public function hozzaadas() {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                $cim = trim($_POST['cim']);
                $leiras = trim($_POST['leiras']);
                $datum = trim($_POST['datum']);
                $terem = trim($_POST['terem']);

                // Feltölés...
                if ( $_FILES['kep']['tmp_name'] ) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);
                    
                    if($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->ujEsemenyHozzadasa($_POST, $eredmeny)) {
                            // Az adatbázisba mentés sikerült
                            header('location:' . URLROOT . '/admin');
                        }
                        else {
                            echo "Az adatbázisba mentés nem sikerült.";
                            die;
                        }
                    }
                    else {
                        echo "A feltöltés nem sikerült.";
                    }
                }
            }
            else {
                // Ha nem POST metódussal érkezik a kérés, akkor az új klíma hozzáadása oldalra irányítjuk a felhasználót.

                $data = [
                    'terem' => $this->adminModel->terem()
                ];

                $this->view('admin/hozzaadas/index', $data);
            }  
        }  

        else {
            $data = [
            ];

            $this->view('user/login');
        }    
    }

    public function torles($id){
        if (isLoggedIn()){
            if ( $this->adminModel->torles($id) ) {
                // A törlés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin');
            }
            else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin');
            }
        }
        else{
            $data = [
            ];
    
            $this->view('user/login');
        }
    }
}

