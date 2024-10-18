<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">

        <div class="kismain">
            <div class="image">
               

            </div>

            <div class="text">
                <div class="kepBox">
                    <img id="img" src="<?php echo URLROOT ?>/public/img/<?php echo $data["Versenyreszletek"]->kep; ?>" alt="">
                </div>

                <h2 class="esemeny"><?php echo $data["Versenyreszletek"]->versenynev; ?></h2>
                <hr>
                <h3 class="idopont"><?php echo $data["Versenyreszletek"]->idopont; ?></h3>
                <br><br><br>
                <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data["Versenyreszletek"]->tema));  ?></p>
                <form  class="jelentkezes" id="teszt" method="post">
                    <input type="hidden" name="versenyID" value="<?php echo $data['Versenyreszletek']->esemeny_id ?>">
                    <input type="text" class="input" name="tanuloNeve" placeholder="Név">
                    <br>
                    <input type="email" class="input" onkeyup="validate()" id="input" name="email" placeholder="példa@példa.com">
                    <button type="submit" disabled id="myBtn" class="buttony buttony-disabled">Jelentkezés</button>
                </form>
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
