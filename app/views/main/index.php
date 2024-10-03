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
        <select name="" onchange="szures(this)" id="idopontok">
            <option value="0">Válassz időpontot!</option>
            <?php foreach ($data['idopontok'] as $fajta): ?>
                <option value="<?php echo $fajta->id; ?>"><?php echo $fajta->datum; ?></option>
            <?php endforeach; ?>
        </select>

        <select name="" onchange="szures(this)" id="szak">
            <option value="0">Válassz Eseményt!</option>
            <?php foreach ($data['szak'] as $fajta): ?>
                <option value="<?php echo $fajta->id; ?>"><?php echo $fajta->cim; ?></option>
            <?php endforeach; ?>
        </select>



        <select name="" onchange="szures(this)" id="oktatok">
            <option value="0">Válassz Oktatót!</option>
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
                          <p class="tanterem">Helyszin neve: <b><?php echo $sor->neve?></b></p>
                          <br>
                          <p class="helyek">Hátralévő helyek szama: <b><?php echo $sor->ferohely - $sor->jelentkezok?></b></p>
                          <br>
                          <p class="idopont">Esemény időpontja: <br> <?php echo str_replace("-", " ", $sor->datum)?></p>
                          <a class="tovabb"  href="<?php echo URLROOT . "/reszletek/" . $sor->esemeny_id; ?>">Tovább</a>
                      </div>
                  </div>
              <?php endforeach; ?>
      <?php endif; ?>

  </div>
  <script src="<?php echo URLROOT ?>/public/js/script.js"></script>
</main>