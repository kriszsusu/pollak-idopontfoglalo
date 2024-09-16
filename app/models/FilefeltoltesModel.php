<?php

class FilefeltoltesModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // A megadott fájlnévből készít egyedi fájlnevet
    private function generateUniqueFileName($originalFilename) {
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        $uniqueFilename = uniqid() . '.' . $extension;    

        return $uniqueFilename;
    }

    public function imgUpload($file) {
        // A fájl nevét kicserljük egyedi névre
        $filenev = $this->generateUniqueFileName($file);

        if ( !file_exists($filenev) ) {
            $forras = $_FILES['kep']['tmp_name'];
            $cel = APPROOT . '/../public/img/' . $filenev;

            if ( move_uploaded_file($forras, $cel) ) {
                return $filenev;
            }
            else {
                return false;
            }
        }
        else {
            echo "Már van ilyen névvel fájl feltöltve.";
            return false;
        }
    }
}