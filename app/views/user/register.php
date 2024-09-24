<?php
   require APPROOT . '/views/includes/head.php';
?>

<section>
<br>
<br>
<body class="login_reg" id="img">
<div class="container hatter4">
    <div class="wrapper-login">
        <div class="container">
            
        </div>
        <br>
        

        <div class="box2 ">
            <form id="register-form" method="POST" action="<?php echo URLROOT; ?>/users/register">
            <div>
                <div class="">
                    <div class="">
                        <label for="id-vezeteknev">Mi a vezetékneved?</label>
                        <input class="form-control" type="text" placeholder="" name="vezeteknev" id="id-vezeteknev" autocomplete="off" value="<?php echo $data['vezeteknev']; ?>">

                        <span class="invalidFeedback">
                            <?php echo $data['vezeteknevHiba']; ?>
                        </span>
                    </div>
                    <div class="mt-3">
                        <label for="id-keresztnev">Mi a keresztneved?</label>
                        <input class="form-control" type="text" placeholder="" name="keresztnev" id="id-keresztnev" autocomplete="off" value="<?php echo $data['keresztnev']; ?>">

                        <span class="invalidFeedback">
                            <?php echo $data['keresztnevHiba']; ?>
                        </span>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="">
                        <label for="id-omazonosito">Mi az OM azonosítód?</label>
                        <input class="form-control" type="text" placeholder="" name="omazonosito" id="id-omazonosito" autocomplete="off" value="<?php echo $data['omazonosito']; ?>">

                        <span class="invalidFeedback">
                            <?php echo $data['omazonositoHiba']; ?>
                        </span>
                    </div>
                    <div class="mt-3">
                        <label for="id-emailcim">Mi az email címed?</label>
                        <input class="form-control" type="text" placeholder="" name="emailcim" id="id-emailcim" autocomplete="off" value="<?php echo $data['emailcim']; ?>">
                        
                    <!--A tiltott email-ek JSON file-ját beolvassuk-->    
                        <?php $json = file_get_contents('emailBlock.json');
                        if ($json === false){
                            die('Nem sikerült beolvasni a JSON file-t');
                        }
                        $json_data = json_decode($json, true);
                        if ($json_data === null){
                            die('Nem sikerült dekódolni a JSON file-t');
                        }
                    //Ellenőrizzük, hogy a beírt email ne legyen benne a listában ! Nem biztos, hogy müködik ! 
                        if (in_array($_POST['emailcim'],$json_data)){
                        echo "Ezt az email-t nem használhatod!";
                        }
                        ?>
                        <span class="invalidFeedback">
                            <?php echo $data['emailHiba']; ?>
                        </span>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="">
                        <label for="id-password1">Válassz jelszót!</label>
                        <input class="form-control" type="password" placeholder="[min. 6 karakter; betűk és számok]" name="jelszo" id="id-password1">

                        <span class="invalidFeedback">
                                <?php echo $data['jelszoHiba']; ?>
                            </span>
                            <br>
                            <label for="id-password1">Jelszó ismét!</label>
                            <input class="form-control" type="password" placeholder="[min. 6 karakter; betűk és számok]" name="jelszo2" id="id-password1">

                            <span class="invalidFeedback">
                                <?php echo $data['jelszo2Hiba']; ?>
                            </span>
                    </div>
                </div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <span class="invalidFeedback" >
                            <?php echo $data['nemPollakosHiba']; ?>
                        </span>
                        <button class="btn btn-info mt-5 px-5 gomb" id="submit" type="submit" value="submit">Regisztráció</button>
                    </div>
            </div>
                                
                </div>
            </form>

            </div>

        </div>

    </div>
    
</div>
<div class="col text-center mt-5 meg aaa">
             <span class="link bbb"> Már van fiókod?</span> <a href="<?php echo URLROOT; ?>/users/login"><span class="reg">Belépés!</span></a>
            </div>
</section>

