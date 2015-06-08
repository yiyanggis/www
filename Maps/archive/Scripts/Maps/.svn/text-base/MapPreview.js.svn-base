/// <reference path="../GMap/google-maps-3-vs-1-0-vsdoc.js" />
/// <reference path="../jquery-1.4.1-vsdoc.js" />

var item;
var itemBefore=-1;
var markers;
var map;
var data;	
var divList;
var divMaoInfo;
var marker1;
var marker2;
var rectangle;
	//function that points to marker when you click item in the list (changes marker to red, and previously selected marker to green)
	function pointToMarker(id){
		
		if(id!=itemBefore){
			for(var i=0; i<markers.length; i++)
			{			
				
				if (markers[i].id==id){
					
					var markImgRedUrl = 'http://gmaps-samples.googlecode.com/svn/trunk/markers/red/marker' + (id +1)	+ 	'.png';
					
					
					markers[i].setIcon(new google.maps.MarkerImage(markImgRedUrl));
					
					//changes icon colour in list item from green to red
					var oldGreenImg = document.getElementById('mark' + id);
					var newRedImg = document.createElement('img');
					newRedImg.src = markImgRedUrl;
					oldGreenImg.replaceChild(newRedImg, oldGreenImg.firstChild);
					
					//if there are 2 markers with samo lon & lat, the selected one will be on top
					markers[i].setMap(null);
					markers[i].setMap(map);
					//centers the map on selected marker, but doesn't change the zoom level
					
					
					map.setCenter(new google.maps.LatLng(markers[i].photo.Location.Latitude,markers[i].photo.Location.Longitude));
					break;
				}
			}
					
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

$(document).ready(function () {
	
							
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
	
	
    google.maps.event.addListenerOnce(map, 'bounds_changed', function () {

        var bounds = map.getBounds();
        var southWest = bounds.getSouthWest();
        var northEast = bounds.getNorthEast();

        var latSpan = northEast.lat() - southWest.lat();
        var lngSpan = northEast.lng() - southWest.lng();
        data = $.parseJSON(courseLibrary);
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
			
			latlngbounds.extend( pnt );
			
			$('#SouthWest_Latitude').val(latlngbounds.getSouthWest().lat());
			$('#SouthWest_Longitude').val(latlngbounds.getSouthWest().lng());
			$('#NorthEast_Latitude').val(latlngbounds.getNorthEast().lat());
			$('#NorthEast_Longitude').val(latlngbounds.getNorthEast().lng());
			
			i++;
            (function (i, marker) {
                google.maps.event.addListener(marker, 'click', function () {
                	
                	//on marker click does the same thing as click on list item
                	pointToMarker(marker.id);
                	displayphoto(marker.photo.PhotoId);
                	ScrollToListItem(marker.id);
                	
                    if (!infowindow) {
                        infowindow = new google.maps.InfoWindow();
                    }

                    var content = "<div class='info'>";
                    content += "<div style='float:left;'><img src='" + marker.photo.SquareThumbnailUrl + "'></div>";
                    content += " <div style='float:left;margin-left:5px;'>";
                    content += "  <div>" + marker.photo.Title + "</div>";
                    content += "  <div>" + marker.photo.PhotoId + "</div>";
                    content += "  <div>" + marker.photo.Location.Latitude + "," + marker.photo.Location.Longitude + "</div>";
                    content += " </div>";
                    content += "</div>";

                    infowindow.setContent(content);
                    //console.log(marker);

                    // Tying the InfoWindow to the marker
                    infowindow.open(map, marker);
                });
            })(i, marker);

            (function (data) {

                var index = $.inArray(marker.photo, data);
                //onclick event added to list item
                var markerIcon = "http://gmaps-samples.googlecode.com/svn/trunk/markers/green/marker" + (index + 1) + ".png";
                var html = "<li onclick='pointToMarker("+ index +"); displayphoto("+marker.photo.PhotoId+"); ' > ";               
                html += "<div>";
                html += "<div id='mark" + index + "' style='float:left;margin-top:5px;margin-right:5px;'><img src='" + markerIcon + "'/></div>";
                html += "<div style='float:left;'><img src='" + data[photo].SquareThumbnailUrl + "'/></div>";
                html += "<div style='float:left;margin-left:5px;'>";
                html += "   <div>" + marker.photo.Title + "</div>";
                html += "   <div>" + "Date Taken " + $.format.date(marker.photo.DateTaken, "MM/dd/yyyy hh:mm a") + "</div>";
                html += "   <div>" + marker.photo.PhotoId + "</div>";
                html += "   <div>" + marker.photo.Location.Latitude + "," + marker.photo.Location.Longitude + "</div>";
                html += " </div>";
                html += "</div>";
                html += "<div style='clear:both'></div>";
                html += "</li>";  
                               
                $("#list").append(html);


                // console.log('Latitude:' + data[photo].Location.Latitude + ' ' + 'Longitude:' + data[photo].Location.Longitude);

            })(data);
			markers.push(marker); //google marker added to array markers
			
			//on load selects first marker in the list
			pointToMarker(0);
			displayphoto(markers[0].photo.PhotoId);
	        });



}

function RemoveMarkers(){
    for(var i=0; i<markers.length; i++){
        markers[i].setMap(null);
    }
    itemBefore=-1;
}



function ScrollToListItem(id){	
	var itemHeight = divList.scrollHeight/markers.length;
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
            
                var html = "<div>";
                html += "   <div class='subheadertext'>" + photo[i].Title + "</div>";
                html += "<div>";
                html += "  <div style='float:left;'>";
                html += "   <div style='margin-left:8px;'> <br>&nbsp;<img src='" + photo[i].SmallUrl + "' alt=''></div>";
                html += "  </div>";
                html += "  <div style='float:left;'>";
                html += "    <div style='margin-left:8px;'><span class='labelname'>Latitude/Longitude:</span> " + photo[i].Location.Latitude + "," + photo[i].Location.Longitude + "</div>";
                html += "    <div style='margin-left:8px;'>" + photo[i].Location.Neighbourhood.Description + "</div>";
                html += "    <div style='margin-left:8px;'>" + photo[i].Location.Region.Description + " " + photo[i].Location.Country.Description + "</div>";
                html += "    <div style='margin-top:5px;margin-left:8px;'><span class='labelname'>Owner:</span> " + photo[i].OwnerRealName + "</div>";
                html += "    <div style='margin-left:8px;'><span class='labelname'>User Name:</span> " + photo[i].OwnerUserName + "</div>";
                html += "    <div style='margin-left:8px;'><span class='labelname'>User Id:</span> " + photo[i].OwnerUserId + "</div>";
                html += "    <div style='margin-top:5px;margin-left:8px;'><span style='color:red;' class='labelname'>Image Scale:</span> Label: " + photo[i].SizeCollection[2].Label + " W: " + photo[i].SizeCollection[2].Width + " H: " + photo[i].SizeCollection[2].Height  + "</div>";
                html += "  </div>";
                html += "</div>";
                html += "<div style='clear:both;'></div>";
                html += "</div>";
                html += "<div style='clear:both;'></div>";
            
                $("#photo").empty();
                $("#photo").append(html);

            }
        }
    }), 3000);

}

function MapInfoLoading(){
	$(divMapInfo).empty();
	$(divMapInfo).append('<img src=\'Content/loading.gif\' width=\'250\' heigth=\'200\' />');
}