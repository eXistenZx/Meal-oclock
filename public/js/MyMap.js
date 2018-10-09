class MyMap {

  constructor (element, opt) {

    this.center = null;
    this.map = new google.maps.Map(
      // on lui passe l'élément du DOM où sera
      // affichée notre map
      document.getElementById(element),
      // On lui passe des configurations
      opt
    );
  }

  addMarker ( address ) {

    var geocoder = new google.maps.Geocoder();

    geocoder.geocode(
      { 'address': address },
      (results, status) => {

        if (status != 'OK') return;

        var gps = results[0].geometry.location;

        if (!this.center) {

          this.map.setCenter(gps);
          this.map.setZoom(8);
          this.center = gps;
        }

        var marker = new google.maps.Marker({
          map: this.map,
          position: gps
        });
      }
    );
  }
}



/*

var address = $('#eventMap').data('address');

var geocoder = new google.maps.Geocoder();

geocoder.geocode(
  { 'address': address },
  function(results, status) {

    if (status == 'OK') {

      var gps = results[0].geometry.location;

      // On construit la google map
      var map = new google.maps.Map(
        // on lui passe l'élément du DOM où sera
        // affichée notre map
        $('#eventMap').get(0),
        // On lui passe des configurations
        {
          center: gps,
          zoom: 16
        }
      );

      // On crée un marker
      var marker = new google.maps.Marker({
        map: map,
        position: gps
      });

    } else {

      console.log('Geocode was not successful for the following reason: ' + status);
    }
  }
);*/
