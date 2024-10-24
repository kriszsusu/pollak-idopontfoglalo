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

    // Egy adott esemény részleteinek megjelenítése
    public function reszletek($id){
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'reszletek' => $this->adminModel->egyAdottEsemenyReszletei($id),
            'jelentkezok' => $this->adminModel->jelentkezokLekerzdezese($id)
        ];

        $this->view('admin/reszletek/index', $data);
    }

    // Esemény hozzáadása
    public function hozzaadas() {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

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
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [
                    'terem' => $this->adminModel->terem(),
                    'szak' => $this->adminModel->szak(),
                    'tanarok' => $this->adminModel->tanarok()
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

    // Esemény szerkesztése
    public function szerkesztes($id) {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                $cim = trim($_POST['cim']);
                $leiras = trim($_POST['leiras']);
                $datum = trim($_POST['datum']);
                $tanteremID = trim($_POST['tanteremID']);
                $szakID = trim($_POST['szak']);
                $tanarID = trim($_POST['tanar']);
                $tema = trim($_POST['tema']);

                // Feltölés...
                if ( $_FILES['kep']['tmp_name'] ) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);
                    
                    if($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->esemenySzerkesztese($id, $eredmeny, $cim, $leiras, $datum, $tanteremID, $szakID, $tanarID, $tema)) {
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
                else{
                    if ($this->adminModel->esemenySzerkesztese($id, false, $cim, $leiras, $datum, $tanteremID, $szakID, $tanarID, $tema)) {
                        // Az adatbázisba mentés sikerült
                        header('location:' . URLROOT . '/admin');
                    }
                    else {
                        echo "Az adatbázisba mentés nem sikerült.";
                        die;
                    }
                }
            }
            else {
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [
                    'esemeny' => $this->adminModel->esemeny($id),
                    'terem' => $this->adminModel->terem(),
                    'szak' => $this->adminModel->szak(),
                    'tanarok' => $this->adminModel->tanarok()
                ];

                $this->view('admin/szerkesztes/index', $data);
            }  
        }  

        else {
            $data = [
            ];

            $this->view('user/login');
        }    
    }

    // Esemény duplikálása
    public function duplikalas($id) {
        if (isLoggedIn()) {

            if ( $this->adminModel->duplikalasModel($id) ) {
                // A duplikálás sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin');
            }
            else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin');
            }
        }
        else {
            $data = [

            ];
            $this->view('user/login');
        }
    }

    // Esemény törlése
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

    // Admin hozzáadása
    public function adminhozzadas() {
        
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

            $felhasznalonev = trim($_POST['felhasznalonev']);
            $nev = trim($_POST['nev']);
            $jelszo = trim($_POST['jelszo']);
            $jelszoUjra = trim($_POST['jelszo-ujra']);

            if ($jelszo == $jelszoUjra) {
                if ($this->adminModel->adminHozzadas($felhasznalonev, $jelszo, $nev)) {
                    // Az adatbázisba mentés sikerült
                    header('location:' . URLROOT . '/admin');
                }
                else {
                    echo "Az adatbázisba mentés nem sikerült.";
                    die;
                }
            }
            else {
                echo "A két jelszó nem egyezik meg.";
                die;
            }
        }
        else {
            $data = [
            ];

            $this->view('admin/adminhozzadas/index', $data);
        }

        $data = [
            //'main' => $this->adminModel->kartyaLekerdezes()
        ];

        $this->view('admin/adminhozzadas/index', $data);
    }

    // Felhasználók törlése
    public function felhasznaloTorles($id){
        if (isLoggedIn()){
            if ( $this->adminModel->felhasznaloTorles($id) ) {
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

    // Versenyek oldal megjelenítése
    public function verseny() {
        
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'verseny' => $this->adminModel->versenyLekerdezes()
        ];

        $this->view('admin/verseny/index', $data);
    }

    // Verseny hozzáadása
    public function versenyhozzaadas() {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                // Feltölés...
                if ( $_FILES['kep']['tmp_name'] ) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);
                    
                    if($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->ujVersenyHozzadasa($_POST, $eredmeny)) {
                            // Az adatbázisba mentés sikerült
                            header('location:' . URLROOT . '/admin/verseny');
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
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [

                ];

                $this->view('admin/versenyhozzaadas/index', $data);
            }  
        }  

        else {
            $data = [
            ];

            $this->view('user/login');
        }    
    }

    // Verseny szerkesztése
    public function versenyszerkesztes($id) {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                $versenynev = trim($_POST['versenynev']);
                $tema = trim($_POST['tema']);
                $idopont = trim($_POST['idopont']);
                $jelentkezesiHatarido = trim($_POST['jelentkezesiHatarido']);
                $leiras = trim($_POST['leiras']);

                // Feltölés...
                if ( $_FILES['kep']['tmp_name'] ) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);
                    
                    if($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->versenySzerkesztese($id, $eredmeny, $versenynev, $tema, $idopont, $jelentkezesiHatarido, $leiras)) {
                            // Az adatbázisba mentés sikerült
                            header('location:' . URLROOT . '/admin/verseny');
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
                else{
                    if ($this->adminModel->versenySzerkesztese($id, false, $versenynev, $tema, $idopont, $jelentkezesiHatarido, $leiras)) {
                        // Az adatbázisba mentés sikerült
                        header('location:' . URLROOT . '/admin/verseny');
                    }
                    else {
                        echo "Az adatbázisba mentés nem sikerült.";
                        die;
                    }
                }
            }
            else {
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [
                    'verseny' => $this->adminModel->verseny($id),
                ];

                $this->view('admin/versenyszerkesztes/index', $data);
            }  
        }  

        else {
            $data = [
            ];

            $this->view('user/login');
        }    
    }

    // Verseny törlése
    public function versenyTorles($id){
        if (isLoggedIn()){
            if ( $this->adminModel->versenyTorles($id) ) {
                // A törlés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin/verseny');
            }
            else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin/verseny');
            }
        }
        else{
            $data = [
            ];
    
            $this->view('user/login');
        }
    }

    // Verseny részletek oldal megjelenítése
    public function adminversenyreszletek($id) {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'Versenyreszletek' => $this->adminModel->egyAdottVersenyReszletei($id),
            'versenyJelentkezok' => $this->adminModel->versenyJelentkezokLekerdezes($id)
        ];

        $this->view('admin/adminversenyreszletek/index', $data);
    }


}



