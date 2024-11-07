<?php
#[AllowDynamicProperties]

class Admin extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('AdminModel');
        $this->filefeltoltesModel = $this->model('FilefeltoltesModel');
    }

    // Az admin oldal megjelenítése
    public function index()
    {

        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->adminModel->emlekezteto();
        }
        
        $data = [
            'main' => $this->adminModel->kartyaLekerdezes()
        ];

        $this->view('admin/index', $data);
        
        
    }

    // Egy adott esemény részleteinek megjelenítése
    public function reszletek($id)
    {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'reszletek' => $this->adminModel->egyAdottEsemenyReszletei($id),
            'jelentkezok' => $this->adminModel->jelentkezokLekerzdezese($id)
        ];

        //Hozzáadás
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

            $esemenyID = (int)trim($_POST['esemenyID']);
            $email = trim($_POST['email']);
            $neve = trim($_POST['neve']);

                if ($this->adminModel->emailHozzadas($esemenyID, $email, $neve)) {
                    // A hozzáadás sikerült, ezért beállítjuk az üzenetet 0-ra
                    header('location:' . URLROOT . '/admin/reszletek/' . $esemenyID . '?msg=0');
                }
                else {
                    // A hozzáadás nem sikerült ezért beállítjuk az üzenetet 1-re
                    header('location:' . URLROOT . '/admin/reszletek/' . $esemenyID . '?msg=1');
                }
            }

        $this->view('admin/reszletek/index', $data);
    }

    // Esemény hozzáadása
    public function hozzaadas()
    {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                // Feltölés...
                if ($_FILES['kep']['tmp_name']) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);

                    if ($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->ujEsemenyHozzadasa($_POST, $eredmeny)) {
                            // Az adatbázisba mentés sikerült
                            header('location:' . URLROOT . '/admin');
                        } else {
                            echo "Az adatbázisba mentés nem sikerült.";
                            die;
                        }
                    } else {
                        echo "A feltöltés nem sikerült.";
                    }
                }
            } else {
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [
                    'terem' => $this->adminModel->terem(),
                    'szak' => $this->adminModel->szak(),
                    'tanarok' => $this->adminModel->tanarok()
                ];

                $this->view('admin/hozzaadas/index', $data);
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Esemény szerkesztése
    public function szerkesztes($id)
    {
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
                if ($_FILES['kep']['tmp_name']) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);

                    if ($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->esemenySzerkesztese($id, $eredmeny, $cim, $leiras, $datum, $tanteremID, $szakID, $tanarID, $tema)) {
                            // Az adatbázisba mentés sikerült
                            header('location:' . URLROOT . '/admin');
                        } else {
                            echo "Az adatbázisba mentés nem sikerült.";
                            die;
                        }
                    } else {
                        echo "A feltöltés nem sikerült.";
                    }
                } else {
                    if ($this->adminModel->esemenySzerkesztese($id, false, $cim, $leiras, $datum, $tanteremID, $szakID, $tanarID, $tema)) {
                        // Az adatbázisba mentés sikerült
                        header('location:' . URLROOT . '/admin');
                    } else {
                        echo "Az adatbázisba mentés nem sikerült.";
                        die;
                    }
                }
            } else {
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [
                    'esemeny' => $this->adminModel->esemeny($id),
                    'terem' => $this->adminModel->terem(),
                    'szak' => $this->adminModel->szak(),
                    'tanarok' => $this->adminModel->tanarok()
                ];

                $this->view('admin/szerkesztes/index', $data);
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Esemény duplikálása
    public function duplikalas($id)
    {
        if (isLoggedIn()) {

            if ($this->adminModel->duplikalasModel($id)) {
                // A duplikálás sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin');
            } else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin');
            }
        } else {
            $data = [];
            $this->view('user/login');
        }
    }

    // Esemény törlése
    public function torles($id)
    {
        if (isLoggedIn()) {
            if ($this->adminModel->torles($id)) {
                // A törlés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin');
            } else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin');
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Admin hozzáadása
    public function adminhozzadas()
    {

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
                } else {
                    echo "Az adatbázisba mentés nem sikerült.";
                    die;
                }
            } else {
                echo "A két jelszó nem egyezik meg.";
                die;
            }
        } else {
            $data = [];

            $this->view('admin/adminhozzadas/index', $data);
        }

        $data = [
            //'main' => $this->adminModel->kartyaLekerdezes()
        ];

        $this->view('admin/adminhozzadas/index', $data);
    }

    // Felhasználók törlése
    public function felhasznaloTorles($esemeny_id, $id)
    {
        if (isLoggedIn()) {
            if ($this->adminModel->felhasznaloTorles($esemeny_id, $id)) {
                // A törlés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin/reszletek/' . $esemeny_id);
            } else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin/reszletek/' . $esemeny_id);
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Felhasználó engedélyezése 
    public function felhasznaloEngedelyezes($esemeny_id, $id)
    {
        if (isLoggedIn()) {
            if ($this->adminModel->felhasznaloEngedelyezes($esemeny_id, $id)) {
                // Az engedélyezés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin/reszletek/' . $esemeny_id);
            } else {
                // Az engedélyezés nem sikerült
                header('location:' . URLROOT . '/admin/reszletek/' . $esemeny_id);
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Felhasználók inportálása
    public function exportToPdf($id)
    {
        // Check if the user is logged in
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
            exit;
        }

        // Fetch users with jelentkezo = 1
        $eligibleUsers = $this->adminModel->getEligibleUsers($id);

        // Check if data exists
        if (!$eligibleUsers) {
            die("Nincsen felhasználó.");
        }

        // Load PDF library (e.g., TCPDF or FPDF)
        require_once APPROOT . '/libraries/tcpdf/tcpdf.php'; // Adjust if using a different library
        $pdf = new TCPDF();

        // Configure PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Megjelent tanulók lista');
        $pdf->SetHeaderData('', 0, 'Megjelent tanulók', '');

        // Add a page
        $pdf->AddPage();

        // Content to display
        $content = "<table><tr><th>Név</th><th>Email</th></tr> <br>"; 

        foreach ($eligibleUsers as $user) {
            $content .= "<tr><td>{$user->neve}</td><td>{$user->email}</td></tr>";
        }
        $content .= "</table>";

        // Output content to PDF
        $pdf->writeHTML($content);

        // Output the PDF as a download
        ob_end_clean();
        ob_start();
        $pdf->Output('megjelentTanulok.pdf', 'D');
    }
 

    // Versenyek oldal megjelenítése
    public function verseny()
    {

        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'verseny' => $this->adminModel->versenyLekerdezes()
        ];

        $this->view('admin/verseny/index', $data);
    }

    // Verseny hozzáadása
    public function versenyhozzaadas()
    {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                // Feltölés...
                if ($_FILES['kep']['tmp_name']) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);

                    if ($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->ujVersenyHozzadasa($_POST, $eredmeny)) {
                            // Az adatbázisba mentés sikerült
                            header('location:' . URLROOT . '/admin/verseny');
                        } else {
                            echo "Az adatbázisba mentés nem sikerült.";
                            die;
                        }
                    } else {
                        echo "A feltöltés nem sikerült.";
                    }
                }
            } else {
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [];

                $this->view('admin/versenyhozzaadas/index', $data);
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Verseny szerkesztése
    public function versenyszerkesztes($id)
    {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                $versenynev = trim($_POST['versenynev']);
                $tema = trim($_POST['tema']); 
                $idopont = trim($_POST['idopont']);
                $jelentkezesiHatarido = trim($_POST['jelentkezesiHatarido']);
                $leiras = trim($_POST['leiras']);

                // Feltölés...
                if ($_FILES['kep']['tmp_name']) {
                    // Feltöltjük a képfájlt a szerverre (public/img mappába), és visszakapjuk a fájl nevét (vagy false-t, ha nem sikerült a feltöltés).
                    $eredmeny = $this->filefeltoltesModel->imgUpload($_FILES['kep']['name']);

                    if ($eredmeny != false) {
                        echo "A feltöltés sikerült, a fájl neve: " . $eredmeny;

                        // Adatbázisba mentés: a FORM összes adata a $_POST tömbben van, a kép neve pedig az $eredmeny változóban.
                        if ($this->adminModel->versenySzerkesztese($id, $eredmeny, $versenynev, $tema, $idopont, $jelentkezesiHatarido, $leiras)) {
                            // Az adatbázisba mentés sikerült
                            header('location:' . URLROOT . '/admin/verseny');
                        } else {
                            echo "Az adatbázisba mentés nem sikerült.";
                            die;
                        }
                    } else {
                        echo "A feltöltés nem sikerült.";
                    }
                } else {
                    if ($this->adminModel->versenySzerkesztese($id, false, $versenynev, $tema, $idopont, $jelentkezesiHatarido, $leiras)) {
                        // Az adatbázisba mentés sikerült
                        header('location:' . URLROOT . '/admin/verseny');
                    } else {
                        echo "Az adatbázisba mentés nem sikerült.";
                        die;
                    }
                }
            } else {
                // Ha nem POST metódussal érkezik a kérés, akkor az admin hozzáadása oldalra irányítjuk a felhasználót.

                $data = [
                    'verseny' => $this->adminModel->verseny($id),
                ];

                $this->view('admin/versenyszerkesztes/index', $data);
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Verseny törlése
    public function versenyTorles($id)
    {
        if (isLoggedIn()) {
            if ($this->adminModel->versenyTorles($id)) {
                // A törlés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin/verseny');
            } else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin/verseny');
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Verseny részletek oldal megjelenítése
    public function adminversenyreszletek($id)
    {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'Versenyreszletek' => $this->adminModel->egyAdottVersenyReszletei($id),
            'versenyJelentkezok56' => $this->adminModel->versenyJelentkezokLekerzdezese56($id),
            'versenyJelentkezok78' => $this->adminModel->versenyJelentkezokLekerzdezese78($id)
        ];

        $this->view('admin/adminversenyreszletek/index', $data);
    }

    // Reveal function
    public function reveal()
    {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim($_POST['jelentkezoID']);
            // Frissítsük az adatbázist
            echo $this->adminModel->revealFunction($id);
        }
    }

    // Pontozás oldal 
    public function pontozas()
    {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }

        $data = [
            'pontozas' => $this->adminModel->versenyJelentkezokLekerdzese()
        ];

        $this->view('admin/pontozas/index', $data);
    }
    

    // Jelentkezők oldal
    public function jelentkezok()
    {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
        }


        $data = [
            'jelentkezok' => $this->adminModel->jelentkezokLekerdezes(),
            'idopontok' => $this->adminModel->idopontokLekerdezes()

        ];

        $this->view('admin/jelentkezok/index', $data);
    }

    // Felhasználó engedélyezése 
    public function felhasznaloEngedelyezese ($id)
    {
        if (isLoggedIn()) {
            if ($this->adminModel->felhasznaloEngedelyezese($id)) {
                // Az engedélyezés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin/jelentkezok/');
            } else {
                // Az engedélyezés nem sikerült
                header('location:' . URLROOT . '/admin/jelentkezok/');
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    // Felhasználók törlése
    public function felhasznaloTorlese($id)
    {
        if (isLoggedIn()) {
            if ($this->adminModel->felhasznaloTorlese($id)) {
                // A törlés sikerült, átirányítjuk a felhasználót az adminfőoldalra
                header('location:' . URLROOT . '/admin/jelentkezok/');
            } else {
                // A törlés nem sikerült
                header('location:' . URLROOT . '/admin/jelentkezok/');
            }
        } else {
            $data = [];

            $this->view('user/login');
        }
    }

    public function exportPDF()
    {
        // Check if the user is logged in
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/user/login');
            exit;
        }

        // Fetch users with jelentkezo = 1
        $eligibleUsers = $this->adminModel->engedelyezettFelhasznalok();

        // Check if data exists
        if (!$eligibleUsers) {
            die("Nincsen felhasználó.");
        }

        // Load PDF library (e.g., TCPDF or FPDF)
        require_once APPROOT . '/libraries/tcpdf/tcpdf.php'; // Adjust if using a different library
        $pdf = new TCPDF();

        // Configure PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Megjelent tanulók lista');
        $pdf->SetHeaderData('', 0, 'Megjelent tanulók', '');

        // Add a page
        $pdf->AddPage();

        // Content to display
        $content = "<table><tr><th>Név</th><th>Email</th></tr> <br>"; 

        foreach ($eligibleUsers as $user) {
            $content .= "<tr><td>{$user->neve}</td><td>{$user->email}</td></tr>";
        }
        $content .= "</table>";

        // Output content to PDF
        $pdf->writeHTML($content);

        // Output the PDF as a download
        ob_end_clean();
        ob_start();
        $pdf->Output('megjelentTanulok.pdf', 'D');
    }


     /* AJAX híváskor betölti a talált termékek listáját */
     public function termekekkeresese() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $keresendo = $_POST['keresendo'];

        $termekek = $this->adminModel->termekekKeresese($keresendo);
        
        $data = [
            'termekek' => $termekek,
            'idopontok' => $this->adminModel->idopontokLekerdezes(),
        ];

        $this->view('admin/jelentkezok/termekek', $data);
    }
}
