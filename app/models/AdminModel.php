<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPROOT .  '/helpers/phpmailer/PHPMailer.php';
require APPROOT .  '/helpers/phpmailer/Exception.php';
require APPROOT .  '/helpers/phpmailer/SMTP.php';

class AdminModel
{
    private $db;
    private $mailer;

    public function __construct()
    {
        $this->db = new Database;
        $this->mailer = new PHPMailer();

        // Initial setup of PHPMailer
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->IsSMTP();
        $this->mailer->Host = "smtp-mail.outlook.com";
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;

        $this->mailer->Username = EMAIL_USER;
        $this->mailer->Password = EMAIL_PASS;

        $this->mailer->From = EMAIL_ADDRESS;
        $this->mailer->FromName = 'HSZC Pollák Antal Technikum';

        $this->mailer->WordWrap = 80;
        $this->mailer->IsHTML(true);
    }

    // Kártyák lekérdezése
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
                jelentkezok j ON e.id = j.esemenyID AND j.torolt = 0 AND j.visszaigazolt = 1
            WHERE
                e.torolt = 0
            GROUP BY
                e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely
            '
        );

        $results = $this->db->resultSet();

        return $results;
    }

    // Tanárok lekérdezése
    public function tanarok()
    {
        $this->db->query('SELECT id, nev FROM users WHERE torolt = 0');
        $results = $this->db->resultSet();

        return $results;
    }

    // Tanterem lekérdezése
    public function terem()
    {
        $this->db->query('SELECT * FROM tanterem WHERE torolt = 0');
        $results = $this->db->resultSet();

        return $results;
    }

    // Szak lekérdezése
    public function szak()
    {
        $this->db->query('SELECT * FROM szakok');
        $results = $this->db->resultSet();

        return $results;
    }

    // Esemény lekérdezése id alapján
    public function esemeny($id)
    {
        $this->db->query('SELECT * FROM esemenyek WHERE id = :id AND torolt = 0');
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        return $result;
    }

    // Jelentkezők lekérdezése
    public function jelentkezokLekerzdezese($id)
    {
        $this->db->query('SELECT j.email, j.neve, j.megjelent, j.id as "jelentkezoID" FROM jelentkezok_vt j INNER JOIN esemenyek e ON j.esemenyID = e.id WHERE j.torolt = 0 AND e.id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        return $results;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id)
    {
        $this->db->query(
            'SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS "esemeny_id", u.nev, t.neve, t.ferohely, count(j.email) as "jelentkezok"
                          FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          INNER JOIN szakok s ON e.szakID = s.id
                          LEFT JOIN jelentkezok_vt j ON e.id = j.esemenyID AND j.torolt = 0 AND j.visszaigazolt = 1
                          WHERE e.id = :id AND e.torolt = 0'
        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();

        return $results;
    }

    // Új esemény hozzáadása
    public function ujEsemenyHozzadasa($data, $kep)
    {
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
        } else {
            return false;
        }
    }

    // Esemény szerkesztése
    public function esemenySzerkesztese($id, $kep, $cim, $leiras, $datum, $tanteremID, $szakID, $tanarID, $tema)
    {
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
        } else {
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
    public function torles($id)
    {
        $this->db->query('UPDATE esemenyek SET torolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Felhasználó törölése
    public function felhasznaloTorles($esemeny_id, $id)
    {
        $this->db->query('UPDATE jelentkezok SET torolt = 1 WHERE id = :id AND esemenyID = :esemeny_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':esemeny_id', $esemeny_id);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Felhasználó engedélyezése
    public function felhasznaloEngedelyezes($esemeny_id, $id)
    {
        $this->db->query('UPDATE jelentkezok SET megjelent = 1 WHERE id = :id AND esemenyID = :esemeny_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':esemeny_id', $esemeny_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Felhasználók lekérdezése
    public function getEligibleUsers($id)
    {
        $this->db->query("SELECT neve, email FROM jelentkezok_vt WHERE megjelent = 1 AND torolt = 0 AND esemenyID = :id");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    // esemény duplikálása
    public function duplikalasModel($id)
    {
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
        } else {
            return false;
        }
    }

    // Admin hozzáadása
    public function adminHozzadas($felhasznalonev, $jelszo, $nev)
    {
        $this->db->query('INSERT INTO users (felhasznalonev, nev, jelszo) VALUES (:felhasznalonev, :nev, :jelszo)');
        $this->db->bind(':felhasznalonev', $felhasznalonev);
        $this->db->bind(':nev', $nev);
        $this->db->bind(':jelszo', password_hash($jelszo, PASSWORD_BCRYPT));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Tiltott email ellenőrzés
    public function emailHozzadas($esemenyID, $email, $neve)
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
        $this->db->bind(':tiltottnev', "%$neve%");
        $tiltott = $this->db->resultSet();

        if (count($tiltott) > 0) {
            return false;
        }

        // Lekérdezzük, hogy az adott email cím már szerepel-e az adatbázisban
        // Ha igen, akkor nem engedjük hozzáadni
        // Ha nem, akkor hozzáadjuk
        $this->db->query('SELECT * FROM jelentkezok_vt WHERE email = :email AND esemenyID = :esemenyID AND torolt = 0');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $esemenyID);

        $row = $this->db->resultSet();

        if (count($row) > 0) {
            return false;
        }

        $this->db->query('INSERT INTO jelentkezok (esemenyID, email, neve, visszaigazolt) VALUES (:esemenyID, :email, :neve, 1)');
        $this->db->bind(':esemenyID', $esemenyID);
        $this->db->bind(':email', $email);
        $this->db->bind(':neve', $neve);
        $this->db->execute();

        $this->db->query('SELECT id, neve, email FROM jelentkezok_vt WHERE email = :email AND esemenyID = :esemenyID AND torolt = 0');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $esemenyID);

        $jelentkezo = $this->db->single();

        $this->db->query('SELECT e.cim, e.datum, e.tema, e.leiras, u.nev AS "tanar_neve", t.neve AS "tanterem_neve" FROM esemenyek e
                            INNER JOIN users u ON e.tanarID = u.id
                            INNER JOIN tanterem t ON e.tanteremID = t.id
                            WHERE e.id = :esemenyID');
        $this->db->bind(':esemenyID', $esemenyID);
        $esemenyAdatok = $this->db->single();

        $subject = $esemenyAdatok->cim . ' - Jelentkezés megerősítve';
        $body = 'Kedves ' . $jelentkezo->neve . '!<br><br>
                Köszönjük, hogy érdeklődik az alábbi esemény iránt:<br><br>
                <b>Cím:</b> ' . $esemenyAdatok->cim . '<br>
                <b>Téma:</b> ' . $esemenyAdatok->tema . '<br>
                <b>Időpont:</b> ' . $esemenyAdatok->datum . '<br>
                <b>Oktató:</b> ' . $esemenyAdatok->tanar_neve . '<br>
                <b>Helyszín:</b> ' . $esemenyAdatok->tanterem_neve . ' tanterem<br>
                <b>Leírás:</b> ' . $esemenyAdatok->leiras . '<br><br>
                Az alábbi linkre kattintva törölheti a jelentkezését:<br><br><a href="' . URLROOT . '/reszletek/jelentkezesTorles/' . $esemenyAdatok->id . '">Jelentkezés törlése</a>
                <br><br>Üdvözlettel,<br>HSZC Pollák Antal Technikum!';

        $this->sendEmail($jelentkezo->email, $jelentkezo->neve, $subject, $body);

        return $jelentkezo->esemenyID;

        if ($jelentkezo->id) {
            return true;
        } else {
            return false;
        }
    }

    private function sendEmail($toAddress, $toName, $subject, $body)
    {
        $this->mailer->AddAddress($toAddress, $toName);

        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;

        if (!$this->mailer->Send()) {
            echo 'A levél nem került elküldésre';
            echo 'A felmerült hiba: ' . $this->mailer->ErrorInfo;
            exit;
        }
    }

    // Verseny lekérdezése
    public function versenyLekerdezes()
    {
        $this->db->query('SELECT * FROM versenyek WHERE torolt = 0');
        $results = $this->db->resultSet();

        return $results;
    }

    // Verseny lekérdezése id alapján
    public function verseny($id)
    {
        $this->db->query('SELECT * FROM versenyek WHERE id = :id AND torolt = 0');
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        return $result;
    }

    // Verseny hozzáadása
    public function ujVersenyHozzadasa($data, $kep)
    {
        $this->db->query('INSERT INTO versenyek (kep, versenynev, tema, idopont, jelentkezesiHatarido, leiras) VALUES (:kep, :versenynev, :tema, :idopont, :jelentkezesiHatarido, :leiras)');
        $this->db->bind(':kep', $kep);
        $this->db->bind(':versenynev', $data['versenynev']);
        $this->db->bind(':tema', $data['tema']);
        $this->db->bind(':idopont', $data['idopont']);
        $this->db->bind(':jelentkezesiHatarido', $data['jelentkezesiHatarido']);
        $this->db->bind(':leiras', $data['leiras']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Verseny szerkesztése
    public function versenySzerkesztese($id, $kep, $versenynev, $tema, $idopont, $jelentkezesiHatarido, $leiras)
    {
        if ($kep) {
            $this->db->query('UPDATE versenyek SET kep = :kep, versenynev = :versenynev, tema = :tema, idopont = :idopont, jelentkezesiHatarido = :jelentkezesiHatarido, leiras = :leiras WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':kep', $kep);
            $this->db->bind(':versenynev', $versenynev);
            $this->db->bind(':tema', $tema);
            $this->db->bind(':idopont', $idopont);
            $this->db->bind(':jelentkezesiHatarido', $jelentkezesiHatarido);
            $this->db->bind(':leiras', $leiras);
        } else {
            $this->db->query('UPDATE versenyek SET versenynev = :versenynev, tema = :tema, idopont = :idopont, jelentkezesiHatarido = :jelentkezesiHatarido, leiras = :leiras WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':versenynev', $versenynev);
            $this->db->bind(':tema', $tema);
            $this->db->bind(':idopont', $idopont);
            $this->db->bind(':jelentkezesiHatarido', $jelentkezesiHatarido);
            $this->db->bind(':leiras', $leiras);
        }

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Verseny törlése
    public function versenyTorles($id)
    {
        $this->db->query('UPDATE versenyek SET torolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottVersenyReszletei($id)
    {
        $this->db->query(
            'SELECT e.tema, e.leiras, e.versenynev, e.idopont, e.jelentkezesiHatarido, e.kep, e.id AS "esemeny_id", count(j.email) as "jelentkezok"
                          FROM versenyek e
                          LEFT JOIN versenyjelentkezok j ON e.id = j.versenyID
                          WHERE e.id = :id AND e.torolt = 0'
        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();

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

    // Reveal 
    public function revealFunction($id)
    {
        $this->db->query('UPDATE versenyjelentkezok SET latszodik = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Verseny jelentkezők lekérdezése
    public function versenyJelentkezokLekerdzese()
    {
        $this->db->query('SELECT id, kod, tanuloNeve, email, tanuloNeve, pontszam FROM versenyjelentkezok WHERE torolt = 0 ');
        $results = $this->db->resultSet();

        return $results;
    }

    // Jelentkezők lekérdezése
    public function jelentkezokLekerdezes()
    {
        $this->db->query("SELECT ANY_VALUE(j.id) AS jelentkezo_id,  ANY_VALUE(j.megjelent) AS megjelent,  j.neve AS jelentkezo, GROUP_CONCAT(CONCAT(TIME(e.datum), ';', t.neve) ORDER BY e.datum) AS idopont_terem FROM jelentkezok_vt j
                                    INNER JOIN 
                                        esemenyek e ON e.id = j.esemenyID
                                    INNER JOIN 
                                        tanterem t ON e.tanteremID = t.id
                                    WHERE 
                                        j.torolt = 0
                                    GROUP BY 
                                        j.neve
                                    ORDER BY 
                                        j.neve ASC ");

        $results = $this->db->resultSet();

        return $results;
    }

    // Időpontok lekérdezése
    public function idopontokLekerdezes()
    {
        $this->db->query('SELECT DISTINCT time(datum) as idopont FROM esemenyek WHERE torolt = 0 ORDER BY idopont ASC');
        $results = $this->db->resultSet();

        return $results;
    }

    public function jelentkezokSzamaLekerdezes()
    {
        $this->db->query('SELECT count(distinct email) as jelentkezok_szama from jelentkezok_vt where torolt = 0');
        $result = $this->db->single();

        return $result;
    }

    // Felhasználó engedélyezése
    public function felhasznaloEngedelyezese($id)
    {
        $this->db->query('UPDATE jelentkezok_vt SET megjelent = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Felhasználó törlése
    public function felhasznaloTorlese($id)
    {
        $this->db->query('UPDATE jelentkezok SET torolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Felhasználók lekérdezése
    public function engedelyezettFelhasznalok()
    {
        $this->db->query("SELECT neve, email FROM jelentkezok_vt WHERE megjelent = 1 AND torolt = 0 ");
        return $this->db->resultSet();
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
            "SELECT ANY_VALUE(j.id) AS jelentkezo_id,  ANY_VALUE(j.megjelent) AS megjelent,  j.neve AS jelentkezo, GROUP_CONCAT(CONCAT(TIME(e.datum), ';', t.neve) ORDER BY e.datum) AS idopont_terem FROM jelentkezok_vt j
                                    INNER JOIN 
                                        esemenyek e ON e.id = j.esemenyID
                                    INNER JOIN 
                                        tanterem t ON e.tanteremID = t.id
                                    WHERE 
                                        j.torolt = 0 AND (j.neve LIKE :keresendo)
                                    GROUP BY 
                                        j.neve
                                    ORDER BY 
                                        j.neve ASC"
        );

        $this->db->bind(':keresendo', "%$keresendo%");
        return $this->db->resultSet();
    }

    public function emlekezteto()
    {
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->db->query('select e.id, e.cim, e.tema, e.datum, e.leiras
                from esemenyek e
                where day(e.datum - interval 1 day) = day(NOW()) AND month(e.datum) = month(NOW()) AND year(e.datum) = year(NOW())');

                $row = $this->db->resultSet();
                for ($i = 0; $i < count($row); $i++) {
                    $this->db->query('select j.neve, j.email
                    from jelentkezok j
                    where j.esemenyID = :esemenyID');
                    $this->db->bind(':esemenyID', $row[$i]->id);
                    $row2 = $this->db->resultSet();

                    for ($j = 0; $j < count($row2); $j++) {
                        $subject = $row[$i]->cim . ' - Jelentkezés emlékeztető';
                        $body = 'Kedves ' . $row2[$j]->neve . '!<br><br>
                            <b>Ezúton értesítjuk, hogy a következő esemény: ' . $row[$i]->cim . ' holnap esedékes<b><br><br>
                            <b>Téma:</b> ' . $row[$i]->tema . '<br>
                            <b>Időpont:</b> ' . $row[$i]->datum . '<br>
                            <b>Leírás:</b> ' . $row[$i]->leiras . '<br><br>
                            Az alábbi linkre kattintva törölheti a jelentkezését:<br><br><a href="' . URLROOT . '/reszletek/jelentkezesTorles/' . $row[$i]->id . '">Jelentkezés törlése</a>
                            <br><br>Üdvözlettel,<br>HSZC Pollák Antal Technikum!';

                        $this->mailer->AddAddress($row2[$j]->email, $row2[$j]->neve);

                        $this->mailer->Subject = $subject;
                        $this->mailer->Body = $body;
                        $this->mailer->Send();
                        $this->mailer->clearAllRecipients();
                    }
                }
            } else {
            }
        } else {
            $data = [];
        }
    }
}
