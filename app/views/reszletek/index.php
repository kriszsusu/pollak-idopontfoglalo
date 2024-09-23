<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">
        <h2 class="esemeny"><?php echo $data["reszletek"]->cim; ?></h2>
        <div class="kismain">
            <div class="image">
                <img id="img" src="<?php echo URLROOT ?>/public/img/<?php echo $data["reszletek"]->kep; ?>" alt="">
                <div>
                <input type="text" class="input" onkeyup="submit()" id="input" placeholder="példa@példa.com">
                </div>
                <div id="teszt">
                    <button disabled id="myBtn" class="buttony">Jelentkezés</button>
                </div>
            </div> 
            <div class="text">

                <hr>
                <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data["reszletek"]->leiras));  ?></p>
                <br>
                <h3 class="terem">Tanterem: <?php echo $data["reszletek"]->neve; ?></h3>
                <h3 class="oktato">Oktató neve: <?php echo $data["reszletek"]->nev; ?></h3>
                <h3 class="idopont"><?php echo $data["reszletek"]->datum; ?></h3>

            </div>
            
        </div>
    </div>
    <div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <p>Sikeresen jelentkeztél az előadásra</p>
    </div>

</div>

<script src="<?php echo URLROOT ?>/public/js/script.js"></script>