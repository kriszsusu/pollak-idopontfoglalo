<?php
   require APPROOT . '/views/includes/head.php';
?>
<br>
<br>
<div class="container">
    <div class="wrapper-login">

        
        <h2 class="text-center mt-5">PollákBüfé</h2>
        <h5 class="text-center mb-5">A regisztráció sikerült!</h5>
    </div>

    <div>
        <div class="text-center my-5">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span>Rögtön bejelentkezhetsz...</span>
        </div>
    </div>
</div>

<script>
    window.setTimeout(function(){
        window.location.href = "<?php echo URLROOT . '/users/login'; ?>";
    }, 2000);
</script>