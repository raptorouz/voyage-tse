var coords = {};
coords["lat"] = -1;
coords["lng"] = -1;


var c = [];


var locations = [];

// load jQuery from a CDN or your server
function geocode(query){
     var geoCoords = {}
     var data = $.ajax({
      async : false,
      url: 'https://api.opencagedata.com/geocode/v1/json',
      method: 'GET',
      data: {
        'key': '436faf19fab84a2d931048bb36b8a74f',
        'q': query,
        'no_annotations': 1
      },

      dataType: 'json',

      statusCode: {
        200: function(response){  // success
          //console.log(response);

          geoCoords["lat"] = (response.results[0].geometry.lat);
          geoCoords["lng"] = (response.results[0].geometry.lng);
          //updateResult(response.results[0].geometry.lat);
        },
        402: function(){
          console.log('hit free trial daily limit');
          console.log('become a customer: https://opencagedata.com/pricing');
         }
     },


     }).responseText;


    c.push(geoCoords);
    return geoCoords;
}

/*

*/
function useReturnData(data){
    myvar = data;
    a.push(data);

};

/*

*/
function initMap(arrayOfStudents) {
    // Map initialization
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: new google.maps.LatLng(43.92,5.25)
    });

    // Marker content initialization
    contentString = ""
    const infowindow = new google.maps.InfoWindow({
        content: contentString,
        //maxWidth: 400,

    });

    // Placing markers in google map
    var marker, i;
    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1].lat, locations[i][1].lng),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}

/**
    item[1] : id
    item[2] : prenom
    item[3] : nom
    item[4] : promo
    item[5] : pays
    item[6] : ville
*/
function arrayStudentsToMaps(students){
    cities = {};
    locations = [];


    students.forEach((item, i) => {
        if(item[6] in cities){
            // Save student's id
            cities[item[6]].push(item);
        } else {
            cities[item[6]] = [item];
        }
    });

    for (const [city, oneOrMoreStudent] of Object.entries(cities)) {
        locations.push(
            [createContent(oneOrMoreStudent), geocode(city)]
        )
    }
    return locations;
}


/**
 prenom, nom, promo, ville, pays
*/
function createContent(oneOrMoreStudent) {

    var contentString =
    '<div class="container d-flex flex-column justify-content-center">';

        //<div class="d-flex flex-column align-items-center">
    oneOrMoreStudent.forEach((student, i) => {
        contentString +=
        '<div class="card p-3">' +
            '<div class="d-flex  align-items-center">' +
                '<div class="image">' +
                    '<object data="https://www.telecom-st-etienne.fr/intranet/photos/2018_'
                        + student[2].toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") + '_'
                        + student[1].toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") +
                        '.jpg" class="rounded" width="100" >' +
                            '<img src="res/img/user.jpg" width="155" />' +
                    '</object>' +
                '</div>' +
                '<div class="ml-3 w-100">' +
                    '<h4 class="mb-0 mt-0">' + student[1] + ' ' + student[2] +'</h4> <span>' + student[4] +'</span>' +
                    '<p class="mt-2 mb-0">' + student[6] + ', ' + student[5] + '</p>' +
                '</div>' +
            '</div>' +
        '</div>';
    });
    contentString +='</div>';

    return contentString
}
