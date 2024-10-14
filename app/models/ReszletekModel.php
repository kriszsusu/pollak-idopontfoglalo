<?php

class ReszletekModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id) {
        $this->db->query('SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS "esemeny_id", u.nev, t.neve, t.ferohely, count(j.email) as "jelentkezok"
                          FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          LEFT JOIN jelentkezok j ON e.id = j.esemenyID
                          WHERE e.id = :id AND e.torolt = 0'
                        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        
        return $results;
    }
    
    //Tiltott email ellenőrzés
    public function emailHozzadas($esemenyID, $email, $neve){

        //Tiltott email ellenőrzés
        $emailprovider = explode("@", $email)[1];
        $this->db->query('SELECT email from tiltottemail where email = :emailprovider');
        $this->db->bind(':emailprovider', $emailprovider);
        $tiltasrow = $this->db->resultSet();

        if (count($tiltasrow) > 0) {
            return false;
        }

        $this->db->query('SELECT nev from tiltottnevek where nev = :tiltottnev');
        $this->db->bind(':tiltottnev', "%$neve%");
        $tiltott = $this->db->resultSet();

        if (count($tiltott) > 0) {
            return false;
        }
        
        // Kis segítség a validáláshoz
        // Lekérdezzük, hogy az adott email cím már szerepel-e az adatbázisban
        // Ha igen, akkor nem engedjük hozzáadni
        // Ha nem, akkor hozzáadjuk
        $this->db->query('SELECT * FROM jelentkezok WHERE email = :email AND esemenyID = :esemenyID');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $esemenyID);

        $row = $this->db->resultSet();

        if (count($row) > 0) {
            return false;
        }

        $this->db->query('INSERT INTO jelentkezok (esemenyID, email, neve) VALUES (:esemenyID, :email, :neve)');
        $this->db->bind(':esemenyID', $esemenyID);
        $this->db->bind(':email', $email);
        $this->db->bind(':neve', $neve);


        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

}