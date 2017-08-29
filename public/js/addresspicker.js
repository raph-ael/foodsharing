var addresspicker = {

	MapZenSearch: function( apiKey ) {

		function getEndpoint( action ) {
			return 'https://search.mapzen.com/v1/' + action;
		}

		function getData( term ) {
			return {
				api_key: apiKey,
				'focus.point.lat': '50',
				'focus.point.lon': '10',
				layers: 'address',
				sources: 'osm',
				text: term
			};
		}

		function mapResult( data ) {
			var res = [];
			$.each( data.features, function( key, val ) {
				res.push( { label: val.properties.label, data: val } );
			} );
			return res;
		}

		function search( request ) {
			return $.getJSON( getEndpoint( 'search' ), getData( request ) ).then( mapResult );
		}

		this.autocomplete = function( request ) {
			return $.getJSON( getEndpoint( 'autocomplete' ), getData( request ) ).then( function( data ) {
				if( data.features.length === 0 ) {
					return search( request );
				}
				return mapResult( data );
			} );
		}
	},

	initMap: function( mapDom ) {
		var map = L.map( mapDom );
		L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}", {
			attribution: "Geocoding by <a href=\"https://mapzen.com/projects/search/\">Mapzen</a>, Tiles &copy; Esri 2014"
		}).addTo(map);

		var fsIcon = L.AwesomeMarkers.icon({
			icon: "smile",
			markerColor: "orange",
			prefix: "img"
		});

		return function( coords ) {
			map.setView(coords, 15);
			L.marker(coords, {icon: fsIcon}).addTo(map);
		}
	},

	init: function( inputDom, engine, selectCallback ) {
		var $input = $( inputDom );
		$input.autocomplete( {
			delay: 500,
			minLength: 3,
			source: function( request, response ) {
				return engine.autocomplete( request.term ).done( response );
			},
			select: function( event, ui ) {
				selectCallback( [ui.item.data.geometry.coordinates[1], ui.item.data.geometry.coordinates[0]], {
					street_number: ui.item.data.properties.housenumber,
					route: ui.item.data.properties.street,
					postalcode: ui.item.data.properties.postalcode,
					locality: ui.item.data.properties.locality,
					country: ui.item.data.properties.country
				} );
			}
		} );
	}
};
