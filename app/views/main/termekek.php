
<div class="container">

    <?php foreach ($data["termekek"] as $sor): ?>
        <div class="box">
            <div class="kep-box">
                <img src="<?php echo URLROOT ?>/public/img/<?php echo $sor->kep; ?>" alt="" class="kep">
            </div>
            <br>
            <div class="adatok">
                <h1 class="cim"><?php echo $sor->cim?></h1>
                <br>
                <p class="oktato">Oktató neve: <b><?php echo $sor->nev?></b></p>
                <br>
                <p class="tanterem">Helyszín neve: <b><?php echo $sor->neve?></b></p>
                <br>
                <p class="helyek">Hátralévő helyek száma: <b><?php echo $sor->ferohely - $sor->jelentkezok?></b></p>
                <br>
                <p class="helyek">Téma: <b><?php echo $sor->tema?></b></p>
                <br>
                <p class="idopont">Esemény időpontja: <br> <?php $datum = new DateTime($sor->datum); echo $datum->format('Y.m.d H:i');?></p>
                <a class="tovabb"  href="<?php echo URLROOT . "/reszletek/" . $sor->esemeny_id; ?>">Tovább</a>
                
            </div>
        </div>
    <?php endforeach; ?>

</div>

