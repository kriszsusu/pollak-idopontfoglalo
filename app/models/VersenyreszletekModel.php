<?php

class VersenyreszletekModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id) {
        $this->db->query('SELECT e.tema, e.versenynev, e.idopont, e.id AS "esemeny_id", count(j.email) as "jelentkezok"
                          FROM versenyek e
                          LEFT JOIN versenyjelentkezok j ON e.id = j.versenyID
                          WHERE e.id = :id AND e.torolt = 0'
                        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        
        return $results;
    }
    
    //Tiltott email ellenőrzés
    public function emailHozzadas($versenyID, $email, $tanuloNeve){

        //Tiltott email ellenőrzés
        $emailprovider = explode("@", $email)[1];
        $this->db->query('SELECT email from tiltottemail where email = :emailprovider');
        $this->db->bind(':emailprovider', $emailprovider);
        $tiltasrow = $this->db->resultSet();

        if (count($tiltasrow) > 0) {
            return false;
        }

        $this->db->query('SELECT tanuloNeve from tiltottnevek where tanuloNeve like :tiltottnev');
        $this->db->bind(':tiltottnev', "%$tanuloNeve%");
        $tiltott = $this->db->resultSet();

        if (count($tiltott) > 0) {
            return false;
        }
        
        // Kis segítség a validáláshoz
        // Lekérdezzük, hogy az adott email cím már szerepel-e az adatbázisban
        // Ha igen, akkor nem engedjük hozzáadni
        // Ha nem, akkor hozzáadjuk
        $this->db->query('SELECT * FROM versenyjelentkezok WHERE email = :email AND versenyID = :versenyID');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $versenyID);

        $row = $this->db->resultSet();

        if (count($row) > 0) {
            return false;
        }

        $this->db->query('INSERT INTO versenyjelentkezok (versenyID, email, tanuloNeve) VALUES (:versenyID, :email, :tanuloNeve)');
        $this->db->bind(':esemenyID', $versenyID);
        $this->db->bind(':email', $email);
        $this->db->bind(':neve', $tanuloNeve);


        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

}