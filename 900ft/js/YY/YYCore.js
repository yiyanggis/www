/*
*class name:GoogleDistance
*class description: get distance from latlon
*
*
*
*/

YY={};

YY.Class = function (options) {
	// var klass=function(){
	// 	this.initialize.apply(this,arguments);
	// };

	// if(!klass.prototype.initialize)
	// 	klass.prototype.initialize=function(){};

	// for (var property in options){
	// 	klass.prototype[property]=options[property];
	// }

	

	// return klass;

	var len = arguments.length;
    var P = arguments[0];
    var F = arguments[len-1];

    var C = typeof F.initialize == "function" ?
        F.initialize :
        function(){ P.prototype.initialize.apply(this, arguments); };

    if (len > 1) {
        var newArgs = [C, P].concat(
                Array.prototype.slice.call(arguments).slice(1, len-1), F);
        YY.inherit.apply(null, newArgs);
    } else {
        C.prototype = F;
    }
    return C;
};

YY.inherit = function(C, P) {
   var F = function() {};
   F.prototype = P.prototype;
   C.prototype = new F;
   var i, l, o;
   for(i=2, l=arguments.length; i<l; i++) {
       o = arguments[i];
       if(typeof o === "function") {
           o = o.prototype;
       }
       YY.Util.extend(C.prototype, o);
   }
};

YY.Util = YY.Util || {};
YY.Util.extend = function(destination, source) {
    destination = destination || {};
    if (source) {
        for (var property in source) {
            var value = source[property];
            if (value !== undefined) {
                destination[property] = value;
            }
        }

        /**
         * IE doesn't include the toString property when iterating over an object's
         * properties with the for(property in object) syntax.  Explicitly check if
         * the source has its own toString property.
         */

        /*
         * FF/Windows < 2.0.0.13 reports "Illegal operation on WrappedNative
         * prototype object" when calling hawOwnProperty if the source object
         * is an instance of window.Event.
         */

        var sourceIsEvt = typeof window.Event == "function"
                          && source instanceof window.Event;

        if (!sourceIsEvt
           && source.hasOwnProperty && source.hasOwnProperty("toString")) {
            destination.toString = source.toString;
        }
    }
    return destination;
};


YY.Point=YY.Class({
	initialize:function(x,y){
		this.x=x;
		this.y=y;
	},
	toString: function(){
		return this.x+":"+this.y;
	}

});

var rad = function(x) {
  return x * Math.PI / 180;
};

YY.RadPt=YY.Class(YY.Point,{
	initialize:function(x,y){
		this.x=rad(x);
		this.y=rad(y);
	},
	toString: function(){
		return this.x+"::"+this.y;
	},
	print:function(){
		console.log(this.x+","+this.y);
	},
	setX:function(x){
		this.x=x;
	},
	getX:function(){
		return this.x;
	},
	setY:function(y){
		this.y=y;
	},
	getY:function(){
		return this.y;
	},
	latLonToRad(latlon){
		if(latlon.lat!==undefined&&latlon.lng!==undefined){
			this.y=rad(latlon.lat);
			this.x=rad(latlon.lng);
			return this;
		}
		else{
			return null;
		}
	}
});

// YY.RadPt = function (x, y, round) {
// 	if (x instanceof google.maps.LatLng) {
// 		return x;
// 	}
// 	return new YY.RadPt(x, y, round);
// };

YY.Circle=YY.Class({
	x:null,
	y:null,
	radius:null,
	center:null,
	map:null,
	initialize:function(x,y,radius,map){
		this.x=x;
		this.y=y;
		this.radius=radius;
		this.map=map;
	},
	toString: function(){
		return this.x+"::"+this.y;
	},
	print:function(){
		console.log(this.x+","+this.y);
	},
	options:{
	  strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: this.map,
      center: this.center,
      radius: this.radius
	},
	generateOptions:function(){
		this.options.center=new google.maps.LatLng(this.y,this.x);
		this.options.map=this.map;
		this.options.radius=this.radius;
		return this.options;
	}
});

YY.GoogleDistance=YY.Class({
	initialize:function(map){
		this.map=map;
	},
	

}); 


YY.GoogleDistance.getDistance = function(p1, p2) {
  var R = 6378137; // Earth’s mean radius in meter
  var dLat = rad(p2.lat() - p1.lat());
  var dLong = rad(p2.lng() - p1.lng());
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
    Math.sin(dLong / 2) * Math.sin(dLong / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d; // returns the distance in meter
};


YY.GooglePlaceFinder=YY.Class({
	initialize:function(map){
		this.service = new google.maps.places.PlacesService(map);
		this.latlng=null;
		this.radius=null;
		this.placeID="";
		this.results={};
	}
	
});

YY.GooglePlaceFinder.getPlaceID=function(latlng,radius,callback){
	this.latlng=latlng;
	this.radius=radius;

	var request = {
	    location: this.latlng,
	    radius: '500'
	    //,rankBy: google.maps.places.RankBy.DISTANCE
	};

	if(this.service!=undefined){
		//this.service.nearbySearch(request, GooglePlaceFinder.prototype.callback);
		this.service.nearbySearch(request, callback);
	}

}

YY.GooglePlaceFinder.getDetails=function(id,callback){
	var request = {
	  placeId: id
	};

	if(this.service!=undefined){
		//this.service.nearbySearch(request, GooglePlaceFinder.prototype.callback);
		this.service.getDetails(request, callback);
	}

}

YY.GooglePlaceFinder.callback=function(results,status){
	console.log(results);
	this.results=results;
}