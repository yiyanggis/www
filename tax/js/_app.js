"use strict";
var _Map;

$(document).ready(function ()
{
	$("#side-menu").metisMenu();

	$(window).bind("load resize", function ()
	{
		MapResize();

		var topOffset = 50;
		var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
		if (width < 768)
		{
			$("div.navbar-collapse").addClass("collapse");
			topOffset = 100; // 2-row-menu
		} else
		{
			$("div.navbar-collapse").removeClass("collapse");
		}

		var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
		height = height - topOffset;
		if (height < 1) height = 1;
		if (height > topOffset)
		{
			$("#page-wrapper").css("min-height", (height) + "px");
		}
	});

	var url = window.location;
	var element = $("ul.nav a").filter(function ()
	{
		return this.href == url || url.href.indexOf(this.href) == 0;
	}).addClass("active").parent().parent().addClass("in").parent();
	if (element.is("li"))
	{
		element.addClass("active");
	}

	if (typeof ol !== "undefined")
	{

		var untiled = new ol.layer.Image({
	        source: new ol.source.ImageWMS({
	          ratio: 1,
	          url: 'http://52.26.28.5:8080/geoserver/tax/wms',
	          params: {'FORMAT': 'image/png',
	                   'VERSION': '1.1.1',  
	                STYLES: '',
	                LAYERS: 'legdists_84',
	          }
	        })
	      });

		var tiled = new ol.layer.Tile({
        visible: false,
        source: new ol.source.TileWMS({
          url: 'http://52.26.28.5:8080/geoserver/tax/wms',
          params: {'FORMAT': 'image/png', 
                   'VERSION': '1.1.1',
                   tiled: true,
                STYLES: '',
                LAYERS: 'tax:legdists',
          }
        })
      });

		var projection = new ol.proj.Projection({
          code: 'EPSG:3070',
          units: 'm',
          axisOrientation: 'neu'
      });

		_Map = new ol.Map({
			layers: [
			 new ol.layer.Tile({ source: new ol.source.OSM() })
			  ,
			  untiled
			  // new ol.layer.Image({
			  //   extent: [-13884991, 2870341, -7455066, 6338219],
			  //   source: new ol.source.ImageWMS({
			  //     url: 'http://demo.boundlessgeo.com/geoserver/wms',
			  //     params: {'LAYERS': 'topp:states'},
			  //     serverType: 'geoserver'
			  //   })
			  // })
			],
			view: new ol.View({
				//projection:projection
				  center: ol.proj.transform(
				      [-116, 42], 'EPSG:4326', 'EPSG:3857'),
				  zoom: 6
			}),
			target: 'map'
		});

		//yy
		// var lon = -66;
  //       var lat = 42;
  //       var zoom = 5;
		// var layer = new ol.layer.WMS( "OpenLayers WMS",
  //               "http://vmap0.tiles.osgeo.org/wms/vmap0", {layers: 'basic'} );
  //       _Map.addLayer(layer);
  //       _Map.setCenter(new ol.LonLat(lon, lat), zoom);


	}


	$("#SearchModal").on("show.bs.modal", function (event)
	{
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data("whatever") // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal"s content. We"ll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		//modal.find(".modal-title").text("New message to " + recipient)
		//modal.find(".modal-body input").val(recipient)
	})
	$("#PropertySummaryModal").on("show.bs.modal", function (event)
	{
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data("whatever") // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal"s content. We"ll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		//modal.find(".modal-title").text("New message to " + recipient)
		//modal.find(".modal-body input").val(recipient)
	})
	$("#CustomerServiceSummaryModal").on("show.bs.modal", function (event)
	{
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data("whatever") // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal"s content. We"ll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		//modal.find(".modal-title").text("New message to " + recipient)
		//modal.find(".modal-body input").val(recipient)
	})
});

function OpenMapView()
{
	var MainHeader = $("#MainHeader");
	var MainContent = $("#MainContent");
	var MapContainer = $("#MapContainer");
	var Map = $("#map");

	if (MapContainer.length > 0 && MapContainer.find("#map").length > 0)
		return;

	MainHeader.html("Map View");

	var template = Handlebars.compile($("#TemplateTest125").html());
	MainContent.html(template());

	var MapContainer = $("#MapContainer");

	Map.detach().appendTo(MapContainer);

	MapResize();
}
function OpenDetailedView()
{
	var MainHeader = $("#MainHeader");
	var MainContent = $("#MainContent");

	MapHide();

	MainHeader.html("Property List View");

	var template = Handlebars.compile($("#TemplateTest123").html());
	MainContent.html(template());

	$("#dataTables-example").DataTable({
		responsive: true
	});
}
function OpenCustomerService()
{
	var MainHeader = $("#MainHeader");
	var MainContent = $("#MainContent");

	MapHide();

	MainHeader.html("Customer Service Requests");

	var template = Handlebars.compile($("#TemplateTest124").html());
	MainContent.html(template());

	$("#dataTables-example").DataTable({
		responsive: true
	});
}

function MapHide()
{
	var HiddenContent = $("#HiddenContent");
	var Map = $("#map");

	Map.detach().appendTo(HiddenContent);
}
function MapResize()
{
	var bottomMargin = 20;
	var Map = $("#map");
	if (_Map && Map.length> 0)
	{
		var newHeight = $(window).height() - Map.offset().top - bottomMargin;
		if (isNaN(newHeight) == true || newHeight < 200)
			newHeight = 400;

		Map.height(newHeight);
		setTimeout(function () { _Map.updateSize(); }, 200);
	}
}

$(function ()
{
	$('.list-group.checked-list-box .list-group-item').each(function ()
	{

		// Settings
		var $widget = $(this),
		    $checkbox = $('<input type="checkbox" class="hidden" />'),
		    color = ($widget.data('color') ? $widget.data('color') : "primary"),
		    style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
		    settings = {
		    	on: {
		    		icon: 'glyphicon glyphicon-check'
		    	},
		    	off: {
		    		icon: 'glyphicon glyphicon-unchecked'
		    	}
		    };

		$widget.css('cursor', 'pointer')
		$widget.append($checkbox);

		// Event Handlers
		$widget.on('click', function ()
		{
			$checkbox.prop('checked', !$checkbox.is(':checked'));
			$checkbox.triggerHandler('change');
			updateDisplay();
		});
		$checkbox.on('change', function ()
		{
			updateDisplay();
		});


		// Actions
		function updateDisplay()
		{
			var isChecked = $checkbox.is(':checked');

			// Set the button's state
			$widget.data('state', (isChecked) ? "on" : "off");

			// Set the button's icon
			$widget.find('.state-icon')
			    .removeClass()
			    .addClass('state-icon ' + settings[$widget.data('state')].icon);

			// Update the button's color
			if (isChecked)
			{
				$widget.addClass(style + color + ' active');
			} else
			{
				$widget.removeClass(style + color + ' active');
			}
		}

		// Initialization
		function init()
		{

			if ($widget.data('checked') == true)
			{
				$checkbox.prop('checked', !$checkbox.is(':checked'));
			}

			updateDisplay();

			// Inject the icon if applicable
			if ($widget.find('.state-icon').length == 0)
			{
				$widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
			}
		}
		init();
	});

	$('#get-checked-data').on('click', function (event)
	{
		event.preventDefault();
		var checkedItems = {}, counter = 0;
		$("#check-list-box li.active").each(function (idx, li)
		{
			checkedItems[counter] = $(li).text();
			counter++;
		});
		$('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
	});
});
