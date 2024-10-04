<?php
#[AllowDynamicProperties]

class Main extends Controller {
    public function __construct() {
        $this->mainModel = $this->model('MainModel');
    }

    // A főoldal megjelenítése
    public function index() {

        $data = [
            'main' => $this->mainModel->kartyaLekerdezes(),
            'idopontokNap' => $this->mainModel->idopontokLekerdezesNap(),
            'idopontokOra' => $this->mainModel->idopontokLekerdezesOra(),
            'szak' => $this->mainModel->szakokLekerdezes(),
            'oktatok' => $this->mainModel->oktatokLekerdezes(),
            'termek' => $this->mainModel->teremLekerdezes()
        ];

        $this->view('main/index', $data);
    }

    /* AJAX híváskor betölti a talált termékek listáját */
    public function termekekkeresese() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $keresendo = $_POST['keresendo'];

        $termekek = $this->mainModel->termekekKeresese($keresendo);
        
        $data = [
            'termekek' => $termekek
        ];

        $this->view('main/termekek', $data);
    }

    public function termekekszurese() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $keresendo = $_POST['keresendo'];
        // $szuro = $_POST['szuro'];
        // $szuroObj = json_decode($_POST['szuroObj']);

        $termekek = $this->mainModel->termekekSzurese($_POST['szuroObj']);
        // $termekek = $this->mainModel->termekekSzurese($keresendo, $szuro);
        
        $data = [
            'termekek' => $termekek
        ];

        $this->view('main/termekek', $data);
    }
}
