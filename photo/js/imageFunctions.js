var FlagImage=function(url, marker, date, desc){
	this.imageURL=url;
	this.marker=marker;
	this.date=date;
	this.desc=desc;
}

FlagImage.prototype.focusOn=function(){
	if(this.marker!=undefined){
		if(this.marker.map!=undefined){
			var map=this.marker.map;
			 map.setCenter(this.marker.getPosition());
			 new google.maps.event.trigger( this.marker, 'click' );

			 return true;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
	

}

