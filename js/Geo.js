function geoAurkitu() {
  var output = document.getElementById("map");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Zure nabigatzailean ezin da geolokalizazioa erabili.</p>";
    return;
  }

  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;

    output.innerHTML = '<p>Zure latitudea   &nbsp; ' + latitude + ' da (ezkerrean) &nbsp; Gure bulegoarena, 43.3070612 (eskuinean)<br>Zure longitudea ' + longitude + ' da (ezkerrean) &nbsp; Gure bulegoarena, -2.0106932 (eskuinean)</p><br/>'

    var imgZ = new Image(); var imgG = new Image();
    imgZ.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=15&size=300x300&sensor=false&markers=color:red%7Clabel:Z%7C" + latitude + "," + longitude;
    imgG.src = "http://maps.googleapis.com/maps/api/staticmap?center=43.3069305,-2.0097815&zoom=15&size=300x300&sensor=false&markers=color:green%7Clabel:G%7C43.3070612,-2.0106932";
    output.appendChild(imgZ); output.insertAdjacentHTML('beforeend', '&nbsp; &nbsp;'); output.appendChild(imgG);
  };

  function error() {
    output.innerHTML = "Ezin izan da zure kokapena aurkitu.";
  };

  output.innerHTML = "<p>Posizionatzen...</p>";

  navigator.geolocation.getCurrentPosition(success, error);
}