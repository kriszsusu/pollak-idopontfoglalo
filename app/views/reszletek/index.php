<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">
    <button type="button" id="bottanya" onclick="back()"><svg width="60" height="60" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z"/></svg></button>
        <h2 class="esemeny"><?php echo $data["reszletek"]->cim; ?></h2>
        <div class="kismain">
            <div class="image">
                <img id="img" src="ikszdé.jpeg" alt="nincs kép!">
                <div>
                <input type="text" class="input" onkeyup="submit()" id="input" placeholder="példa@példa.com">
                </div>
                <div id="teszt">
                    <button disabled id="myBtn" class="buttony">Jelentkezés</button>
                </div>
            </div> 
            <div class="text">

                <hr>
                <p>
                Zelenskiy says he is 'glad to hear' that Donald Trump is 'safe and unharmed'
                Volodymyr Zelenskiy has posted to social media to say he is glad Donald Trump is “safe and unharmed” and praised the quick apprehension of the suspected gunman.

                In a post, Ukraine’s president said “I am glad to hear that Donald Trump is safe and unharmed. My best wishes to him and his family. It’s good that the suspect in the assassination attempt was apprehended quickly. This is our principle: the rule of law is paramount and political violence has no place anywhere in the world. We sincerely hope that everyone remains safe.”

                Trump has made much in his election campaign of his claim that he would end the war in Ukraine if he became president for a second time, however during the presidential debate with opponent Kamala Harris, the former president made it a point to avoid saying he wanted Ukraine to triumph.

                The suspected gunman, Ryan Wesley Routh, is known to be a vocal supporter of Ukraine’s cause.


                </p>
                <br>
                <h3 class="terem">XY terem</h3>
                <h3 class="oktato">Kiss Dominik Csabi</h3>
                <h3 class="idopont">12:30</h3>

            </div>
            
        </div>
    </div>
    <div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <p>Sikeresen jelentkeztél az előadásra</p>
    </div>

</div>
<script src="script.js"></script>