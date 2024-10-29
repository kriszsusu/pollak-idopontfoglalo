<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPROOT .  '/helpers/phpmailer/PHPMailer.php';
require APPROOT .  '/helpers/phpmailer/Exception.php';
require APPROOT .  '/helpers/phpmailer/SMTP.php';

class ReszletekModel
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

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id)
    {
        $this->db->query(
            'SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS "esemeny_id", u.nev, t.neve, t.ferohely, count(j.email) as "jelentkezok"
                          FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          LEFT JOIN jelentkezok_vt j ON e.id = j.esemenyID AND j.torolt = 0 AND j.visszaigazolt = 1
                          WHERE e.id = :id AND e.torolt = 0'
        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();

        return $results;
    }

    public function visszaigazol($id)
    {
        $this->db->query('UPDATE jelentkezok SET visszaigazolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();

        $this->db->query('SELECT j.esemenyID, j.neve, j.email FROM jelentkezok j WHERE id = :id');
        $this->db->bind(':id', $id);
        $jelentkezo = $this->db->single();

        $this->db->query('SELECT e.cim, e.datum, e.tema, e.leiras, u.nev AS "tanar_neve", t.neve AS "tanterem_neve" FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          WHERE e.id = :esemenyID');
        $this->db->bind(':esemenyID', $jelentkezo->esemenyID);
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
                Az alábbi linkre kattintva törölheti a jelentkezését:<br><br><a href="' . URLROOT . '/reszletek/jelentkezesTorles/' . $id . '">Jelentkezés törlése</a>
                <br><br>Üdvözlettel,<br>HSZC Pollák Antal Technikum!';

        $this->sendEmail($jelentkezo->email, $jelentkezo->neve, $subject, $body);

        return $jelentkezo->esemenyID;
    }

    public function torol($id)
    {
        $this->db->query('UPDATE jelentkezok SET torolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);

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

        $this->db->query('INSERT INTO jelentkezok (esemenyID, email, neve) VALUES (:esemenyID, :email, :neve)');
        $this->db->bind(':esemenyID', $esemenyID);
        $this->db->bind(':email', $email);
        $this->db->bind(':neve', $neve);
        $this->db->execute();

        $this->db->query('SELECT id FROM jelentkezok_vt WHERE email = :email AND esemenyID = :esemenyID AND torolt = 0');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $esemenyID);

        $insertedId = $this->db->single()->id;

        $this->db->query('SELECT e.cim, e.datum, e.tema, u.nev AS "tanar_neve", t.neve AS "tanterem_neve" FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          WHERE e.id = :esemenyID');
        $this->db->bind(':esemenyID', $esemenyID);
        $esemenyAdatok = $this->db->single();

        $subject = $esemenyAdatok->cim . ' - Jelentkezés megerősítése';
        $body = 'Kedves ' . $neve . '!<br><br>
                Köszönjük, hogy érdeklődik az alábbi esemény iránt:<br><br>
                <b>Cím:</b> ' . $esemenyAdatok->cim . '<br>
                <b>Téma:</b> ' . $esemenyAdatok->tema . '<br><br>
                Az alábbi linkre kattintva megerősítheti jelentkezését az eseményre:<br><br><a href="' . URLROOT . '/reszletek/jelentkezes/' . $insertedId . '">Jelentkezés megerősítése</a>
                <br><br>Üdvözlettel,<br>HSZC Pollák Antal Technikum!';

        $this->sendEmail($email, $neve, $subject, $body);

        if ($insertedId) {
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
}
