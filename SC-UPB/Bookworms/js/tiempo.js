var fecha = new Date();
var fechaHoy = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();
var fechaD = fechaHoy.setDate(fechaHoy.getDate() + 7)

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    console.log(this.responseText);
  }
};
xhttp.open("GET", "carrito.php?fechaHoy=" + fechaHoy + "&fechaD=" + fechaD, true);
xhttp.send();