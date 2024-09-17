<?php

class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function kartyaLekerdezes() {
        $this->db->query('SELECT *, esemenyek.id AS "esemeny_id" FROM esemenyek INNER JOIN users ON esemenyek.tanarID = users.id WHERE esemenyek.torolt = 0');
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