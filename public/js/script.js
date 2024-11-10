function navbar() {
  var x = document.getElementById("navbarID");
  if (x.className === "navbar") {
    x.className += " responsive";
  } else {
    x.className = "navbar";
  }
}

var modal = document.getElementById("myModal");

// Get the button that opens the modal

// When the user clicks the button, open the modal
window.onload = function () {
  if (window.location.search === "?msg=0") {
    modal.children[0].children[0].innerHTML = "Sikeres regisztráció!";
    modal.style.display = "block";
    setTimeout(() => {
      modal.style.display = "none";
      window.location.replace(window.location.href.split("?")[0]);
    }, 1000);
  } else if (window.location.search === "?msg=1") {
    modal.children[0].children[0].innerHTML =
      "A megadott email cím nem megfelelő vagy már regisztrálva van!";
    modal.style.display = "block";
    setTimeout(() => {
      modal.style.display = "none";
      window.location.replace(window.location.href.split("?")[0]);
    }, 2000);
  } else if (window.location.search === "?msg=2") {
    modal.children[0].children[0].innerHTML =
      "A jelentkezés sikeresen visszaigazolva!";
    modal.style.display = "block";
    setTimeout(() => {
      modal.style.display = "none";
      window.location.replace(window.location.href.split("?")[0]);
    }, 1000);
  } else if (window.location.search === "?msg=3") {
    modal.children[0].children[0].innerHTML = "A visszaigazolása sikertelen!";
    modal.style.display = "block";
    setTimeout(() => {
      modal.style.display = "none";
      window.location.replace(window.location.href.split("?")[0]);
    }, 1000);
  }
  setInterval(() => {
    plusSlides(1);
  }, 4000);
};

function changeDisplayTestForModal(text, time) {
  modal.children[0].children[0].innerHTML = text;
  modal.style.display = "block";
  setTimeout(() => {
    modal.style.display = "none";
    window.location.replace(window.location.href.split("?")[0]);
  }, time);
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
function validateEmail(email) {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
}
function validate() {
  var input = document.getElementById("input").value;
  let validemail = validateEmail(input);
  document.getElementById("myBtn").disabled = !validemail;
  document
    .getElementById("myBtn")
    .classList.toggle("buttony-disabled", !validemail);
}

function back() {
  history.back();
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides((slideIndex += n));
}

function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  dots[slideIndex + 3 - 1].className += " active";
  dots[slideIndex + 6 - 1].className += " active";
}

function kereses() {
  var keresendo = $("#searchBox").val();

  if (keresendo != "" && keresendo.length > 2) {
    $.ajax({
      url: "./kereses/termekekkeresese",
      method: "POST",
      data: {
        keresendo: keresendo,
      },
      success: function (data) {
        document.getElementById("keresesiEredmenyek").innerHTML = data;
        document.getElementById("torles").style.display = "none";
      },
      error: function () {
        console.log("hiba történt a keresés során!");
      },
    });
  } else {
    document.getElementById("keresesiEredmenyek").innerHTML = "";
    document.getElementById("torles").style.display = "flex";
  }
}

function keresesAdmin() {
  var keresendo = $("#searchBoxAdmin").val();

  if (keresendo != "" && keresendo.length > 2) {
    console.log(keresendo);
    $.ajax({
      url: "./termekekkeresese",
      method: "POST",
      data: {
        keresendo: keresendo,
      },
      success: function (data) {
        document.getElementById("keresesiEredmenyek").innerHTML = data;
        document.getElementById("torlesAdmin").style.display = "none";
      },
      error: function () {
        console.log("hiba történt a keresés során!");
      },
    });
  } else {
    document.getElementById("keresesiEredmenyek").innerHTML = "";
    document.getElementById("torlesAdmin").style.display = "table";
  }
}

$(document).ready(function () {
  kereses();
  keresesAdmin();

  $("#searchBoxAdmin").keyup(function () {
    keresesAdmin();
  });

  $("#searchBox").keyup(function () {
    kereses();
  });
});

var szuroObj = {
  nap: "",
  ora: "",
  szak: "",
  oktatok: "",
  termek: "",
};

function szures(selectobject) {
  var keresendo = selectobject.value;
  var szuro = selectobject.id;

  if (keresendo != 0) {
    szuroObj[szuro] = keresendo;
  } else {
    szuroObj[szuro] = "";
  }

  console.log(szuroObj);
  if (keresendo != 0) {
    $.ajax({
      url: "./kereses/termekekszurese",
      method: "POST",
      data: {
        // keresendo: keresendo,
        // szuro: szuro,
        szuroObj: szuroObj,
      },
      success: function (data) {
        document.getElementById("keresesiEredmenyek").innerHTML = data;
        document.getElementById("torles").style.display = "none";
      },
      error: function () {
        console.log("hiba történt a keresés során!");
      },
    });
  } else {
    document.getElementById("keresesiEredmenyek").innerHTML = "";
    document.getElementById("torles").style.display = "flex";
  }
}

function iskolak(element) {
  console.log(element.value);

  if (element.value === "egyeb") {
    document.getElementById("iskolaNeve").style.display = "block";
  } else {
    document.getElementById("iskolaNeve").style.display = "none";
  }
}

function reveal(url, id) {
  document.getElementById("blured-kod-" + id).classList.remove("text-blur");
  console.log(url);
  $.ajax({
    url: `${url}/admin/reveal`,
    method: "POST",
    data: {
      jelentkezoID: id,
    },
    success: function (response) {
      console.log(response);
    },
    error: function (err) {
      console.log(err);
    },
  });
}

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" activeTab", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " activeTab";
}
