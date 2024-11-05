<?php

class MainModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Főoldal adatainak lekérdezése
    public function kartyaLekerdezes()
    {
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
                jelentkezok_vt j ON e.id = j.esemenyID AND j.torolt = 0 AND j.visszaigazolt = 1
            WHERE
                e.torolt = 0
            GROUP BY
                e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely
            '
        );

        $results = $this->db->resultSet();

        return $results;
    }

    // Időpontok lekérdezése
    public function idopontokLekerdezesNap()
    {
        $this->db->query('SELECT DATE(datum) AS datum FROM esemenyek WHERE torolt = 0 group by datum');
        $results = $this->db->resultSet();

        return $results;
    }

    public function idopontokLekerdezesOra()
    {
        $this->db->query('SELECT TIME(datum) AS datum FROM esemenyek WHERE torolt = 0 group by datum');
        $results = $this->db->resultSet();

        return $results;
    }

    // Szakok lekérdezése
    public function szakokLekerdezes()
    {
        $this->db->query('SELECT id, neve FROM szakok');
        $results = $this->db->resultSet();

        return $results;
    }

    // Oktatók lekérdezése
    public function oktatokLekerdezes()
    {
        $this->db->query('SELECT DISTINCT users.nev FROM users INNER JOIN esemenyek ON esemenyek.tanarID = users.id AND esemenyek.torolt = 0;');
        $results = $this->db->resultSet();

        return $results;
    }

    // Tantermek lekérdezése
    public function teremLekerdezes()
    {
        $this->db->query('SELECT DISTINCT tanterem.neve FROM tanterem INNER JOIN esemenyek ON esemenyek.tanteremID = tanterem.id AND tanterem.torolt = 0;');
        $results = $this->db->resultSet();

        return $results;
    }

    /* Ékezetek helyett '_' jel */
    private function replaceHungarianAccents($string)
    {
        // A HTML entitások visszacserélése ékezetekre
        $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');

        // A magyar ékezetek cseréje '_'-re, hogy az ékezetmentes keresés is működjön
        $accents = ['á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ö', 'Ö', 'ő', 'Ő', 'ú', 'Ú', 'ü', 'Ü', 'ű', 'Ű'];
        $replacement = '_';

        return str_replace($accents, $replacement, $string);
    }

    /* Az adott szórészletet tartalmazó termékek lekérdezése */
    public function termekekKeresese($keresendo)
    {
        $keresendo = $this->replaceHungarianAccents($keresendo);

        $this->db->query(
            "SELECT
           e.tema, e.cim, e.leiras, e.kep, e.datum, e.id AS 'esemeny_id', s.neve,
            u.nev, t.neve, t.ferohely, count(j.email) as 'jelentkezok'
        FROM
            esemenyek e
        INNER JOIN
            users u ON e.tanarID = u.id
        INNER JOIN
            tanterem t ON e.tanteremID = t.id
        LEFT JOIN
            jelentkezok j ON e.id = j.esemenyID AND j.torolt = 0
        INNER JOIN
            szakok s ON e.szakID = s.id
        WHERE
            e.torolt = 0
            AND (e.cim LIKE :keresendo OR e.leiras LIKE :keresendo OR u.nev LIKE :keresendo)
        GROUP BY
            e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely;     
        "
        );

        $this->db->bind(':keresendo', "%$keresendo%");
        return $this->db->resultSet();
    }

    // Termékek szűrése
    public function termekekSzurese($szuroObj)
    {
        $this->db->query(
            "SELECT 
                   e.tema, e.cim, e.leiras, e.kep, e.datum, e.id AS 'esemeny_id', s.neve,
                    u.nev, t.neve, t.ferohely, count(j.email) as 'jelentkezok' 
                FROM 
                    esemenyek e 
                INNER JOIN 
                    users u ON e.tanarID = u.id 
                INNER JOIN 
                    tanterem t ON e.tanteremID = t.id
                INNER JOIN
                    szakok s ON e.szakID = s.id
                LEFT JOIN 
                    jelentkezok j ON e.id = j.esemenyID AND j.torolt = 0
                WHERE 
                    e.torolt = 0 
                    AND (:szak = '' OR s.id = :szak)
                    AND (:tanar = '' OR u.id = :tanar)
                    AND (:terem = '' OR t.id = :terem)
                    AND (:nap IS NULL OR DATE(e.datum) = :nap)
                    AND (:ora = '' OR TIME_FORMAT(e.datum, '%H:%i') >= :ora)
                GROUP BY 
                    e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely;
            "
        );

        $this->db->bind(':nap', empty($szuroObj['nap']) ? null : $szuroObj['nap']);
        $this->db->bind(':ora', $szuroObj['ora']);
        $this->db->bind(':tanar', $szuroObj['oktatok']);
        $this->db->bind(':szak', $szuroObj['szak']);
        $this->db->bind(':terem', $szuroObj['termek']);
        return $this->db->resultSet();
    }
}
