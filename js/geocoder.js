

var coords = {};
coords["lat"] = -1;
coords["lng"] = -1;

function updateResult(data) {
    console.log(data);
    lattitude = data;
    console.log(lattitude);
}

// load jQuery from a CDN or your server
function geocoderrr(query){

    $.ajax({

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
          //console.log(response.results[0].geometry.lat);
          coords["lat"] = response.results[0].geometry.lat;
          coords["lng"] = response.results[0].geometry.lng;
          //updateResult(response.results[0].geometry.lat);
        },
        402: function(){
          console.log('hit free trial daily limit');
          console.log('become a customer: https://opencagedata.com/pricing');
        }
      }
    });
    return coords;

}



$(document).ready(function(){

    // console should now show:
    // 'Goethe-Nationalmuseum, Frauenplan 1, 99423 Weimar, Germany'
  });
