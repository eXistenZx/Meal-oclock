var app = {
  googleApiKey: 'AIzaSyCCOf00DC-sON25F-Dj_NIH_kv4FqxOfLA',
  basePath: BASE_PATH,
  init: function() {

    // On cible le champs de recherche
    $('#searchEvents').on('keyup', app.search);

    // On cible le formulaire d'inscription
    $('#subscription').on('submit', app.subscription);

    // On lance l'affichage de la Google Map
    app.initEventMap();
    app.initMap();
  },
  initMap: function() {

    // Je ne lance le code que si on est sur la bonne page
    if ($('#eventListMap').length == 0) return;
    var map = new MyMap('eventListMap', {});
    eventsAddress.forEach( map.addMarker.bind(map) );

    // eventsAddress.forEach((address) => {
    //
    //   map.addMarker(address);
    // });
  },
  // Lance l'affichage de la google map uniquement
  // sur la page d'un évènement
  initEventMap: function() {

    // On regarde si notre "div" est présente ou pas
    // ou dans la page (si oui, c'est qu'on est dans
    // la page d'un évènement)
    if ( $('#eventMap').length == 0 ) return;

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
    );
  },
  // Gère la validation du formulaire
  subscription: function(evt) {

    // On empêche le rechargement de la page
    evt.preventDefault();

    // Récupérer les données du formulaire
    var results = {};
    var fields = $('#subscription').serializeArray();
    fields.forEach(function(field) {

      // On récupère chaque élément du tableau
      // On va créer un index dans "results" qui
      // va reprendre le nom de l'élément et sa valeur
      // => results.firstname = 'Julien'
      results[ field.name ] = field.value;
    });

    // On s'assure que les données sont correctes
    var mandatoryFields = [
      'firstname',
      'lastname',
      'email',
      'password',
      'confirm_password',
    ];

    // On récupère le nom des champs obligatoires
    // et on vérifie si ils ont bien une valeur
    var isErrors = false;
    mandatoryFields.forEach(function(fieldName) {

      if (results[ fieldName ] === "") {

        // On a détecté un champs vide
        isErrors = true;
        $('#' + fieldName).css('border-color', 'red');
      }
    });

    // On supprime les précédents messages d'erreurs
    app.resetForm();

    // Est ce qu'on a des erreurs ?
    if (isErrors) {

      // On a détecter une erreur
      // On affiche le message
      // <div id="errorMsg" class="alert alert-danger d-none">Merci de remplir les champs obligatoires</div>
      var div = $('<div>')
        .addClass('alert alert-danger')
        .text("Merci de remplir les champs obligatoires");

      // On affiche le message dans le HTML
      $('#subscription').before(div);
      return;
    }

    // On fait les autres vérifications...
    // ...

    // Si c'est bon, on envoie les données au serveur
    $.ajax(app.basePath + '/signup', {
      method: 'post',
      data: results,
      // dataType: 'json'
    })
    .done(function(response) {

      // Le serveur a bien répondu
      // Si "response" est un tableau, alors
      // c'est que le serveur nous a retourné
      // des erreurs à afficher
      if (response == 'OK') {

        // Tout c'est bien passé, on redirige vers
        // la page de connexion
        document.location.href = app.basePath + '/login';
      }
      else {

        var errors = JSON.parse( response );
        errors.forEach(function( msg ) {

          // <div class="alert alert-danger">blabla</div>
          var div = $('<div>')
            .addClass('alert alert-danger')
            .text( msg );

          // On insère notre div juste avant le formulaire
          $('#subscription').before(div);
        });
      }
    })
    .fail(function() {

      // Il y a eu des erreurs HTTP
      console.log('ERREUR ?!');
    });
  },
  // On supprime les messages d'erreurs
  resetForm: function() {

    // On supprime les messages
    $('.alert').remove();
  },
  search: function() {

    // On récupère le contenu du champs de recherche
    var value = $('#searchEvents').val();

    // On interroge le serveur pour récupérer la
    // liste des évènements qui correspondent
    $.ajax(app.basePath + '/events/search', {
      method: 'POST',
      data: { query: value },
      dataType: 'json', // Le format que le serveur nous envoie
    })
    // On reçoit la réponse et tout c'est bien passé
    .done(function(response) {

      // On vide la liste de résultats
      $('.dropdown-menu').empty();

      // On a bien reçu la liste de résultat
      // On va afficher cette liste
      response.forEach(app.addEvent);

      // On affiche la dropdown
      $('.dropdown-menu').show();
    })
    // Il y a eu une erreur lors de la requête
    .fail(function(response) {

      console.log('Erreur :', response);
    });
  },
  // Ajoute un évènement dans la dropdown
  addEvent: function( ev ) {

    // On crée l'élément HTML
    // => <a class="dropdown-item" href="#">Action</a>
    var a = $('<a>')
      .addClass('dropdown-item')
      .attr('href', app.basePath + '/events/' + ev.id)
      .text(ev.title);

    // On ajoute l'évènement à la liste
    $('.dropdown-menu').append( a );
  }
};

// On démarre notre application JS
$(app.init);
