/*
*class name:GoogleDistance
*class description: get distance from latlon
*
*
*
*/

YY.Geometry=YY.Class({
	/**
     * APIProperty: id
     * {String}
     */
    id: null,

    /** 
     * APIProperty: name
     * {String}
     */
    name: null,

    /** 
     * APIProperty: div
     * {DOMElement}
     */
    div: null,

    /**
     * APIProperty: length of geometry
	   * {String}
    **/
    length:null,

    /**
    * APIProperty: display geometry in sentance
    * {String}
    **/
    toString: function(){
      return this.id+":"+this.name;
    },

    /**
    * APIProperty: display geometry in sentance
    * {String}
    **/
    printProperty: function(name){
      console.log(this[name]);
    },

    /**
    * APIFunction: add node to array
    * {return number of point}
    **/
    addPoint:function(){
      
    }
});


YY.Geometry.Polyline=YY.Class(YY.Geometry,{
  /**
  * APIProperty: vertex array
  * {array}
  **/
  nodes:[],

  /**
  * APIProperty: line style
  * {string}
  **/
  style:null,

  /**
  * APIProperty: vertex array
  * {array}
  **/
  length:null,

  /**
  * APIProperty: vertex array
  * {array}
  **/
  path:null,

  /**
  * APIFunction: initialize
  * {}
  **/
  initialize:function(options){
    YY.Util.extend(this, options);

    if(this.nodes!=undefined){
      this.length=this.nodes.length;
    }
  },

  /**
  * APIFunction: add node to array
  * {return number of point}
  **/
  addPoint:function(){

  },

  /**
  * APIFunction: create polyline
  * 
  **/
  createPolyline:function(map){
    var options={
      path:this.nodes,
      geodesic:true,
    };

    if(this.style=="arrow"){
      options.icons=[{
            icon: lineSymbol,
            offset: '100%'
          }];
    }

    this.path=new google.maps.Polyline(options);

    this.path.setMap(map);
  },

  /**
  *
  *
  **/
  updatePoint:function(index,pt){
    this.nodes[index]=pt;
    this.path.setPath(this.nodes);
  },

  /**
  *
  *
  **/
  addPoint:function(pt){
    this.nodes.push(pt);
    this.path.setPath(this.nodes);
  }
});