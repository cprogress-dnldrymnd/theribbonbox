/************************************
//
//  Easy BC Map v1.0 - Joe Watkins
//
//  V3 Google Maps - https://developers.google.com/maps/documentation/javascript/
//  jQuery UI Maps - https://code.google.com/p/jquery-ui-map/
//  Normalize - http://necolas.github.io/normalize.css/
//  
//  ## Options
//
//  mapWrapper : '.map-wrapper',
//  dataItem : '.locations li', // each element containing data attributes
//  dataAttrLat : 'lat', // name of Latitude data attribute eg. data-lat
//  dataAttrLong : 'long', // name of Longitude 
//  infoBox : '.info-box', // <div class="info-box">..
//  iconBase : 'images/', // folder housing marker images
//  marker : 'marker.png', // images/marker.png
//  markerShadow : 'marker-shadow.png', // images/marker-shadow.png
//  disableDefaultUI: true,
//  mapTypeId: google.maps.MapTypeId.ROADMAP
//
//  ## EXAMPLE HTML


*/
(function($){
 
    $.fn.easyBCMap = function(options) {


      var sectorval = $("#sector-val").val();


          $('.locations li').each(function(){
              if ($(this).attr("data-lat").length <= 0 || $(this).attr("data-long").length <= 0 ){
                $(this).remove();
              }
          });


         //Set the default values, use comma to separate the settings
         var defaults = {
          styles: [
    {
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "saturation": -100
            },
            {
                "gamma": 0.54
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "color": "#4d4946"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "transit.line",
        "elementType": "geometry",
        "stylers": [
            {
                "gamma": 0.48
            }
        ]
    },
    {
        "featureType": "transit.station",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "gamma": 7.18
            }
        ]
    }
],            

              mapWrapper : '.map-wrapper',
              mapContainer : this, // <div class="map">..
              dataItem : '.locations li', // <ul class="locations">..
              dataAttrSec : 'sec',
              dataAttrLat : 'lat', // data-lat
              dataAttrLong : 'long', // data-long
              infoBox : '.info-box', // <div class="info-box">..
              iconBase : '/wp-content/themes/lighttheme/images/icons/', // folder housing marker images
              marker : 'map-pin.png', // images/marker.png
              //markerShadow : 'marker-shadow.png', // images/marker-shadow.png
              disableDefaultUI: false,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              
         }
             
         var options =  $.extend(defaults, options);

         var o = options;

         var bounds  = new google.maps.LatLngBounds();

         var thisMap;
         $(o.mapContainer).gmap({
              //'disableDefaultUI': o.disableDefaultUI,
              mapTypeId: o.mapTypeId, // ROADMAP, SATELLITE, HYBRID, TERRAIN
              styles: o.styles,
              'callback': function() {
                  var self = this;
                  thisMap = this;
                  $(o.dataItem).each(function(i, el) {
                    var lll =$(this).data(o.dataAttrSec);
                    if (sectorval == "" || sectorval == $(this).data(o.dataAttrSec)){
                      var lattitude = $(this).data(o.dataAttrLat),
                          longitude = $(this).data(o.dataAttrLong);
                        var loc = new google.maps.LatLng(lattitude,longitude);
                        bounds.extend(loc);
                      self.addMarker({
                          'position': loc,
                          'bounds': true,
                          icon: o.iconBase + o.marker,
                          shadow: o.iconBase + o.markerShadow
                      }, function(map, marker) {
                          $(el).click(function() {
                              $(marker).triggerEvent('click');
                          });
                      }).click(function() {
                          self.openInfoWindow({
                              'content': $(el).find(o.infoBox).html()
                          }, this);
                      });
                    }
                   
                  });
                  
              }
          });




          // on resize for fun
          $(window).resize(function() {
            var parentWidth = $(o.mapWrapper).width();
            $(o.mapWrapper+' iframe').each(function(){
              $(this).attr('style', 'border: medium none; overflow: hidden; width: ' + parentWidth +  'px').attr("width",parentWidth+"px");
            });
          });

          // onload
          /*$(window).load(function() {
            var parentWidth = $(o.mapWrapper).width();
            $(o.mapWrapper+' iframe').each(function(){
              $(this).attr('style', 'border: medium none; overflow: hidden; width: ' + parentWidth +  'px').attr("width",parentWidth+"px");
            });
          });

 */
    };
 
}(jQuery));