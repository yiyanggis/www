/// <reference path="../GMap/google-maps-3-vs-1-0-vsdoc.js" />
/// <reference path="../jquery-1.4.1-vsdoc.js" />

var map;
var marker1;
var marker2;
var rectangle;
jQuery(document).ready(function($) {
  /*
   * Initialize jQuery Templates
   */
  var infoTemplate = $.template("\
<div class='info'>\
  <div style='float:left;'><img src='${photo.SquareThumbnailUrl}'></div>\
  <div style='float:left;margin-left:5px;'>\
    <div>${photo.Title}</div>\
    <div>${photo.PhotoId}</div>\
    <div>${photo.Location.Latitude},${photo.Location.Longitude}</div>\
  </div>\
</div>");

    listTemplate = $.template("\
<li> \
  <div>\
    <div id='mark${index}' style='float:left;margin-top:5px;margin-right:5px;'><img src='${marker.icon}'/></div>\
    <div style='float:left;'><img src='${data.SquareThumbnailUrl}'/></div>\
    <div style='float:left;margin-left:5px;'>\
      <div>${marker.photo.Title}</div>\
      <div>Date Taken ${date}</div>\
      <div>${marker.photo.PhotoId}</div>\
      <div>${marker.photo.Location.Latitude},${marker.photo.Location.Longitude}</div>\
    </div>\
  </div>\
  <div style='clear:both'></div>\
</li>");
    
    photoTemplate = $.template("\
<div>\
  <div class='subheadertext'>${Title}</div>\
  <div>\
    <div style='float:left;'>\
      <div style='margin-left:8px;'> <br>&nbsp;<img src='${SmallUrl}' alt=''></div>\
    </div>\
    <div style='float:left;'>\
      <div style='margin-left:8px;'><span class='labelname'>Latitude/Longitude:</span> ${Location.Latitude},${Location.Longitude}</div>\
      <div style='margin-left:8px;'>${Location.Neighbourhood.Description}</div>\
      <div style='margin-left:8px;'>${Location.Region.Description} ${Location.Country.Description}</div>\
      <div style='margin-top:5px;margin-left:8px;'><span class='labelname'>Owner:</span> ${OwnerRealName}</div>\
      <div style='margin-left:8px;'><span class='labelname'>User Name:</span> ${OwnerUserName}</div>\
      <div style='margin-left:8px;'><span class='labelname'>User Id:</span> ${OwnerUserId}</div>\
      <div style='margin-top:5px;margin-left:8px;'><span style='color:red;' class='labelname'>Image Scale:</span> Label: ${SizeCollection[2].Label} W: ${SizeCollection[2].Width} H: ${SizeCollection[2].Height }</div>\
    </div>\
  </div>\
  <div style='clear:both;'></div>\
</div>\
<div style='clear:both;'></div>");
    

  var item;
  var itemBefore=-1;
  var markers = {};
  var markerCount = 0;
  var data;	
  var divList;
  var divMaoInfo;

  //function that points to marker when you click item in the list (changes marker to red, and previously selected marker to green)
  function pointToMarker(id){
    
    if(id!=itemBefore){
      var markImgRedUrl = 'http://gmaps-samples.googlecode.com/svn/trunk/markers/red/marker' + (id +1)	+ 	'.png';
	  
      markers[id].setIcon(new google.maps.MarkerImage(markImgRedUrl));
	  
      //changes icon colour in list item from green to red
      var oldGreenImg = document.getElementById('mark' + id);
      var newRedImg = document.createElement('img');
      newRedImg.src = markImgRedUrl;
      oldGreenImg.replaceChild(newRedImg, oldGreenImg.firstChild);
	  
      //if there are 2 markers with samo lon & lat, the selected one will be on top
      markers[id].setMap(null);
      markers[id].setMap(map);
      //centers the map on selected marker, but doesn't change the zoom level
	  
	  
      map.setCenter(new google.maps.LatLng(markers[id].photo.Location.Latitude,markers[id].photo.Location.Longitude));
      
      if (itemBefore!=-1){
        var markImgGreenUrl = 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/marker' + (itemBefore + 1) + '.png';
        markers[itemBefore].setIcon(new google.maps.MarkerImage(markImgGreenUrl));
        
        //changes icon colour in list item from red to green
        var oldRedImg = document.getElementById('mark' + itemBefore);
        var newGreenImg = document.createElement('img');
        newGreenImg.src = markImgGreenUrl;
        oldRedImg.replaceChild(newGreenImg, oldRedImg.firstChild);
      }
    }
    itemBefore=id;
  }

  divList = document.getElementById('divList');
  divMapInfo = document.getElementById('photo');
  var options = {
    zoom: 14,
    center: new google.maps.LatLng(40.784188, -73.964405),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById('map'), options);
  /* For keyDragZoom */
  map.enableKeyDragZoom();
  /* For Parsing  JSON */
  data = $.parseJSON(courseLibrary);

  //yy
  //geojson
  //load parcel grid geojson file to map
  map.data.loadGeoJson('nyc.geojson');

  //random color code
  var colorCodes=['#66FFFF','#00CC66','#FFCC00','#FF6699','#CC66FF'];

  //render color by id
  map.data.setStyle(function(feature) {
    //var ascii = feature.getProperty('ascii');
    //var color = ascii > 91 ? 'red' : 'blue';

    var id=feature.A.OBJECTID;

    var color;

    return {
        fillColor: colorCodes[id%5],
        fillOpacity:0.5,
        strokeWeight: 1,
        strokeColor:'black'
      };
  });

  //add point geojson for label display
  var areaMarkers=[];

  jQuery.ajax({
    url: "nyc_pt.geojson",
    success:function(response){
      displayLabels(response);
    }
  });

  function displayLabels(response){

    var areas=JSON.parse(response);
    jQuery.each(areas.features,function(index,value){

        var point = new google.maps.LatLng(
              parseFloat(value.geometry.coordinates[1]),
              parseFloat(value.geometry.coordinates[0])
            );

        var marker1 = new MarkerWithLabel({
           position: point,
           icon:"test",
           draggable: false,
           raiseOnDrag: false,
           map: map,
           labelContent: "<h2 class='label'>"+value.properties.Code+"</h2>",
           labelAnchor: new google.maps.Point(10, 10),
           labelClass: "labels", // the CSS class for the label
           labelStyle: {opacity: 0.75},
        });

        areaMarkers.push(marker1);

        

        //var html = "<img class='markerImg' src='"+value.path+"'>";

        /*var marker = new google.maps.Marker({
            map: map,
            icon: "",
            //title: value.desc,
            position: point
          });
        */
      });
  }
    // .done(function( data ) 
    // {

    //   areas=JSON.parse(data);

    //   //photoMarkers=[];

    //   //photoImages=[];



    //   jQuery.each(areas.features,function(index,value){

    //     var point = new google.maps.LatLng(
    //           parseFloat(value.geometry.coordinates[1]),
    //           parseFloat(value.geometry.coordinates[0])
    //         );

    //     var marker1 = new MarkerWithLabel({
    //        position: point,
    //        icon:"test",
    //        draggable: false,
    //        raiseOnDrag: false,
    //        map: map,
    //        labelContent: value.properties.ID>0?"<h2 sytle='width:200px'>"+value.properties.NAME+"</h2>":"<h3></h3>",
    //        labelAnchor: new google.maps.Point(100, 10),
    //        labelClass: "labels", // the CSS class for the label
    //        labelStyle: {opacity: 0.75, width:"200px"},
    //     });

    //     areaMarkers.push(marker1);

        

    //     //var html = "<img class='markerImg' src='"+value.path+"'>";

    //     /*var marker = new google.maps.Marker({
    //         map: map,
    //         icon: "",
    //         //title: value.desc,
    //         position: point
    //       });
    //     */
    //   });

    // });


  
  
  google.maps.event.addListenerOnce(map, 'bounds_changed', function () {

    var bounds = map.getBounds();
    var southWest = bounds.getSouthWest();
    var northEast = bounds.getNorthEast();

    var latSpan = northEast.lat() - southWest.lat();
    var lngSpan = northEast.lng() - southWest.lng();
    //yy
    //courseLibrary2
    data = $.parseJSON(courseLibrary2);
    LoadMap();

  });
  var mapCenter = map.getCenter();
  
  $("#WikipediaSearch_Latitude").val(mapCenter.lat()) ;
  $("#WikipediaSearch_Longitude").val(mapCenter.lng()) ; 
  
  google.maps.event.addListener(map, 'dragend', function() {
    var dragCenter = map.getCenter();
    $("#WikipediaSearch_Latitude").val(dragCenter.lat().toFixed(6)) ;
    $("#WikipediaSearch_Longitude").val(dragCenter.lng().toFixed(6)) ; 
    if($('#cleared_rect').val()!=0){
      if($('#tab_index').val()==2){
	if($('#display_on').is(':checked')){
	  createCircleInCenter();
	}
      }
    }
  });
  google.maps.event.addDomListener(document.getElementById('crosshair'),'dblclick', function() {
    zoomLevel = map.getZoom();
    map.setZoom(zoomLevel+1);
  });
  
  function redraw() {
    var latLngBounds = new google.maps.LatLngBounds(
      marker1.getPosition(),
      marker2.getPosition()
    );
    $('#SouthWest_Latitude').val(marker1.getPosition().lat().toFixed(6));
    $('#SouthWest_Longitude').val(marker1.getPosition().lng().toFixed(6));
    $('#NorthEast_Latitude').val(marker2.getPosition().lat().toFixed(6));
    $('#NorthEast_Longitude').val(marker2.getPosition().lng().toFixed(6));

    rectangle.setBounds(latLngBounds);
    markersRecArray.push(rectangle);
    $('#cleared_rect').val(0);
    
  }

  function LoadMap(){        
    
    //Load Map Data
    $("#list").empty();  
    var i = 0;        
    markers = [];
    var infowindow;
    var getCenterLatLng = map.getCenter();
    var latlngbounds = new google.maps.LatLngBounds(getCenterLatLng,getCenterLatLng);
    var pnt;
    $.each(data, function (photo) {
      
      //indexes changed - there was a bug regearding google marker ids and markers array ids
      
      pnt = new google.maps.LatLng(data[photo].Location.Latitude, data[photo].Location.Longitude);
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(data[photo].Location.Latitude, data[photo].Location.Longitude),
        map: map,
        title: data[photo].Title,
        id: i,
        icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/marker' + (i+1) + '.png',
        photo: data[photo]
      });
      
      i++;

      latlngbounds.extend( pnt );
      
      $('#SouthWest_Latitude').val(latlngbounds.getSouthWest().lat());
      $('#SouthWest_Longitude').val(latlngbounds.getSouthWest().lng());
      $('#NorthEast_Latitude').val(latlngbounds.getNorthEast().lat());
      $('#NorthEast_Longitude').val(latlngbounds.getNorthEast().lng());
      
      google.maps.event.addListener(marker, 'click', function () {
        
        //on marker click does the same thing as click on list item
        pointToMarker(marker.id);
        displayphoto(marker.photo.PhotoId);
        ScrollToListItem(marker.id);
        
        if (!infowindow) {
          infowindow = new google.maps.InfoWindow();
        }

        content = $.tmpl(infoTemplate, marker);

        infowindow.setContent(content);
        //console.log(marker);

        // Tying the InfoWindow to the marker
        infowindow.open(map, marker);
      });

      $.tmpl(listTemplate, {marker:marker, index: photo, 
                            date: $.format.date(marker.photo.DateTaken, 'MM/dd/yyyy hh:mm a'),
                            data: data[photo]})
        .click((function(p, m) {
          return function() {
            pointToMarker(p);
            displayphoto(m.photo.PhotoId);
          };
        })(photo, marker))
        .appendTo('#list');

      markers[marker.id] = marker; //google marker added to array markers
      markerCount++;
    });

    //on load selects first marker in the list
    pointToMarker(0);
    displayphoto(markers[0].photo.PhotoId);
    ScrollToListItem(0);
  }

  function RemoveMarkers(){
    for(var i in markers){
      markers[id].setMap(null);
    }
    itemBefore=-1;
  }



  function ScrollToListItem(id){	
    var itemHeight = divList.scrollHeight/markerCount;
    var y = itemHeight * id;
    divList.scrollTop = y;
  }

  function SortDataBy(){
    var sel = document.getElementById('SortData').value;	
    switch(sel){
    case 'NorthSouth':			
      data.sort(
        function(a,b) {
	  return b.Location.Latitude - a.Location.Latitude;
        });			
      break;
    case 'SouthNorth':			
      data.sort(
        function(a,b) {
	  return a.Location.Latitude - b.Location.Latitude;
        });			
      break;
    case 'DateTaken':            
      data.sort(function(a, b){
        
        var stringA=(a.DateTaken).substring(0, (a.DateTaken).length-1);
        stringA=stringA.replace(/ /,",");
        stringA=stringA.replace(/:/g,",");                    
        stringA=stringA.replace(/-/g,",");
        stringA=stringA.substr(2);
        var strA=new Array();
        strA=stringA.split(",");
        var dateA=new Date(strA[0],strA[1],strA[2],strA[3],strA[4],strA[5]);

        var stringB=(b.DateTaken).substring(0, (b.DateTaken).length-1);
        stringB=stringB.replace(/ /,",");
        stringB=stringB.replace(/:/g,",");                    
        stringB=stringB.replace(/-/g,",");
        stringB=stringB.substr(2);
        var strB=new Array();
        strB=stringB.split(",");
        var dateB=new Date(strB[0],strB[1],strB[2],strB[3],strB[4],strB[5]);

        return dateA-dateB;
        
      });			            
      break;
    default: break;
    }
    divList.scrollTop=0; 
    RemoveMarkers();
    
    LoadMap();	
  }



  // ** Photo Display Window **

  function displayphoto(photoId) {

    //Read Single JSON Photo
    MapInfoLoading();
    
    setTimeout((function (){
      var photo = $.parseJSON	(courseLibrary);

      for (var i = 0; i < photo.length; i++) {
        if (photo[i].PhotoId == photoId) {
          $("#photo").empty();
          $.tmpl(photoTemplate, photo[i]).appendTo('#photo');
          break;
        }
      }
    }), 3000);

  }

  function MapInfoLoading(){
    $(divMapInfo).empty();
    $(divMapInfo).append('<img src=\'Content/loading.gif\' width=\'250\' heigth=\'200\' />');
  }
});
