<?php

class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function kartyaLekerdezes() {
        $this->db->query('SELECT *, esemenyek.id AS "esemeny_id" FROM esemenyek INNER JOIN users ON esemenyek.tanarID = users.id WHERE esemenyek.torolt = 0 AND users.id = :id');
        $this->db->bind(':id', $_SESSION['user_id']);
        $results = $this->db->resultSet();
        
        return $results;
    }

    public function tanarok() {
        $this->db->query('SELECT id,nev FROM users WHERE torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

    public function terem() {
        $this->db->query('SELECT * FROM tanterem WHERE torolt = 0');
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

    // Új esemény hozzáadása
    public function ujEsemenyHozzadasa($data, $kep) {
        $this->db->query('INSERT INTO esemenyek (kep, cim, leiras, datum, tanteremID, tanarID) VALUES (:kep, :cim, :leiras, :datum, :tanteremID, :tanarID)');
        $this->db->bind(':kep', $kep);
        $this->db->bind(':cim', $data['cim']);
        $this->db->bind(':leiras', $data['leiras']);
        $this->db->bind(':datum', $data['datum']);
        $this->db->bind(':tanteremID', $data['terem']);
        $this->db->bind(':tanarID', $_SESSION['user_id']);
        
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function esemenySzerkesztese($id, $kep, $cim, $leiras, $datum, $tanteremID) {
        $this->db->query('UPDATE esemenyek SET kep = :kep, cim = :cim, leiras = :leiras, datum = :datum, tanteremID = :tanteremID WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':kep', $kep);
        $this->db->bind(':cim', $cim);
        $this->db->bind(':leiras', $leiras);
        $this->db->bind(':datum', $datum);
        $this->db->bind(':tanteremID', $tanteremID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function torles($id) {
        $this->db->query('UPDATE esemenyek SET torolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}