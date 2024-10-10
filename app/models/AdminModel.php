<?php

class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Kártyák lekérdezése
    public function kartyaLekerdezes() {
        $this->db->query(
            'SELECT
                e.tema, e.cim, e.leiras, e.kep, e.datum, e.id AS "esemeny_id", s.neve,
                u.nev, t.neve, t.ferohely, count(j.email) as "jelentkezok"
            FROM
                esemenyek e
            INNER JOIN
                users u ON e.tanarID = u.id
            INNER JOIN
                tanterem t ON e.tanteremID = t.id
            INNER JOIN
                szakok s ON e.szakID = s.id
            LEFT JOIN
                jelentkezok j ON e.id = j.esemenyID
            WHERE
                e.torolt = 0
            GROUP BY
                e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely
            ');

        $results = $this->db->resultSet();
        
        return $results;
    }

    // Tanárok lekérdezése
    public function tanarok() {
        $this->db->query('SELECT id, nev FROM users WHERE torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Tanterem lekérdezése
    public function terem() {
        $this->db->query('SELECT * FROM tanterem WHERE torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Szak lekérdezése
    public function szak() {
        $this->db->query('SELECT * FROM szakok');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Esemény lekérdezése id alapján
    public function esemeny($id) {
        $this->db->query('SELECT * FROM esemenyek WHERE id = :id AND torolt = 0');
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        
        return $result;
    }

    // Jelentkezők lekérdezése
    public function jelentkezokLekerzdezese($id) {
        $this->db->query('SELECT j.email, j.neve FROM jelentkezok j INNER JOIN esemenyek e ON j.esemenyID = e.id WHERE e.torolt = 0 AND e.id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id) {
        $this->db->query('SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS "esemeny_id", u.nev, t.neve, t.ferohely, count(j.email) as "jelentkezok"
                          FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          INNER JOIN szakok s ON e.szakID = s.id
                          LEFT JOIN jelentkezok j ON e.id = j.esemenyID
                          WHERE e.id = :id AND e.torolt = 0'
                        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        
        return $results;
    }

    // Új esemény hozzáadása
    public function ujEsemenyHozzadasa($data, $kep) {
        $this->db->query('INSERT INTO esemenyek (kep, cim, leiras, datum, tanteremID, tanarID, szakID, tema) VALUES (:kep, :cim, :leiras, :datum, :tanteremID, :tanarID, :szakID, :tema)');
        $this->db->bind(':kep', $kep);
        $this->db->bind(':cim', $data['cim']);
        $this->db->bind(':leiras', $data['leiras']);
        $this->db->bind(':datum', $data['datum']);
        $this->db->bind(':tanteremID', $data['terem']);
        $this->db->bind(':szakID', $data['szak']);
        $this->db->bind(':tanarID',  $data['tanar']);
        $this->db->bind(':tema', $data['tema']);
        
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    // Esemény szerkesztése
    public function esemenySzerkesztese($id, $kep, $cim, $leiras, $datum, $tanteremID, $szakID, $tanarID, $tema) {
        if ($kep) {
            $this->db->query('UPDATE esemenyek SET kep = :kep, cim = :cim, leiras = :leiras, datum = :datum, tanteremID = :tanteremID, szakID = :szakID, tanarID = :tanar, tema = :tema  WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':kep', $kep);
            $this->db->bind(':cim', $cim);
            $this->db->bind(':leiras', $leiras);
            $this->db->bind(':datum', $datum);
            $this->db->bind(':tanteremID', $tanteremID);
            $this->db->bind(':szakID', $szakID);
            $this->db->bind(':tanar', $tanarID);
            $this->db->bind(':tema', $tema);
        }
        else{
            $this->db->query('UPDATE esemenyek SET cim = :cim, leiras = :leiras, datum = :datum, tanteremID = :tanteremID, szakID = :szakID, tanarID = :tanar, tema = :tema WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':cim', $cim);
            $this->db->bind(':leiras', $leiras);
            $this->db->bind(':datum', $datum);
            $this->db->bind(':tanteremID', $tanteremID);
            $this->db->bind(':szakID', $szakID);
            $this->db->bind(':tanar', $tanarID);
            $this->db->bind(':tema', $tema);
        }
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Esemény törlése
    public function torles($id) {
        $this->db->query('UPDATE esemenyek SET torolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Admin hozzáadása
    public function adminHozzadas($felhasznalonev, $jelszo, $nev) {
        $this->db->query('INSERT INTO users (felhasznalonev, nev, jelszo) VALUES (:felhasznalonev, :nev, :jelszo)');
        $this->db->bind(':felhasznalonev', $felhasznalonev);
        $this->db->bind(':nev', $nev);
        $this->db->bind(':jelszo', password_hash($jelszo, PASSWORD_BCRYPT));
        
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    // esemény duplikálása
    public function duplikalasModel($id) {
        $this->db->query('SELECT * FROM esemenyek WHERE id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        // Check if a duplicate already exists
        $this->db->query('SELECT COUNT(*) as count FROM esemenyek WHERE kep = :kep AND cim = :cim AND datum = :datum AND torolt = 0');
        $this->db->bind(':kep', $result->kep);
        $this->db->bind(':cim', $result->cim);
        $this->db->bind(':datum', $result->datum);
        $count = $this->db->single()->count;

        // If the event already exists, do not insert
        if ($count > 1) {
            return false; // 2 Duplicates found
        }

        $this->db->query('INSERT INTO esemenyek (kep, cim, leiras, datum, tanteremID, tanarID, szakID, tema) VALUES (:kep, :cim, :leiras, :datum, :tanteremID, :tanarID, :szakID, :tema)');
        $this->db->bind(':kep', $result->kep);
        $this->db->bind(':cim', $result->cim);
        $this->db->bind(':leiras', $result->leiras);
        $this->db->bind(':datum', $result->datum);
        $this->db->bind(':tanteremID', $result->tanteremID);
        $this->db->bind(':szakID', $result->szakID);
        $this->db->bind(':tanarID', $result->tanarID);
        $this->db->bind(':tema', $result->tema);
        
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}