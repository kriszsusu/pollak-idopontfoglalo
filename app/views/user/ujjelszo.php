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
            <h1 class="text-center mt-5">Pollák Büfé</h1>
            <h5 class="text-center mb-5 ">Elfelejtett jelszó</h5>
        </div>

        <br>

        <div class="box2 ">
            <form id="register-form" method="POST" action="<?php echo URLROOT; ?>/users/jelszomodositasa">
                <div>
                    <div class="mt-3">
                        <div class="mt-3">
                            <label for="id-emailcim">Mi az email cím amivel regisztráltál?</label>
                            <input class="form-control" type="text" placeholder="" name="emailcim" id="id-emailcim" autocomplete="off" value="" placeholder="">

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

                        <div class="row">
                            <div class="col text-center">
                            <button class="btn btn-info mt-5 px-5 gomb" id="submit" type="submit" value="submit">OK</button>
                        </div>
              </div>

                    </div>
                </div>
                               
            </form>
        </div>
    </div>
    
</div>
<div class="col text-center mt-5 meg aaa">
             <span class="link bbb"> Már van fiókod?</span> <a href="<?php echo URLROOT; ?>/users/login"><span class="reg">Belépés!</span></a>
            </div>
</section>

