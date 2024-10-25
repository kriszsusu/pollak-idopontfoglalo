<?php

class VersenyreszletekModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id)
    {
        $this->db->query(
            'SELECT e.tema, e.leiras, e.versenynev,e.jelentkezesiHatarido, e.kep ,e.idopont, e.id AS "esemeny_id", count(j.email) as "jelentkezok"
                          FROM versenyek e
                          LEFT JOIN versenyjelentkezok j ON e.id = j.versenyID
                          WHERE e.id = :id AND e.torolt = 0'
        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();

        return $results;
    }

    public function iskolakLekerdezes()
    {
        $this->db->query('SELECT id, nev FROM iskolak');
        $results = $this->db->resultSet();

        return $results;
    }

    public function evfolyamLekerdezes()
    {
        $this->db->query('SELECT id, nev FROM evfolyam');
        $results = $this->db->resultSet();

        return $results;
    }

    // Versenyjelentkezők lekérdezése
    public function versenyJelentkezokLekerzdezese56($id)
    {
        $this->db->query('SELECT j.tanuloNeve , j.id as "jelentkezoID", j.kod, j.pontszam, j.latszodik
                            FROM versenyjelentkezok j
                            INNER JOIN versenyek e ON j.versenyID = e.id
                            INNER JOIN evfolyam ev ON j.evfolyamID = ev.id
                            WHERE j.torolt = 0 AND e.id = :id AND (ev.id = 1 OR ev.id = 2) 
                            ORDER BY j.pontszam DESC');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        return $results;
    }
    public function versenyJelentkezokLekerzdezese78($id)
    {
        $this->db->query('SELECT j.tanuloNeve , j.id as "jelentkezoID", j.kod, j.pontszam, j.latszodik
                            FROM versenyjelentkezok j
                            INNER JOIN versenyek e ON j.versenyID = e.id
                            INNER JOIN evfolyam ev ON j.evfolyamID = ev.id
                            WHERE j.torolt = 0 AND e.id = :id AND (ev.id = 3 OR ev.id = 4) 
                            ORDER BY j.pontszam DESC');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        return $results;
    }

    //Tiltott email ellenőrzés
    public function emailHozzadas($versenyID, $email, $tanarNeve, $tanuloNeve, $iskola, $evfolyam)
    {

        //Tiltott email ellenőrzés
        $emailprovider = explode("@", $email)[1];
        $this->db->query('SELECT email from tiltottemail where email = :emailprovider');
        $this->db->bind(':emailprovider', $emailprovider);
        $tiltasrow = $this->db->resultSet();

        if (count($tiltasrow) > 0) {
            return false;
        }

        $this->db->query('SELECT nev from tiltottnevek where nev like :tiltottnev');
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
        $this->db->bind(':versenyID', $versenyID);

        $row = $this->db->resultSet();

        if (count($row) > 0) {
            return false;
        }

        // Ha az iskola változó szöveg, akkor azt hozzáadjuk az iskolak táblához
        if (!is_numeric($iskola)) {
            $this->db->query('INSERT INTO iskolak (nev) VALUES (:iskolaNeve)');
            $this->db->bind(':iskolaNeve', $iskola);
            $this->db->execute();
            $this->db->query('SELECT id FROM iskolak WHERE nev = :iskolaNeve');
            $this->db->bind(':iskolaNeve', $iskola);
            $results = $this->db->single();
            $iskola = $results->id;
        }


        $this->db->query('INSERT INTO versenyjelentkezok (versenyID, email, tanarNeve, tanuloNeve, iskolaID, evfolyamID) VALUES (:versenyID, :email, :tanarNeve, :tanuloNeve, :iskolaID, :evfolyamID)');
        $this->db->bind(':versenyID', $versenyID);
        $this->db->bind(':email', $email);
        $this->db->bind(':tanuloNeve', $tanuloNeve);
        $this->db->bind(':tanarNeve', $tanarNeve);
        $this->db->bind(':iskolaID', $iskola);
        $this->db->bind(':evfolyamID', $evfolyam);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
