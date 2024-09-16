<?php

class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function kartyaLekerdezes() {
        $this->db->query('SELECT *, esemenyek.id AS "esemeny_id" FROM esemenyek INNER JOIN users ON esemenyek.tanarID = users.id WHERE users.torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Új esemény hozzáadása
    public function ujEsemenyHozzadasa($data, $kep) {
        $this->db->query('INSERT INTO esemenyek (kep, cim, leiras, datum, tanar, terem) VALUES (:kep, :cim, :leiras, :datum, :tanar, :terem)');
        $this->db->bind(':kep', $kep);
        $this->db->bind(':cim', $data['cim']);
        $this->db->bind(':leiras', $data['leiras']);
        $this->db->bind(':datum', $data['datum']);
        $this->db->bind(':tanar', $data['tanar']);
        $this->db->bind(':terem', $data['terem']);
        
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}