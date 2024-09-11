function navbar() {
    var x = document.getElementById("navbarID");
    if (x.className === "navbar") {
      x.className += " responsive";
    } else {
      x.className = "navbar";
    }
  }
