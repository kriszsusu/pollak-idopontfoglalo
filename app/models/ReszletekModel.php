<?php

class ReszletekModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id) {
        $this->db->query('SELECT *, esemenyek.id AS "esemeny_id" FROM esemenyek INNER JOIN users ON esemenyek.tanarID = users.id INNER JOIN tanterem ON esemenyek.tanteremID = tanterem.id WHERE esemenyek.id = :id AND esemenyek.torolt = 0');
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        
        return $results;
    }

}