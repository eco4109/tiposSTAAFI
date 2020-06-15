function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "gethint.php?q=" + str, true);
      xmlhttp.send();
    }
  }

function justNumbers(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ( keynum == 8 ) return true;
    return /\d/.test(String.fromCharCode(keynum));
}
//Para utilizar agregar onkeypress="return justNumbers(event);" en el input a validar