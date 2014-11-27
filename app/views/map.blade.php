<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Polygon</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>

function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(7.760854, 80.665750),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var colombo;

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  var styles =   [
      {
        "elementType": "labels",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "water",
        "stylers": [
          { "visibility": "on" }
        ]
      }
    ];
    map.setOptions({styles: styles});

  // Define the LatLng coordinates for the polygon's path.
  var colomboCoords = [
    new google.maps.LatLng(6.9427857850946015, 79.84725952148438),
    new google.maps.LatLng(6.968686273301305, 79.87060546875),
    new google.maps.LatLng(7.055919464256395, 79.85000610351562),
    new google.maps.LatLng(7.199000723728755, 79.81704711914062),
    new google.maps.LatLng(7.208537879875238, 79.83901977539062),
    new google.maps.LatLng(7.264394325339779, 79.84451293945312),
    new google.maps.LatLng(7.2739300994568845, 79.89669799804688),
    new google.maps.LatLng(7.271205613225026, 79.9365234375),
    new google.maps.LatLng(7.291638856626355, 79.96810913085938),
    new google.maps.LatLng(7.306622642692272, 80.02578735351562),
    new google.maps.LatLng(7.2875522824538725, 80.06698608398438),
    new google.maps.LatLng(7.32569218910034, 80.1397705078125),
    new google.maps.LatLng(7.25349605006954, 80.211181640625),
    new google.maps.LatLng(7.1540371481456155, 80.167236328125),
    new google.maps.LatLng(7.104980924120735, 80.20156860351562),
    new google.maps.LatLng(7.012304910822617, 80.18234252929688),
    new google.maps.LatLng(6.975501953620171, 80.2001953125),
    new google.maps.LatLng(6.976865077783423, 80.2166748046875),
    new google.maps.LatLng(6.9196104553322915, 80.23452758789062),
    new google.maps.LatLng(6.851441140808402, 80.19058227539062),
    new google.maps.LatLng(6.815989239380505, 80.2056884765625),
    new google.maps.LatLng(6.7941713805075565, 80.19607543945312),
    new google.maps.LatLng(6.720528817031182, 80.21530151367188),
    new google.maps.LatLng(6.660515511976399, 80.2496337890625),
    new google.maps.LatLng(6.615500711901609, 80.26748657226562),
    new google.maps.LatLng(6.5800316152599, 80.30593872070312),
    new google.maps.LatLng(6.521365633956217, 80.31967163085938),
    new google.maps.LatLng(6.4299421849603675, 80.3814697265625),
    new google.maps.LatLng(6.379447546377781, 80.29495239257812),
    new google.maps.LatLng(6.337137394988546, 80.30181884765625),
    new google.maps.LatLng(6.328947931902761, 80.2935791015625),
    new google.maps.LatLng(6.3780827571826135, 80.24826049804688),
    new google.maps.LatLng(6.375353167891235, 80.20980834960938),
    new google.maps.LatLng(6.348056476859364, 80.2001953125),
    new google.maps.LatLng(6.360340167236244, 80.15213012695312),
    new google.maps.LatLng(6.393095238295308, 80.09994506835938),
    new google.maps.LatLng(6.416295478228903, 80.05874633789062),
    new google.maps.LatLng(6.438130033225172, 80.03265380859375),
    new google.maps.LatLng(6.420389528664146, 79.99969482421875),
    new google.maps.LatLng(6.45859907588465, 79.97772216796875),
    new google.maps.LatLng(6.5145435613629665, 79.97772216796875),
    new google.maps.LatLng(6.620957270326322, 79.9420166015625),
    new google.maps.LatLng(6.701434474782413, 79.90631103515625),
    new google.maps.LatLng(6.769625106228673, 79.8760986328125),
    new google.maps.LatLng(6.869166104051696, 79.859619140625),
    new google.maps.LatLng(6.904614047238073, 79.84725952148438),
    new google.maps.LatLng(6.935969629956095, 79.84725952148438)
  ];

  // Construct the polygon.
  colombo = new google.maps.Polygon({
    paths: colomboCoords,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });

  colombo.setMap(map);

  // Set mouseover event for each feature.
    map.data.addListener('mouseover', function(event) {

    });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>

</head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>