<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>
<main>
  <div class="slide">
    <div class="slideshow-container">
      <div class="mySlides fade">
        <div class="slideshow-img-box" style="background-image: url('<?php echo URLROOT ?>/public/img/slide1.jpg');"></div>
        <div class="slide_text">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>

      <div class="mySlides fade">
        <div class="slideshow-img-box" style="background-image: url('<?php echo URLROOT ?>/public/img/slide2.jpg');"></div>
        <div class="slide_text">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>

      <div class="mySlides fade">
        <div class="slideshow-img-box" style="background-image: url('<?php echo URLROOT ?>/public/img/slide3.jpg');"></div>
        <div class="slide_text">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>

      <a class="prev" onclick="plusSlides(-1)">❮</a>
      <a class="next" onclick="plusSlides(1)">❯</a>
    </div>
  </div>

  <div class="">
        <div>
            <input id="searchBox" type="text" class="kereses" placeholder="Keresés...">
        </div>
    </div>
  <h2>Szűrők</h2>

    <div class="szures">
        <select name="" onchange="szures(this)" id="nap">
            <option value="0">Válassz időpontot!</option>
            <?php foreach ($data['idopontokNap'] as $fajta): ?>
                <option value="<?php echo $fajta->datum ?>"><?php echo str_replace('-', '.', $fajta->datum); ?></option>
            <?php endforeach; ?>
        </select>

        <select name="" onchange="szures(this)" id="ora">
            <option value="0">Válassz időpontot!</option>
            <?php foreach ($data['idopontokOra'] as $fajta): ?>
                <option value="<?php echo substr($fajta->datum, 0, 5); ?>"><?php echo substr($fajta->datum, 0, 5); ?></option>
            <?php endforeach; ?>
        </select>

        <select name="" onchange="szures(this)" id="szak">
            <option value="0">Válassz szakot!</option>
            <?php foreach ($data['szak'] as $fajta): ?>
                <option value="<?php echo $fajta->id; ?>"><?php echo $fajta->neve; ?></option>
            <?php endforeach; ?>
        </select>

        <select name="" onchange="szures(this)" id="oktatok">
            <option value="0">Válassz oktatót!</option>
            <?php foreach ($data['oktatok'] as $fajta): ?>
                <option value="<?php echo $fajta->id; ?>"><?php echo $fajta->nev; ?></option>
            <?php endforeach; ?>
        </select>

        <select name="" onchange="szures(this)" id="termek">
            <option value="0">Válassz termet!</option>
            <?php foreach ($data['termek'] as $fajta): ?>
                <option value="<?php echo $fajta->id; ?>"><?php echo $fajta->neve; ?></option>
            <?php endforeach; ?>
        </select>
    </div>



  <span id="keresesiEredmenyek"></span>
</div>

  <div class="container" id="torles">

      <?php if (count($data["main"]) > 0) : ?>
              <?php foreach ($data["main"] as $sor): ?>
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
      <?php endif; ?>

  </div>
  <script src="<?php echo URLROOT ?>/public/js/script.js"></script>
</main>