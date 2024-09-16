<?php

class ReszletekModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id) {
        $this->db->query('SELECT * FROM esemenyek WHERE id = :id AND torolt = 0');
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        
        return $results;
    }

}