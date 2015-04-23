var FlagImage=function(url, marker, date, desc,addr){
	this.imageURL=url;
	this.marker=marker;
	this.date=date;
	this.desc=desc;
	this.addr=addr;
}

FlagImage.prototype.focusOn=function(map){
	if(this.marker!=undefined){
		if(this.marker.map!=undefined){
			var map=this.marker.map;
			 map.setCenter(this.marker.getPosition());
			 map.setZoom(20);
			 new google.maps.event.trigger( this.marker, 'click' );

			 return true;
		}
		else{
			this.marker.setMap(map);

			map.setCenter(this.marker.getPosition());
			map.setZoom(20);
			 new google.maps.event.trigger( this.marker, 'click' );
			return true;
		}
	}
	else{
		return false;
	}
}
	

FlagImage.prototype.setDetailInfo=function(domid, googlePlaceFinder){
	var thumbnail=$("#"+domid);

	thumbnailDomid=domid;

		//detail info
	/* <div class="caption">
        <h3>Thumbnail label</h3>
        <p>...</p>
        
      </div>
      */

    var detail=$("<div></dvi>");

    var imageThumbnail=$("<img src='"+this.imageURL+"' class='imageThumbnail'>");

    var imageDesc=$("<div class='caption'><h3>"+this.addr+"</h3><p>"+this.desc+"</p></div>");
    $(detail).appendTo(thumbnail);
    $(imageThumbnail).appendTo($(detail));
    $(imageDesc).appendTo($(detail));



    googlePlaceFinder.getPlaceID(this.marker.getPosition(),'50',FlagImage.prototype.getPlaceID);

}

FlagImage.prototype.getPlaceID=function(results,status){
	if(results.length>0)
	{
		this.placeID=results[0].place_id;
		//if telephone number
	}


	var thumbnail=$("#"+thumbnailDomid);

	var placeID=$("<p>"+this.placeID+"</p>");
	$(placeID).appendTo(thumbnail);
	
}

